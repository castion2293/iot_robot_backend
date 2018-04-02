<?php

namespace App\Http\Controllers;

use App\Filters\ThroughputFilters;
use App\Http\Exports\AlarmLogExport;
use App\Http\Exports\CumulateThroughputExport;
use App\Http\Exports\MonthlyThroughputExport;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function getAlarmLogsExcel()
    {
        return (new AlarmLogExport((int)request('product_id')))->download('AlarmLogs.xlsx');
    }

    public function getMonthlyThroughputExcel(ThroughputFilters $filters)
    {
        return (new MonthlyThroughputExport($filters))->download('MonthlyThroughput.xlsx');
    }

    public function getCumulateThroughputExcel(ThroughputFilters $filters)
    {
        return (new CumulateThroughputExport($filters))->download('CumulateThroughput.xlsx');
    }
}
