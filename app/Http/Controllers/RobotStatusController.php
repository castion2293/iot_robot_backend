<?php

namespace App\Http\Controllers;

use App\Http\Resources\RobotTotalStatusCollection;
use App\RobotStatus;
use App\Transformers\RobotStatusTransformer;
use Illuminate\Http\Request;

class RobotStatusController extends Controller
{
    /**
     * @var RobotStatusTransformer
     */
    private $robotStatusTransformer;

    /**
     * RobotStatusController constructor.
     * @param RobotStatusTransformer $robotStatusTransformer
     */
    public function __construct(RobotStatusTransformer $robotStatusTransformer)
    {

        $this->robotStatusTransformer = $robotStatusTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $status = $this->robotStatusTransformer->transformInstance(RobotStatus::find((int)$id));

        return new RobotTotalStatusCollection($status);
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
