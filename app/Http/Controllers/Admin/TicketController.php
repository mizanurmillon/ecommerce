<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Image;

class TicketController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__ticket index method__//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $ticket="";
            $query=DB::table('tickets')->leftJoin('users','tickets.user_id','users.id');
                if($request->service=='Technicel')
                {
                    $query->where('tickets.service',$request->service);
                }
                if($request->service=='Payment')
                {
                    $query->where('tickets.service',$request->service);
                }
                if($request->service=='Affiliate')
                {
                    $query->where('tickets.service',$request->service);
                }
                if($request->service=='Return')
                {
                    $query->where('tickets.service',$request->service);
                }
                if($request->service=='Refund')
                {
                    $query->where('tickets.service',$request->service);
                }
                if($request->date)
                {
                    $tickets_date=date('d-m-Y',strtotime($request->date));
                    $query->where('tickets.date',$tickets_date);
                }
                if ($request->status==1) 
                {
                    $query->where('tickets.status',1);
                }
                if ($request->status==0) 
                {
                    $query->where('tickets.status',0);
                }
                if ($request->status==2) 
                {
                    $query->where('tickets.status',2);
                }
            $ticket=$query->select('tickets.*','users.name')->get();
            return DataTables::of($ticket)
                ->addIndexColumn()
                ->editColumn('status', function ($row){
                    if ($row->status==1) {
                        return '<span class="badge badge-success">Replied</span>';
                    }elseif($row->status==2){
                        return '<span class="badge badge-danger">Close</span>';
                    }else{
                        return '<span class="badge badge-info">Pending</span>';
                    }
                })
                ->editColumn('date', function ($row){
                    return date('d F Y',strtotime($row->date));
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="'.route('ticket.show',[$row->id]).'" class="m-1"><i class="fa fa-eye text-success"></i></a>
                    <a href="'.route('ticket.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','status','date'])
                ->make(true);
        }
        return view('admin.ticket.index'); 
    }

    //__ticket show method__//
    public function Show($id)
    {
        $ticket=DB::table('tickets')->leftJoin('users','tickets.user_id','users.id')->select('tickets.*','users.name')->where('tickets.id',$id)->first();
        return view('admin.ticket.ticket_view',compact('ticket'));
    }

    //__ticket reply store method__//
    public function storeTicket(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required',
        ]);

        $data=array();
        $data['user_id']=0;
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
        DB::table('tickets')->where('id',$request->ticket_id)->update(['status'=>1]);
        $notification=array('message' => 'Replied Done!','alert-type' => 'success'); 
        return redirect()->back()->with($notification);
    }

    //__close ticket method__//
    public function CloseTicket($id)
    {
        DB::table('tickets')->where('id',$id)->update(['status'=>2]);
        $notification=array('message' => 'Ticket Closed!','alert-type' => 'success'); 
        return redirect()->route('index.ticket')->with($notification);
    }

    //__ticket delete method__//
    public function destroy($id)
    {
        DB::table('tickets')->where('id',$id)->delete();
        return response()->json('ticket delete successfully');
     } 

}
