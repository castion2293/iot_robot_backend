<?php
/**
 * Created by PhpStorm.
 * User: robotech
 * Date: 2018/4/2
 * Time: 下午 03:21
 */

namespace App\Http\Exports;


use App\ThroughputForNG;
use App\ThroughputForOK;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CumulateThroughputExport implements FromCollection, ShouldQueue, WithHeadings, WithMapping
{
    use Exportable;

    private $filters;

    public function __construct($filters)
    {

        $this->filters = $filters;
    }

    public function collection()
    {
        $throughputForOK = ThroughputForOK::filter($this->filters)->get();
        $throughputForNG = ThroughputForNG::filter($this->filters)->get();

        if (!!count($throughputForOK) && !!count($throughputForNG)) {
            $throughputs = $throughputForOK->map(function ($item) use ($throughputForNG) {
                return [
                    'product_id' => $item->PRODUCT_ID,
                    'date' => $item->DATE,
                    'OK_Throughput' => $item->NUMBER,
                    'NG_Throughput' => $throughputForNG->filter(function ($e) use ($item) {
                        return $e->DATE == $item->DATE;
                    })->first()->NUMBER,
                ];
            })->sortByDesc(function ($throughput, $key) {
                return Carbon::parse($throughput['date']);
            });

            return $throughputs;
        }

        return null;
    }

    /**
     * @var Invoice $invoice
     */
    public function map($throughput): array
    {
        return [
            $throughput['date'],
            $throughput['OK_Throughput'],
            $throughput['NG_Throughput'],
            $throughput['product_id'],
        ];
    }

    public function headings(): array
    {
        return [
            '日期',
            '良品',
            '不量品',
            '產品編號',
        ];
    }
}