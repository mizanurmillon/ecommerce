<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Models\Admin\Brand;
use Illuminate\Support\Str;
use Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index method
    public function index(Request $request)
    {
       if ($request->ajax()) {
            $data=Brand::all();
            $imgurl=asset('public/files/brand/');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row){
                    if ($row->status==1) {
                        return '<span class="badge badge-success">Active</span>';
                    }else{
                        return '<span class="badge badge-danger">Deactive</span>';
                    }
                })
                ->editColumn('brand_logo', function($row) use($imgurl){
                    return '<img src="'.$imgurl.'/'.$row->brand_logo.'" height="25" />';
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('brand.delete',[$row->id]).'" class="m-1" id="brand_delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','brand_logo','status'])
                ->make(true); 
        }
        return view('admin.brand.index');
    }

    //brand store method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required',
            'brand_logo' => 'required',
        ]);

        $data=array();
        $data['brand_name']=$request->brand_name;
        $data['slug']=Str::slug($request->brand_name,'-');
        $data['status']=$request->status;

        $logo=$request->brand_logo;
        $logoname=uniqid().'.'.$logo->getClientOriginalExtension();
        Image::make($logo)->resize(240,120)->save('public/files/brand/'. $logoname);
        $data['brand_logo']=$logoname;

        DB::table('brands')->insert($data);
        return response()->json('successfuly brand inserted!');
    }

    //edit method
    public function edit($id)
    {
       $data=DB::table('brands')->where('id',$id)->first();
       return view('admin.brand.edit',compact('data'));
    }

    //update method
    public function update(Request $request)
    {
        $data=array();
        $data['brand_name']=$request->brand_name;
        $data['slug']=Str::slug($request->brand_name,'-');
        $data['status']=$request->status;

        if ($request->brand_logo) {
            $logo=$request->brand_logo;
            $logoname=uniqid().'.'.$logo->getClientOriginalExtension();
            Image::make($logo)->resize(240,120)->save('public/files/brand/'. $logoname);
            $data['brand_logo']=$logoname;
        }else{
            $data['brand_logo']=$request->old_brand_logo;
        }
        DB::table('brands')->where('id',$request->id)->update($data);
        return response()->json('successfuly brand updated!');
    }
    //delete method
    public function destroy($id)
    {
        DB::table('brands')->where('id',$id)->delete();
        return response()->json('successfuly deleted!');
    }
}
