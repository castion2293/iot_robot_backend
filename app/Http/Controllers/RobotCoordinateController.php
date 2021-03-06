<?php

namespace App\Http\Controllers;

use App\Http\Resources\RobotCoordinateCollection;
use App\RobotCoordinate;
use App\Services\GateService;
use App\Transformers\RobotCoordinateTransformer;
use Illuminate\Http\Request;

class RobotCoordinateController extends Controller
{
    private $robotCoordinateTransformer;
    private $gateService;

    public function __construct(RobotCoordinateTransformer $robotCoordinateTransformer, GateService $gateService)
    {
        $this->robotCoordinateTransformer = $robotCoordinateTransformer;
        $this->gateService = $gateService;
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
        $this->gateService->userIdCheck($id);

        $coordinate = $this->robotCoordinateTransformer->transformInstance(RobotCoordinate::find((int)$id));

        return new RobotCoordinateCollection($coordinate);
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
