<?php

namespace App\Http\Controllers;

use App\Filters\ThroughputFilters;
use App\ThroughputForNG;
use App\ThroughputForOK;
use Illuminate\Http\Request;

class throughputController extends Controller
{
    public function getDailyThroughput(ThroughputFilters $filters)
    {
        $throughputForOK = ThroughputForOK::filter($filters)->get()->first();
        $throughputForNG = ThroughputForNG::filter($filters)->get()->first();

        if (!!count($throughputForOK) || !!count($throughputForNG)) {
            $OK_Throughput = optional($throughputForOK)->NUMBER;
            $NG_Throughput = optional($throughputForNG)->NUMBER;

            $rate = round($OK_Throughput / ($OK_Throughput + $NG_Throughput) * 100);

            return response()->json([
                'product_id' => $throughputForOK->PRODUCT_ID ?? $throughputForNG->PRODUCT_ID,
                'date' => $throughputForOK->DATE ?? $throughputForNG->DATE,
                'OK_Throughput' => $OK_Throughput,
                'NG_Throughput' => $NG_Throughput,
                'rate' => $rate,
            ]);
        }

        return null;
    }

    public function getMonthlyThroughput(ThroughputFilters $filters)
    {
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

            $total_OK = $OKthroughputs->sum('OK_Throughput');
            $total_NG = $NGthroughputs->sum('NG_Throughput');
            $rate = round($total_OK / ($total_OK + $total_NG) * 100);


            return response()->json([
                'items_ok' => $OKthroughputs,
                'items_ng' => $NGthroughputs,
                'total_ok' => $total_OK,
                'total_ng' => $total_NG,
                'rate' => $rate
            ]);
        }

        return null;
    }

    public function getCumulateThroughput(ThroughputFilters $filters)
    {
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

            $total_OK = $OKthroughputs->sum('OK_Throughput');
            $total_NG = $NGthroughputs->sum('NG_Throughput');
            $rate = round($total_OK / ($total_OK + $total_NG) * 100);


            return response()->json([
                'items_ok' => $OKthroughputs,
                'items_ng' => $NGthroughputs,
                'total_ok' => $total_OK,
                'total_ng' => $total_NG,
                'rate' => $rate
            ]);
        }

        return null;
    }
}
