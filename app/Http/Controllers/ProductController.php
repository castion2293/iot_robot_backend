<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductResetAvatarResquest;
use App\Http\Requests\ProductResetProfileRequest;
use App\Http\Resources\ProductCollection;
use App\Product;
use App\Services\GateService;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
use Storage;

class ProductController extends Controller
{
    private $gateService;

    public function __construct(GateService $gateService)
    {

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

        if(count($products)) {
            return new ProductCollection($products);
        }

        return response()->json(['error' => '目前沒有註冊任何產品，請登出並與我們聯絡!'], 401);
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
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->gateService->userIdCheck($product->product_id);

        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductResetProfileRequest $request, Product $product)
    {
        $this->gateService->userIdCheck($product->product_id);

        $product->update([
            'name' => $request->name,
            'group' => $request->group
        ]);

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function getProductCustomerSetting()
    {
        $this->gateService->userIdCheck(request('product_id'));

        $productCustomerSetting = Product::where('product_id', request('product_id'))
                                        ->first()
                                        ->customerSettings()
                                        ->first();

        return $productCustomerSetting;
    }

    public function resetProductCustomerSetting(Request $request)
    {
        $product = Product::find(request('product_id'));

        $this->gateService->userIdCheck($product->product_id);

        $product->customerSettings->update($request->all());

        return $product;
    }

    public function resetProductAvatar(ProductResetAvatarResquest $request)
    {
        $imageData = $request->get('avatar');
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        Storage::disk('s3')->put('/product_pics/'.$fileName, Image::make($imageData)->stream()->__toString(), 'public');

        $product = Product::find($request->id);

        if (!strpos($product->photo, 'default')) {
            $leng = strlen('https://s3-ap-northeast-1.amazonaws.com/iot-robot-front-pics');
            $oldpath = substr($product->photo, $leng);
            Storage::disk('s3')->delete($oldpath);
        }

        $product->update([
            'photo' => 'https://s3-ap-northeast-1.amazonaws.com/iot-robot-front-pics/product_pics/' . $fileName,
        ]);

        return $product;
    }
}
