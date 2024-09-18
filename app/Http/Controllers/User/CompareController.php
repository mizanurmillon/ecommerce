<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class CompareController extends Controller
{
    //__add Compare__//
    public function addcompare($id)
    {
        $product=DB::table('products')->where('id',$id)->first();
        if (Auth::check()) {
           $check=DB::table('compare')->where('product_id',$id)->where('user_id',Auth::id())->first();
            if ($check) {
                return response()->json(['error'=>'Allready Exist!']); 
            }else{
                $data=array();
                $data['user_id']=Auth::id();
                $data['product_id']=$id;
                $data['category_id']=$product->category_id;
                $data['brand_id']=$product->brand_id;
                $data['date']=date('d , F Y');
                DB::table('compare')->insert($data);
                return response()->json(['success'=>'Product Added on compare!']);
            } 
        }else{
            return response()->json(['error'=>'Please login frist!']);
        }
    }
    //__count Compare__//
    public function countCompare()
    {
        $data=array();
        $data['compare_count']=DB::table('compare')->where('user_id',Auth::id())->count();
        return response()->json($data);
    }
    //__show Compare__//
    public function Compare()
    {
        if (Auth::check()) {
            $compare=DB::table('compare')->leftJoin('products','compare.product_id','products.id')
                    ->leftJoin('categories','compare.category_id','categories.id')
                    ->leftJoin('brands','compare.brand_id','brands.id')
                    ->select('products.product_name','products.thumbnail','products.product_slug','products.selling_price','products.discount_price','categories.category_name','brands.brand_name','compare.*')
                    ->where('compare.user_id',Auth::id())->get();
            return view('customer.compare',compact('compare'));
        }
        $notification=array('message' => 'Login Your Account !','alert-type' => 'error'); 
        return redirect()->route('login')->with($notification);
    }

    // __compare remove__//
    public function remove()
    {
        DB::table('compare')->where('user_id',Auth::id())->delete();
        $notification=array('message' => 'Clear all compare products!','alert-type' => 'error'); 
        return redirect()->back()->with($notification);
    }
}
