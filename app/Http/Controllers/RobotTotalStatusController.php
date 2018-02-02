<?php

namespace App\Http\Controllers;

use App\Http\Resources\RobotTotalStatusCollection;
use App\RobotTotalStatus;
use App\Transformers\RobotTotalStatusTransformer;
use Auth;
use Illuminate\Http\Request;

class RobotTotalStatusController extends Controller
{
    /**
     * @var RobotTotalStatusTransformer
     */
    private $robotTotalStatusTransformer;

    /**
     * RobotTotalStatusController constructor.
     * @param RobotTotalStatusTransformer $robotTotalStatusTransformer
     */
    public function __construct(RobotTotalStatusTransformer $robotTotalStatusTransformer)
    {

        $this->robotTotalStatusTransformer = $robotTotalStatusTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serial_nums = Auth::user()->robots()->get()->pluck('serial_number');

        $total_Status = $serial_nums->map(function ($serial_num) {
            return $this->robotTotalStatusTransformer->transformInstance(RobotTotalStatus::find($serial_num));
        });

        return new RobotTotalStatusCollection($total_Status);
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
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $total_Status = $this->robotTotalStatusTransformer->transformInstance(RobotTotalStatus::find((int)$id));

        return new RobotTotalStatusCollection($total_Status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RobotTotalStatus  $robotTotalStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(RobotTotalStatus $robotTotalStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RobotTotalStatus  $robotTotalStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RobotTotalStatus $robotTotalStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RobotTotalStatus  $robotTotalStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(RobotTotalStatus $robotTotalStatus)
    {
        //
    }
}
