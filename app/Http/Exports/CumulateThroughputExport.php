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

        if (!!count($throughputForOK) || !!count($throughputForNG)) {
            $OKthroughputs = $throughputForOK->map(function ($item) {
                return [
                    'product_id' => $item->PRODUCT_ID,
                    'date' => $item->DATE,
                    'OK_Throughput' => $item->NUMBER,
                ];
            });

            $NGthroughputs = $throughputForNG->map(function ($item) {
                return [
                    'product_id' => $item->PRODUCT_ID,
                    'date' => $item->DATE,
                    'NG_Throughput' => $item->NUMBER,
                ];
            });

            $date_ok = $OKthroughputs->pluck('date');
            $date_ng = $NGthroughputs->pluck('date');

            $dates = $date_ok->merge($date_ng)->unique();

            $throughputs = $dates->map(function ($date) use ($OKthroughputs, $NGthroughputs) {
                return [
                    'date' => $date,
                    'OK_Throughput' => $OKthroughputs->filter(function ($OKthroughput) use ($date) {
                        return $OKthroughput['date'] == $date;
                    })->pluck('OK_Throughput'),
                    'NG_Throughput' => $NGthroughputs->filter(function ($NGthroughput) use ($date) {
                        return $NGthroughput['date'] == $date;
                    })->pluck('NG_Throughput'),
                ];
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
            $throughput['OK_Throughput']->first() ?? '0',
            $throughput['NG_Throughput']->first() ?? '0',
        ];
    }

    public function headings(): array
    {
        return [
            '日期',
            '良品',
            '不量品',
        ];
    }
}