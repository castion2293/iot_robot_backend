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

    public function __construct(GateService $gateService)
    {
        $this->gateService = $gateService;
    }

    public function getAlarmLogsPDF()
    {
        $this->gateService->userIdCheckForSpecific(request('user_id'), request('product_id'));

        $alarms = RobotAlarmLogs::where('ROBOT_ID', (int)request('product_id'))->orderBy('DATETIME')->get();

        $alarms = $alarms->sortByDesc(function ($alarm, $key) {
            return Carbon::parse($alarm->ALARM_DATE);
        });

        $pdf = PDF::loadView('pdf.AlarmLogPDF', ['alarms' => $alarms]);
        return $pdf->download('AlarmLogPDF.pdf');
    }

    public function getMonthlyThroughputPDF(ThroughputFilters $filters)
    {
        $this->gateService->userIdCheckForSpecific(request('user_id'), request('product_id'));

        $throughputForOK = ThroughputForOK::filter($filters)->get();
        $throughputForNG = ThroughputForNG::filter($filters)->get();

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

            $total_OK = $OKthroughputs->sum('OK_Throughput');
            $total_NG = $NGthroughputs->sum('NG_Throughput');
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

    public function getCumulateThroughputPDF(ThroughputFilters $filters)
    {
        $this->gateService->userIdCheckForSpecific(request('user_id'), request('product_id'));

        $throughputForOK = ThroughputForOK::filter($filters)->get();
        $throughputForNG = ThroughputForNG::filter($filters)->get();

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

            $total_OK = $OKthroughputs->sum('OK_Throughput');
            $total_NG = $NGthroughputs->sum('NG_Throughput');
            $rate = round($total_OK / ($total_OK + $total_NG) * 100);

            $pdf = PDF::loadView('pdf.MonthlyThroughput', [
                'throughputs' => $throughputs,
                'total_ok' => $total_OK,
                'total_ng' => $total_NG,
                'rate' => $rate
            ]);

            return $pdf->download('CumulateThroughputPDF.pdf');
        }

        return null;
    }
}
