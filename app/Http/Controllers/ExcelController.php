<?php

namespace App\Http\Controllers;

use App\Http\Exports\AlarmLogExport;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function getAlarmLogsExcel()
    {
        return (new AlarmLogExport((int)request('product_id')))->download('AlarmLogs.xlsx');
    }
}
