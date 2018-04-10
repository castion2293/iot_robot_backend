<?php

namespace App\Http\Controllers;

use App\Filters\ThroughputFilters;
use App\Http\Exports\AlarmLogExport;
use App\Http\Exports\CumulateThroughputExport;
use App\Http\Exports\MonthlyThroughputExport;
use App\Services\GateService;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
    private $gateService;

    public function __construct(GateService $gateService)
    {
        $this->gateService = $gateService;
    }

    public function getAlarmLogsExcel()
    {
        $this->gateService->userIdCheckForSpecific(request('user_id'), request('product_id'));

        return (new AlarmLogExport((int)request('product_id')))->download('AlarmLogs.xlsx');
    }

    public function getMonthlyThroughputExcel(ThroughputFilters $filters)
    {
        $this->gateService->userIdCheckForSpecific(request('user_id'), request('product_id'));

        return (new MonthlyThroughputExport($filters))->download('MonthlyThroughput.xlsx');
    }

    public function getCumulateThroughputExcel(ThroughputFilters $filters)
    {
        $this->gateService->userIdCheckForSpecific(request('user_id'), request('product_id'));

        return (new CumulateThroughputExport($filters))->download('CumulateThroughput.xlsx');
    }
}
