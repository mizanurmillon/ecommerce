<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DataTables;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   //admin after login
    public function Admin()
    {
        return view('admin.home');
    }
    //admin logout
    public function AdminLogout()
    {
        Auth::logout();
        $notification = array('message' => 'You are logged out!','alert-type'=>'warning' );
        return redirect()->route('admin.login')->with($notification);
    }
    //password change method
    public function PasswordChange()
    {
        return view('admin.profile.password_change');
    }
    //password update method
    public function PasswordUpdate(Request $request)
    {
        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
        $current_password=Auth::user()->password;
        $oldpassword=$request->old_password;
        $password=$request->password;

        if (Hash::check($oldpassword , $current_password)) {
           $user=User::findorfail(Auth::id());
           $user->password=Hash::make($request->password);
           $user->save();
           Auth::logout();
           $notification=array('message' => 'Your Password Changed!', 'alert-type' => 'success');
           return redirect()->route('admin.login')->with($notification);
        }else{
            $notification=array('message' => 'old password not matched!', 'alert-type' => 'error'); 
            return redirect()->back()->with($notification);
        }
    }

    //__clinet pending review method___//
    public function pendingReview(Request $request)
    {
        if ($request->ajax()) {
            $data=DB::table('user_review')->leftJoin('users','user_review.user_id','users.id')->select('user_review.*','users.name')->where('user_review.status',0)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row){
                    if ($row->status==0) {
                        return '<span class="badge badge-danger">Pending</span>';
                    }else{
                        return '<span class="badge badge-success">Approved</span>';
                    }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('user.review.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true); 
        }
        return view('admin.client-review.client_review');
    }
    //__user review delete__//
    public function destroy($id)
    {
        DB::table('user_review')->where('id',$id)->delete();
        return response()->json('successfuly review deleted!');
    }

    //__user review edit method__//
    public function edit($id)
    {
        $data=DB::table('user_review')->leftJoin('users','user_review.user_id','users.id')->select('user_review.*','users.name')->where('user_review.id',$id)->first();
        return view('admin.client-review.edit',compact('data'));
    }

    //__user review update method__//
    public function reviewUpdate(Request $request)
    {
       $data=array();
       $data['status']=$request->status;

       DB::table('user_review')->where('id',$request->id)->update($data);
       return response()->json('successfuly user review updated!');
    }
}
