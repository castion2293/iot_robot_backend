<?php

namespace App\Http\Controllers;

use App\Filters\ThroughputFilters;
use App\ThroughputForNG;
use App\ThroughputForOK;
use Illuminate\Http\Request;

class throughputController extends Controller
{
    public function getThroughputForOK(ThroughputFilters $filters)
    {
        $throughputForOK = ThroughputForOK::filter($filters)->get();

        return response()->json([
            'items' => $throughputForOK
        ]);
    }

    public function getThroughputForNG(ThroughputFilters $filters)
    {
        $throughputForNG = ThroughputForNG::filter($filters)->get();

        return response()->json([
            'items' => $throughputForNG
        ]);
    }
}
