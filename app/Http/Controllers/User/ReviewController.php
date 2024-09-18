<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class ReviewController extends Controller
{
    //___product review method___//
    public function store(Request $request)
    {
        $validated = $request->validate([
            'review' => 'required',
            'rating' => 'required',
        ]);

        $chack=DB::table('product_reviews')->where('user_id',Auth::id())->where('product_id',$request->product_id)->first();
        if($chack){
            return response()->json(['error'=>'Already you have a review with this product!']); 
        }
        $data=array();
        $data['user_id']=Auth::id();
        $data['product_id']=$request->product_id;
        $data['rating']=$request->rating;
        $data['summary']=$request->summary;
        $data['review']=$request->review;
        $data['review_date']=date('d-m-Y');
        $data['review_month']=date('F');
        $data['review_year']=date('Y');

        DB::table('product_reviews')->insert($data);
        return response()->json(['success'=>'Thank for your reviews!']);


    }
}
