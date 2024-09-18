<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Models\Admin\Category;
use App\Models\Admin\Subcategory;
use App\Models\Admin\Childcategory;
use Illuminate\Support\Str;

class ChildcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__childcategory index method___//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=Childcategory::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('category_name',function($row){
                    return $row->category->category_name;
                })
                ->editColumn('subcategory_name',function($row){
                    return $row->subcategory->subcategory_name;
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('childcategory.delete',[$row->id]).'" class="m-1" id="childcategory_delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','category_name','subcategory_name'])
                ->make(true); 
        }
        $category=Category::all();
        $subcategory=Subcategory::all();
        return view('admin.childcategory.index',compact('category','subcategory'));
    }

    //___childcategory store method__//
    public function store(Request $request)
    {
        $validated = $request->validate([
            'childcategory_name' => 'required',
        ]);

        $subcategory=DB::table('subcategories')->where('id',$request->subcategory_id)->first();
        $data=array();
        $data['category_id']=$subcategory->category_id;
        $data['subcategory_id']=$request->subcategory_id;
        $data['childcategory_name']=$request->childcategory_name;
        $data['slug']=Str::slug($request->childcategory_name,'-');

        DB::table('childcategories')->insert($data);
        return response()->json('successfuly inserted!');

    }

    //__childcategory edit method___//
    public function edit($id)
    {
        $data=DB::table('childcategories')->where('id',$id)->first();
        $category=DB::table('categories')->get();
        $subcategory=DB::table('subcategories')->get();

        return view('admin.childcategory.edit',compact('category','subcategory','data'));
    }

    //__childcategory update method__//
    public function update(Request $request)
    {
        $subcategory=DB::table('subcategories')->where('id',$request->subcategory_id)->first();
        $data=array();
        $data['category_id']=$subcategory->category_id;
        $data['subcategory_id']=$request->subcategory_id;
        $data['childcategory_name']=$request->childcategory_name;
        $data['slug']=Str::slug($request->childcategory_name,'-');

        DB::table('childcategories')->where('id',$request->id)->update($data);
        return response()->json('successfuly updated!');
    }

    //__childcategory delete method__//
    public function destroy($id)
    {
        DB::table('childcategories')->where('id',$id)->delete();
        return response()->json('successfuly childcategory deleted!');
    }
}
