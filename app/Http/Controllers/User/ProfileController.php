<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use DB;

class ProfileController extends Controller
{
    //__User logout method__//
    public function Logout()
    {
        Auth::logout();
        $notification = array('message' => 'You are logged out!','alert-type'=>'warning' );
        return redirect()->route('login')->with($notification);
    }

    //__user password change method__//
    public function passwordchange()
    {
        return view('customer.password-change');
    }

    //__user password update method__//
    public function updatePassword(Request $request)
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
           return redirect()->route('login')->with($notification);
        }else{
            $notification=array('message' => 'old password not matched!', 'alert-type' => 'error'); 
            return redirect()->back()->with($notification);
        }
    }

    //__user review method__//
    public function Review()
    {
        $check=DB::table('user_review')->where('user_id',Auth::id())->first();
        if ($check) {
            return view('customer.review_page',compact('check'));
        }
        return view('customer.review_page');
    }

    //__user review store method__//
    public function Store(Request $request)
    {
        $validated = $request->validate([
            'rating' => 'required',
            'message' => 'required',
        ]);
        $data=array();
        $data['user_id']=Auth::id();
        $data['rating']=$request->rating;
        $data['message']=$request->message;
        $data['date']=date('d , F Y');

        DB::table('user_review')->insert($data);
        $notification = array('message' => 'Thanks For Review!','alert-type'=>'success' );
        return redirect()->route('home')->with($notification);
    }

    //__user review update method__//
    public function Update(Request $request)
    {
        $data=array();
        $data['user_id']=Auth::id();
        $data['rating']=$request->rating;
        $data['message']=$request->message;
        $data['date']=date('d , F Y');

        DB::table('user_review')->update($data);
        $notification = array('message' => 'Successfully Review Updated!','alert-type'=>'success' );
        return redirect()->route('home')->with($notification);  
    }
   
}
