<?php

namespace App\Http\Controllers;

use App\Filters\ThroughputFilters;
use App\RobotAlarmLogs;
use App\Services\GateService;
use App\ThroughputForNG;
use App\ThroughputForOK;
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

    public function getMonthlyThroughputPDF(ThroughputFilters $filters)
    {
        $throughputForOK = ThroughputForOK::filter($filters)->get();
        $throughputForNG = ThroughputForNG::filter($filters)->get();

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
            });

            $total_OK = $throughputs->sum('OK_Throughput');
            $total_NG = $throughputs->sum('NG_Throughput');
            $rate = round($total_OK / ($total_OK + $total_NG) * 100);

            $pdf = PDF::loadView('pdf.MonthlyThroughput', [
                'throughputs' => $throughputs,
                'total_ok' => $total_OK,
                'total_ng' => $total_NG,
                'rate' => $rate
            ]);
            return $pdf->download('MonthlyThroughputPDF.pdf');
        }

        return null;
    }
}
