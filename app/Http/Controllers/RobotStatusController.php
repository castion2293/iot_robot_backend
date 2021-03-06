<?php

namespace App\Http\Controllers;

use App\Http\Resources\RobotTotalStatusCollection;
use App\RobotStatus;
use App\Services\GateService;
use App\Transformers\RobotStatusTransformer;
use Auth;
use Illuminate\Http\Request;

class RobotStatusController extends Controller
{
    private $robotStatusTransformer;
    private $gateService;

    /**
     * RobotStatusController constructor.
     * @param RobotStatusTransformer $robotStatusTransformer
     */
    public function __construct(RobotStatusTransformer $robotStatusTransformer, GateService $gateService)
    {

        $this->robotStatusTransformer = $robotStatusTransformer;
        $this->gateService = $gateService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Auth::user()->products()->get();

        $statuses = $products->map(function ($product) {
            $status = $this->robotStatusTransformer->transformInstance(RobotStatus::find($product->product_id));

            $status->put('name', $product->name)
                ->put('photo', $product->photo);

            return $status;
        });

        return new RobotTotalStatusCollection($statuses);
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

        $status = $this->robotStatusTransformer->transformInstance(RobotStatus::find((int)$id));

        $product = Auth::user()->products->where('product_id', $id)->first();

        $status->put('name', $product->name)
            ->put('photo', $product->photo);

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
