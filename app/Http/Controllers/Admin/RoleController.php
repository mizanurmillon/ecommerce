<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__index method__//
    public function index()
    {
        $data=DB::table('users')->where('is_admin',1)->where('role_admin',1)->get();
        return view('admin.user_role.index',compact('data'));
    }

    //__User role create method__//
    public function create()
    {
        return view('admin.user_role.create_role');
    }

    //__User role store method__//
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['password']=Hash::make($request->password);
        $data['category']=$request->category;
        $data['product']=$request->product;
        $data['client_say']=$request->client_say;
        $data['support_ticket']=$request->support_ticket;
        $data['user_role']=$request->user_role;
        $data['order']=$request->order;
        $data['report']=$request->report;
        $data['setting']=$request->setting;
        $data['blog']=$request->blog;
        $data['is_admin']=1;
        $data['role_admin']=1;
        DB::table('users')->insert($data);
        $notification=array('message' => 'Role created!', 'alert-type' => 'success'); 
        return redirect()->back()->with($notification);

    }

    //__user role delete method__//
    public function destroy($id)
    {
        DB::table('users')->where('id',$id)->delete();
        $notification=array('message' => 'Role deleted!', 'alert-type' => 'warning'); 
        return redirect()->back()->with($notification);
    }
}
