<?php

namespace App\Http\Controllers;

use App\RobotAlarmLogs;
use App\Services\GateService;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    private $gateService;

    public function getAlarmLogsPDF(GateService $gateService)
    {
//        dd(request('product_id'));

//        $this->gateService = $gateService;
//
//        $this->gateService->userIdCheck(request('product_id'));
        $alarms = RobotAlarmLogs::where('ROBOT_ID', (int)request('product_id'))->orderBy('DATETIME')->get();

        $alarms = $alarms->sortByDesc(function ($alarm, $key) {
            return Carbon::parse($alarm->ALARM_DATE);
        });

        $pdf = PDF::loadView('pdf.AlarmLogPDF', ['alarms' => $alarms]);
        return $pdf->download('AlarmLogPDF.pdf');
    }
}
