<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Models\Admin\Category;
use App\Models\Admin\Subcategory;
use Illuminate\Support\Str;
use Image;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index method
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=Subcategory::all();
            $imgurl=asset('public/files/subcategory/');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('category_name',function($row){
                    return $row->category->category_name;
                })
                ->editColumn('image', function($row) use($imgurl){
                    return '<img src="'.$imgurl.'/'.$row->image.'" height="30" />';
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('subcategory.delete',[$row->id]).'" class="m-1" id="subcategory_delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','image','category_name'])
                ->make(true); 
        }
        $category=Category::all();
        return view('admin.subcategory.index',compact('category'));
    }

    //store method 
    public function store(Request $request)
    {
       $validated = $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required|max:255',
        ]);
       
        $data=array();
        $data['category_id']=$request->category_id;
        $data['subcategory_name']=$request->subcategory_name;
        $data['slug']=Str::slug($request->subcategory_name, '-');

        $image=$request->image;
        $imagename=uniqid().'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(115,85)->save('public/files/subcategory/'. $imagename);
        $data['image']=$imagename;

        DB::table('subcategories')->insert($data);
        return response()->json('successfuly subcategory inserted!');
    }

    //edit method------
    public function edit($id)
    {
        $data=DB::table('subcategories')->where('id',$id)->first();
        $category=DB::table('categories')->get();
        return view('admin.subcategory.edit',compact('data','category'));
    }

    //update method--------
    public function update(Request $request)
    {
        $data=array();
        $data['category_id']=$request->category_id;
        $data['subcategory_name']=$request->subcategory_name;
        $data['slug']=Str::slug($request->subcategory_name, '-');

        if ($request->image ) {
            $image=$request->image ;
            $imagename=uniqid().'.'.$image->getClientOriginalExtension();
            Image::make($image )->resize(115,85)->save('public/files/subcategory/'. $imagename);
            $data['image']=$imagename;
        }else{
            $data['image']=$request->old_image;
        }

        DB::table('subcategories')->where('id',$request->id)->update($data);
        return response()->json('successfuly subcategory updated!');
    }

    //delete method----
    public function destroy($id)
    {
        DB::table('subcategories')->where('id',$id)->delete();
        return response()->json('successfuly subcategory deleted!');
    }
}
