<?php

namespace App\Http\Controllers;

use App\Http\Resources\RobotAlarmLogsCollection;
use App\RobotAlarmLogs;
use App\Transformers\RobotAlarmLogsTransformer;
use Illuminate\Http\Request;

class RobotALarmLogsController extends Controller
{

    /**
     * @var RobotAlarmLogsTransformer
     */
    private $transformer;

    public function __construct(RobotAlarmLogsTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return RobotAlarmLogsCollection
     */
    public function index()
    {
        $alarms = $this->transformer->transformCollection(RobotAlarmLogs::all())->pluck('0');

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
        $alarm = $this->transformer->transformInstance(RobotAlarmLogs::find($id));

        return new RobotAlarmLogsCollection(collect($alarm[0]));
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