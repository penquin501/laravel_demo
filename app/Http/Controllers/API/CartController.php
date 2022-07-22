<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('index', 'show', 'store', 'update', 'destroy');
        // $this->middleware('can:delete, category')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listCart = auth()->user()->products()->latest()->get();
        $sumPrice = auth()->user()->products()->sum('products.price');
        $sumQty = \App\Models\Cart::where('user_id', auth()->user()->id)->sum('qty');

        return response()->json(['listCart' => $listCart, 'sumPrice' => $sumPrice, 'sumQty' => $sumQty], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // auth()->user()->products()->attach($request->product_id); //insert
        // auth()->user()->products()->detach($request->product_id); //delete
        // auth()->user()->products()->sync($request->product_id); //ลบข้อมูลก่อนแล้ว insert แบบ เช็คข้อมูลซ้ำ
        // auth()->user()->products()->syncWithoutDetaching($request->product_id); //insert แบบ เช็คข้อมูลซ้ำ
        // return response()->json(['status'=>'inserted data'], 201);

        $cart = auth()->user()->products()->where('products.id', $request->product_id)->first();
        if (isset($cart)) {
            //update
            auth()->user()->products()->syncWithoutDetaching([$request->product_id => ['qty' => $cart->pivot->qty + $request->qty]]); //insert แบบ เช็คข้อมูลซ้ำ
        } else {
            //insert
            auth()->user()->products()->syncWithoutDetaching([$request->product_id => ['qty' => $request->qty]]); //insert แบบ เช็คข้อมูลซ้ำ
        }
        return $qty->pivot->qty;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
     * // carts/1
     */
    public function destroy($product_id)
    {
        auth()->user()->products()->detach($product_id);

        return response()->json(['status' => 'deleted success'], 200);
    }
}
