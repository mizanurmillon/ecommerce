<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Auth;
use Mail;
use App\Mail\RecievedMail;
use App\Mail\ShippedMail;
use App\Mail\CompletedMail;
use App\Mail\ReturnMail;
use App\Mail\CancelMail;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__order index method__//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $order="";
            $query=DB::table('orders')->orderBy('id','DESC');

                if($request->payment_type)
                {
                    $query->where('payment_type',$request->payment_type);
                }
                if($request->date)
                {
                    $order_date=date('d-m-Y',strtotime($request->date));
                    $query->where('date',$order_date);
                }
               if($request->status==0)
               {
                $query->where('status',0);
               }
               if($request->status==1)
               {
                $query->where('status',1);
               }
               if($request->status==2)
               {
                $query->where('status',2);
               }
               if($request->status==3)
               {
                $query->where('status',3);
               }
               if($request->status==4)
               {
                $query->where('status',4);
               }
               if($request->status==5)
               {
                $query->where('status',5);
               }

            $order=$query->get();

            return DataTables::of($order)
                ->addIndexColumn()
                ->editColumn('status', function ($row){

                    if ($row->status==0) {
                        return '<span class="badge badge-danger">Order Pending</span></a>';
                    }elseif($row->status==1){
                        return '<span class="badge badge-info">Order Recieved</span></a>';
                    }elseif($row->status==2){
                        return '<span class="badge badge-primary">Order Shipped</span></a>';
                    }elseif($row->status==3){
                        return '<span class="badge badge-success">Order Completed</span></a>';
                    }elseif($row->status==4){
                        return '<span class="badge badge-warning">Order Return</span></a>';
                    }elseif($row->status==5){
                        return '<span class="badge badge-danger">Order Cancel</span></a>';
                    }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 view" data-toggle="modal" data-target="#ViewModal"><i class="fa fa-eye text-success"></i></a>
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-toggle="modal" data-target="#EditModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('order.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
        return view('admin.order.index');
    }

    //__order recieved method__//
    public function orderRecieved(Request $request)
    {
        if ($request->ajax()) {
            $order=DB::table('orders')->where('status',1)->orderBy('id','DESC')->get();
            return DataTables::of($order)
                ->addIndexColumn()
                ->editColumn('status', function ($row){

                    if ($row->status==0) {
                        return '<span class="badge badge-danger">Order Pending</span></a>';
                    }elseif($row->status==1){
                        return '<span class="badge badge-info">Order Recieved</span></a>';
                    }elseif($row->status==2){
                        return '<span class="badge badge-primary">Order Shipped</span></a>';
                    }elseif($row->status==3){
                        return '<span class="badge badge-success">Order Completed</span></a>';
                    }elseif($row->status==4){
                        return '<span class="badge badge-warning">Order Return</span></a>';
                    }elseif($row->status==5){
                        return '<span class="badge badge-danger">Order Cancel</span></a>';
                    }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 view" data-toggle="modal" data-target="#ViewModal"><i class="fa fa-eye text-success"></i></a>
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-toggle="modal" data-target="#EditModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('order.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
        return view('admin.order.order_recieved');
    }

    //__order edit method__//
    public function Edit($id)
    {
        $data=DB::table('orders')->where('id',$id)->first();
        return view('admin.order.edit',compact('data'));
    }

    //__order Details method__//
    public function orderDetails($id)
    {
        $order=DB::table('orders')->where('id',$id)->first();
        $order_details=DB::table('order_details')->where('order_id',$id)->get();
        return view('admin.order.order_details',compact('order','order_details'));
    }

    //__order update method__//
    public function update(Request $request)
    {
        $data=array();
        $data['c_name']=$request->c_name;
        $data['c_phone']=$request->c_phone;
        $data['c_email']=$request->c_email;
        $data['c_address']=$request->c_address;
        $data['status']=$request->status;
        //__Mail__
        if($request->status==1){
            Mail::to($request->c_email)->send(new RecievedMail($data));
        }
        if($request->status==2){
            Mail::to($request->c_email)->send(new ShippedMail($data));
        }
        if($request->status==3){
            Mail::to($request->c_email)->send(new CompletedMail($data));
        }
        if($request->status==4){
            Mail::to($request->c_email)->send(new ReturnMail($data));
        }
        if($request->status==5){
            Mail::to($request->c_email)->send(new CancelMail($data));
        }
        DB::table('orders')->where('id',$request->id)->update($data);
        return response()->json('Successfully Change Status!');
    }

    //__order delete method__//
    public function destroy($id)
    {
        $order=DB::table('orders')->where('id',$id)->delete();
        $order_details=DB::table('order_details')->where('order_id',$id)->delete();
        return response()->json('order deleted!');
    }

    //__order report method__//
    public function orderReport(Request $request)
    {
        if ($request->ajax()) {
            $order="";
            $query=DB::table('orders')->orderBy('id','DESC');

                if($request->payment_type)
                {
                    $query->where('payment_type',$request->payment_type);
                }
                if($request->date)
                {
                    $order_date=date('d-m-Y',strtotime($request->date));
                    $query->where('date',$order_date);
                }
               if($request->status==0)
               {
                $query->where('status',0);
               }
               if($request->status==1)
               {
                $query->where('status',1);
               }
               if($request->status==2)
               {
                $query->where('status',2);
               }
               if($request->status==3)
               {
                $query->where('status',3);
               }
               if($request->status==4)
               {
                $query->where('status',4);
               }
               if($request->status==5)
               {
                $query->where('status',5);
               }
            $order=$query->get();
            return DataTables::of($order)
                ->addIndexColumn()
                ->editColumn('status', function ($row){

                    if ($row->status==0) {
                        return '<span class="badge badge-danger">Order Pending</span></a>';
                    }elseif($row->status==1){
                        return '<span class="badge badge-info">Order Recieved</span></a>';
                    }elseif($row->status==2){
                        return '<span class="badge badge-primary">Order Shipped</span></a>';
                    }elseif($row->status==3){
                        return '<span class="badge badge-success">Order Completed</span></a>';
                    }elseif($row->status==4){
                        return '<span class="badge badge-warning">Order Return</span></a>';
                    }elseif($row->status==5){
                        return '<span class="badge badge-danger">Order Cancel</span></a>';
                    }
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
        return view('admin.report.order_report.index');
    }

    //__order report print method__//
    public function orderReportPrint(Request $request)
    {
        if ($request->ajax()) {
            $order="";
            $query=DB::table('orders')->orderBy('id','DESC');

                if($request->payment_type)
                {
                    $query->where('payment_type',$request->payment_type);
                }
                if($request->date)
                {
                    $order_date=date('d-m-Y',strtotime($request->date));
                    $query->where('date',$order_date);
                }
               if($request->status==0)
               {
                $query->where('status',0);
               }
               if($request->status==1)
               {
                $query->where('status',1);
               }
               if($request->status==2)
               {
                $query->where('status',2);
               }
               if($request->status==3)
               {
                $query->where('status',3);
               }
               if($request->status==4)
               {
                $query->where('status',4);
               }
               if($request->status==5)
               {
                $query->where('status',5);
               }
            $order=$query->get();
        }
        return view('admin.report.order_report.print',compact('order'));
    }
}
