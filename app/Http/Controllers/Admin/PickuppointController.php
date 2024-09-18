<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Models\Admin\Pickuppoint;

class PickuppointController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index method---------
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=Pickuppoint::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('pickuppoint.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true); 
        }
       return view('admin.pickuppoint.index');
    }

    //store method-------
    public function store(Request $request)
    {
        $data=array();
        $data['pickup_point_name']=$request->pickup_point_name;
        $data['pickup_point_address']=$request->pickup_point_address;
        $data['pickup_point_phone']=$request->pickup_point_phone;
        $data['pickup_point_phone_two']=$request->pickup_point_phone_two;

        DB::table('pickup_points')->insert($data);
        return response()->json('successfuly inserted pickup_point!');
    }

    //edit method-----------
    public function edit($id)
    {
       $data=DB::table('pickup_points')->where('id',$id)->first();
       return view('admin.pickuppoint.edit',compact('data'));
    }

    //update method---------
    public function update(Request $request)
    {
        $data=array();
        $data['pickup_point_name']=$request->pickup_point_name;
        $data['pickup_point_address']=$request->pickup_point_address;
        $data['pickup_point_phone']=$request->pickup_point_phone;
        $data['pickup_point_phone_two']=$request->pickup_point_phone_two;

        DB::table('pickup_points')->where('id',$request->id)->update($data);
        return response()->json('successfuly updated pickup_point!');
    }

    //delete method----------
    public function destroy($id)
    {
        DB::table('pickup_points')->where('id',$id)->delete();
        return response()->json('successfuly deleted pickup_point!');
    }
}
