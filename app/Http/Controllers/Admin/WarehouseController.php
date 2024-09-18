<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Models\Admin\Warehouse;

class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index method
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=Warehouse::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('warehouse.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true); 
        }
       return view('admin.warehouse.index');
    }

    //__warehouse store method__//
    public function store(Request $request)
    {
        $validated = $request->validate([
            'warehouse_name' => 'required',
            'warehouse_address' => 'required',
            'warehouse_phone' => 'required',
        ]);
        $data=array();
        $data['warehouse_name']=$request->warehouse_name;
        $data['warehouse_address']=$request->warehouse_address;
        $data['warehouse_phone']=$request->warehouse_phone;

        DB::table('warehouses')->insert($data);
        return response()->json('successfuly inserted warehouse!');
    }

    //__edit method__//
    public function edit($id)
    {
        $data=DB::table('warehouses')->where('id',$id)->first();
        return view('admin.warehouse.edit',compact('data'));
    }

    //___update method__//
    public function update(Request $request)
    {
        $data=array();
        $data['warehouse_name']=$request->warehouse_name;
        $data['warehouse_address']=$request->warehouse_address;
        $data['warehouse_phone']=$request->warehouse_phone;

        DB::table('warehouses')->where('id',$request->id)->update($data);
        return response()->json('successfuly updated warehouse!');
    }

    //__delete method___//
    public function destroy($id)
    {
        DB::table('warehouses')->where('id',$id)->delete();
        return response()->json('successfuly deleted!');
    }
}
