<?php

namespace App\Http\Controllers;

use App\Alarm;
use App\Http\Resources\RobotAlarmLogsCollection;
use App\RobotAlarmLogs;
use App\Services\GateService;
use Auth;
use Illuminate\Http\Request;

class RobotALarmLogsController extends Controller
{

    private $gateService;

    public function __construct(GateService $gateService)
    {

        $this->gateService = $gateService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return RobotAlarmLogsCollection
     */
    public function index()
    {
        $this->gateService->userIdCheck(request('product_id'));

        $alarms = RobotAlarmLogs::where('ROBOT_ID', (int)request('product_id'))->get();

        return new RobotAlarmLogsCollection($alarms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alarm = RobotAlarmLogs::find($id);
        $solution = Alarm::where('alarm_code', request('code'))->first();

        $alarm = collect($alarm)->merge([
            'description' => $solution->description,
            'cause' => $solution->cause,
            'remedy' => $solution->remedy,
            'remarks' => $solution->remarks
        ]);

        return new RobotAlarmLogsCollection($alarm);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
