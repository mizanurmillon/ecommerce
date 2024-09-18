<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class WishlistController extends Controller
{
    public function addwishlist($id)
    {
        if (Auth::check()) {
           $check=DB::table('wishlist')->where('product_id',$id)->where('user_id',Auth::id())->first();
            if ($check) {
                return response()->json(['error'=>'Allready Exist!']); 
            }else{
                $data=array();
                $data['user_id']=Auth::id();
                $data['product_id']=$id;
                $data['date']=date('d , F Y');
                DB::table('wishlist')->insert($data);
                return response()->json(['success'=>'Product Added on wishlist!']);
            } 
        }else{
            return response()->json(['error'=>'Please login frist!']);
        }
    }

    public function wishlist()
    {
        if (Auth::check()) {
            $wishlist=DB::table('wishlist')->leftJoin('products','wishlist.product_id','products.id')
                    ->select('products.product_name','products.thumbnail','products.product_slug','products.selling_price','products.discount_price','wishlist.*')
                    ->where('wishlist.user_id',Auth::id())->get();
            return view('customer.wishlist',compact('wishlist'));
        }
        $notification=array('message' => 'Login Your Account !','alert-type' => 'error'); 
        return redirect()->route('login')->with($notification);
    }

    public function destroy()
    {
       DB::table('wishlist')->where('user_id',Auth::id())->delete();
       $notification=array('message' => 'Clear all wishlist!','alert-type' => 'error'); 
        return redirect()->back()->with($notification);
    }

    public function Remove($id)
    {
        DB::table('wishlist')->where('id',$id)->delete();
        $notification=array('message' => 'Item has been remove on wishlist!','alert-type' => 'error'); 
        return redirect()->back()->with($notification);
    }

    public function Count()
    {
        $data=array();
        $data['wishlist_count']=DB::table('wishlist')->where('user_id',Auth::id())->count();
        return response()->json($data);
    }
}
