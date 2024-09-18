<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Models\Admin\Category;
use Illuminate\Support\Str;
use Image;
use File;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index method
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $imgurl=asset('public/files/category/');
            $data=DB::table('categories')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function($row) use($imgurl){
                    return '<img src="'.$imgurl.'/'.$row->image.'" width="30" height="30" />';
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('category.delete',[$row->id]).'" class="m-1" id="category_delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','image'])
                ->make(true);  
        }
       return view('admin.category.index');
    }

    //store method----
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required',
        ]);

        $data=array();
        $data['category_name']=$request->category_name;
        $data['slug']=Str::slug($request->category_name,'-');

        $image=$request->image;
        $imagename=uniqid().'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(240,120)->save('public/files/category/'. $imagename);
        $data['image']=$imagename;


        DB::table('categories')->insert($data);
        return response()->json('successfuly category insert!');
    }

    //edit method
    public function edit($id)
    {
        $data=DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit',compact('data'));
    }

    //update method-------
    public function update(Request $request)
    {
        $data=array();
        $data['category_name']=$request->category_name;
        $data['slug']=Str::slug($request->category_name,'-');

        if ($request->image) {
            $old_image='public/files/category/'.$request->old_image;
            if (File::exists($old_image)) {
                File::delete($old_image);
            }
            $image=$request->image;
            $imagename=uniqid().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(240,120)->save('public/files/category/'. $imagename);
            $data['image']=$imagename;
        }else{
            $data['image']=$request->old_image;
        }

        DB::table('categories')->where('id',$request->id)->update($data);
        return response()->json('successfuly category updated!');
    }

    //delete method------
    public function destroy($id)
    {
        DB::table('categories')->where('id',$id)->delete();
        return response()->json('successfuly category delete!');
    }

}
