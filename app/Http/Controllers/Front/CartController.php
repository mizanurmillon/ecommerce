<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use App\Models\Admin\Products;
use DB;
use Auth;
use Session;

class CartController extends Controller
{
    
    public function addCart(Request $request)
    {
        $product=DB::table('products')->where('id',$request->id)->first();
        Cart::add([
            'id'=> $product->id,
            'name'=> $product->product_name, 
            'qty'=> $request->qty, 
            'price'=> $request->price, 
            'weight'=> 1, 
            'options'=> ['size' =>$request->size,'color' =>$request->color,'thumbnail' =>$product->thumbnail]
        ]);
        return response()->json('product added on cart!');
    }

    //__all cart method__//
    public function allCart()
    {
        $data=array();
        $data['cart_qty']=Cart::count();
        $data['cart_total']=Cart::total();
        return response()->json($data);
    }

    //__my cart method__//
    public function Mycart()
    {
        $content=Cart::content();
        return view('customer.cart',compact('content'));
    }

    //__Color Update method__//
    public function Color($rowId,$color)
    {
        $product=Cart::get($rowId);
        $thumbnail=$product->options->thumbnail;
        $size=$product->options->size;
        Cart::update($rowId,['options'=> ['color'=>$color,'size'=>$size,'thumbnail'=>$thumbnail]]);
        return response()->json('successfully updated color!');
    }
    //__Size update method__//
    public function Size($rowId,$size)
    {
        $product=Cart::get($rowId);
        $thumbnail=$product->options->thumbnail;
        $color=$product->options->color;
        Cart::update($rowId,['options'=> ['size'=>$size,'color'=>$color,'thumbnail'=>$thumbnail]]);
        return response()->json('successfully updated size!');
    }

    //__Qty update method__//
    public function Qty($rowId,$qty)
    {
        Cart::update($rowId,['qty'=>$qty]);
        return response()->json('successfully updated Qty!');
    }
    
    //__remove cart item method__//
    public function remove($rowId)
    {
        Cart::remove($rowId);
        return response()->json('Item remove on cart!');
    }
   
}
