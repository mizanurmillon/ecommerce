<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //___page method__//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=DB::table('pages')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-toggle="modal" data-target="#editModal" title="Edit"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('page.delete',[$row->id]).'" class="m-1" id="delete" title="Delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true); 
        }
       return view('admin.page.index');
    }

    //__page store__//
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'link' => 'required',
            'content' => 'required',
        ]);

        $data=array();
        $data['title']=$request->title;
        $data['page_slug']=Str::slug($request->title,'-');
        $data['link']=$request->link;
        $data['page_position']=$request->page_position;
        $data['content']=$request->content;

        DB::table('pages')->insert($data);
        return response()->json('successfuly page created!');
    }

    //__page edit method__//
    public function edit($id)
    {
        $data=DB::table('pages')->where('id',$id)->first();
        return view('admin.page.edit',compact('data'));
    }

    //__page update method__//
    public function update(Request $request)
    {
        $data=array();
        $data['title']=$request->title;
        $data['page_slug']=Str::slug($request->title,'-');
        $data['link']=$request->link;
        $data['page_position']=$request->page_position;
        $data['content']=$request->content;

        DB::table('pages')->where('id',$request->id)->update($data);
        return response()->json('successfuly page updated!');
    }

    //__page delete method__//
    public function destroy($id)
    {
       DB::table('pages')->where('id',$id)->delete();
       return response()->json('successfuly page deleted!');
    }
}
