<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index method--------
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=DB::table('coupons')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status',function($row){
                    if ($row->status=="Active") {
                       return '<span class="badge badge-success">Active</span>';
                    }else{
                        return '<span class="badge badge-danger">Inactive</span>';
                    }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('coupon.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true); 
        }
       return view('admin.coupon.index');
    }

    //store methode-------
    public function store(Request $request)
    {
        $validated = $request->validate([
            'coupon_code' => 'required',
            'coupon_amount' => 'required',
        ]);

        $data=array();
        $data['coupon_code']=$request->coupon_code;
        $data['type']=$request->type;
        $data['coupon_amount']=$request->coupon_amount;
        $data['valid_date']=$request->valid_date;
        $data['status']=$request->status;

        DB::table('coupons')->insert($data);
        return response()->json('successfuly coupons insert!');
    }

    //edit method------
    public function edit($id)
    {
        $data=DB::table('coupons')->where('id',$id)->first();
        return view('admin.coupon.edit',compact('data'));
    }

    //coupon update method------
    public function update(Request $request)
    {
        $data=array();
        $data['coupon_code']=$request->coupon_code;
        $data['type']=$request->type;
        $data['coupon_amount']=$request->coupon_amount;
        $data['valid_date']=$request->valid_date;
        $data['status']=$request->status;

        DB::table('coupons')->where('id',$request->id)->update($data);
        return response()->json('successfuly updated coupon!');
    }

    //delete method-----
    public function destroy($id)
    {
        DB::table('coupons')->where('id',$id)->delete();
        return response()->json('coupon deleted!');
    }


}
