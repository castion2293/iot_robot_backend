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
        $product_ids = Auth::user()->products()->get()->pluck('product_id');

        $total_Status = $product_ids->map(function ($product_id) {
            return $this->robotTotalStatusTransformer->transformInstance(RobotTotalStatus::find((int)$product_id));
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
