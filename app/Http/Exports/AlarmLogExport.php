<?php
/**
 * Created by PhpStorm.
 * User: robotech
 * Date: 2018/3/26
 * Time: 下午 01:57
 */

namespace App\Http\Exports;

use App\RobotAlarmLogs;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AlarmLogExport implements FromCollection, ShouldQueue, WithHeadings, WithMapping
{
    use Exportable;

    private $product_id;

    public function __construct($product_id)
    {

        $this->product_id = $product_id;
    }

    public function collection()
    {
        $alarms = RobotAlarmLogs::where('ROBOT_ID', $this->product_id)->get();

        return $alarms->sortByDesc(function ($alarm, $key) {
            return Carbon::parse($alarm->ALARM_DATE);
        });
    }

    /**
     * @var Invoice $invoice
     */
    public function map($alarm): array
    {
        return [
            $alarm->ALARM_NAME,
            $alarm->ALARM_CODE,
            $alarm->ALARM_DATE,
            $alarm->ALARM_TIME,
        ];
    }

    public function headings(): array
    {
        return [
            '異常名稱',
            '異常代碼',
            '日期',
            '時間',
        ];
    }
}