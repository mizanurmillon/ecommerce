<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!Auth::user()->is_admin==1) {
            $order=DB::table('orders')->where('user_id',Auth::id())->orderBy('id','DESC')->take(5)->get();
            // //total order
            $total_order=DB::table('orders')->where('user_id',Auth::id())->count();
            $complete_order=DB::table('orders')->where('user_id',Auth::id())->where('status',3)->count();
            $cancel_order=DB::table('orders')->where('user_id',Auth::id())->where('status',5)->count();
            return view('home',compact('order','total_order','complete_order','cancel_order'));
        }else{
            return redirect()->back();
        }
    }

    //__my order method__//
    public function MyOrder()
    {
        $orders=DB::table('orders')->where('user_id',Auth::id())->orderBy('id','DESC')->get();
        return view('customer.my_order',compact('orders'));
    }

    //__order view method__//
    public function orderView($id)
    {
       $order=DB::table('orders')->where('id',$id)->first();
       $order_details=DB::table('order_details')->where('order_id',$id)->get();
       return view('customer.order_details',compact('order','order_details'));
    }


    //__support Ticket method__//
    public function Ticket()
    {
        $ticket=DB::table('tickets')->where('user_id',Auth::id())->orderBy('id','DESC')->take(10)->get();
        return view('customer.support_ticket',compact('ticket'));
    }

    //__New Ticket page method__//
    public function NewTicket()
    {
        return view('customer.new_ticket');
    }
    //__store ticket method__//
    public function StoreTicket(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        $data=array();
        $data['user_id']=Auth::id();
        $data['subject']=$request->subject;
        $data['service']=$request->service;
        $data['prortity']=$request->prortity;
        $data['message']=$request->message;
        $data['status']=0;
        $data['date']=date('d-m-Y');

        if($request->image){
            $image=$request->image;
            $imagename=uniqid().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(600,350)->save('public/files/ticket/'. $imagename);
            $data['image']=$imagename;
        }
        DB::table('tickets')->insert($data);
        $notification=array('message' => 'Ticket Added successfully!','alert-type' => 'success'); 
        return redirect()->route('support.ticket')->with($notification);
    }

    //__view ticket method__//
    public function ViewTicket($id)
    {
        $view_ticket=DB::table('tickets')->where('id',$id)->first();
        return view('customer.view_ticket',compact('view_ticket'));
    }

    //__reply ticket method__//
    public function ReplyTicket(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required',
        ]);

        $data=array();
        $data['user_id']=Auth::id();
        $data['message']=$request->message;
        $data['ticket_id']=$request->ticket_id;
        $data['reply_date']=date('d-m-Y');

        if($request->image){
            $image=$request->image;
            $imagename=uniqid().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(600,350)->save('public/files/ticket/'. $imagename);
            $data['image']=$imagename;
        }
        DB::table('replies')->insert($data);
        DB::table('tickets')->where('id',$request->ticket_id)->update(['status'=>0]);
        $notification=array('message' => 'Replied Done!','alert-type' => 'success'); 
        return redirect()->back()->with($notification);
    }
}
