<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Cart;
use Session;
use DB;
use Mail;
use App\Mail\InvoiceMail;

class ChackoutController extends Controller
{
    //__Chackout method__//
    public function Chackout()
    {
        if (!Auth::check()) {
            $notification=array('message' => 'Login Your Account!','alert-type' => 'error'); 
            return redirect()->route('login')->with($notification);
        }
        $content=Cart::content();
        return view('customer.chackout',compact('content'));
    }

    //apply coupon method__//
    public function ApplyCoupon(Request $request)
    {
        $chack=DB::table('coupons')->where('coupon_code',$request->coupon)->first();
        if ($chack) {
            if (date('Y-m-d' , strtotime(date('d-m-Y'))) <= date('Y-m-d' , strtotime($chack->valid_date))) {
                session::put('coupon', [
                    'name'=>$chack->coupon_code,
                    'discount'=>$chack->coupon_amount,
                    'after_discount'=>Cart::subtotal() - $chack->coupon_amount
                ]);
                $notification=array('message' => 'Coupon Applied!','alert-type' => 'success'); 
                return redirect()->back()->with($notification);
            }else{
                $notification=array('message' => 'Expire coupon code!','alert-type' => 'error'); 
                return redirect()->back()->with($notification);
            }
        }else{
            $notification=array('message' => 'Invalid coupon code! try again','alert-type' => 'error'); 
            return redirect()->back()->with($notification);
        }
    }

    // __removeCoupon method__//
    public function removeCoupon($value='')
    {
        Session::forget('coupon');
        $notification=array('message' => 'Coupon Removed!','alert-type' => 'success'); 
        return redirect()->back()->with($notification);
    }

    //__order place method__//
    public function OrderPlace(Request $request)
    {
        if($request->payment_type=="Hand Cash"){
            $order=array();
            $order['user_id']=Auth::id();
            $order['c_name']=$request->c_name;
            $order['c_phone']=$request->c_phone;
            $order['c_email']=$request->c_email;
            $order['c_address']=$request->c_address;
            $order['country']=$request->country;
            $order['city']=$request->city;
            $order['zip_code']=$request->zip_code;
            $order['exter_phone']=$request->exter_phone;
            if(Session::has('coupon')){
                $order['subtotal']=Cart::subtotal();
                $order['coupon_code']=Session::get('coupon')['name'];
                $order['coupon_discount']=Session::get('coupon')['discount'];
                $order['after_discount']=Session::get('coupon')['after_discount'];
            }else{
                $order['subtotal']=Cart::subtotal();
            }
            $order['total']=Cart::total();
            $order['payment_type']=$request->payment_type;
            $order['tax']=0;
            $order['shipping_charge']=0;
            $order['order_id']=rand(10000,900000);
            $order['status']=0;
            $order['date']=date('d-m-Y');
            $order['month']=date('F');
            $order['year']=date('Y');

            $order_id=DB::table('orders')->insertGetId($order);
            Mail::to($request->c_email)->send(new Invoicemail($order));

            //__order detalis__//
            $content=Cart::content();

            $details=array();
            foreach($content as $row){
                $details['order_id']=$order_id;
                $details['product_id']=$row->id;
                $details['product_name']=$row->name;
                $details['color']=$row->options->color;
                $details['size']=$row->options->size;
                $details['quantity']=$row->qty;
                $details['single_price']=$row->price;
                $details['subtotal_price']=$row->price*$row->qty;

                DB::table('order_details')->insert($details);
            }
            Cart::destroy();
            if (Session::has('coupon')) {
                Session::forget('coupon');
            }
            $notification=array('message' => 'successfully Order Placed!','alert-type' => 'success'); 
            return redirect()->to('/')->with($notification);
            //__aamerpay payment gateway__//
        }elseif($request->payment_type=="Aamerpay"){
            $aamerpay=DB::table('payment_gateway_bd')->first();
            if($aamerpay->store_id==NULL){
                $notification=array('message' => 'Please setting your payment gateway!','alert-type' => 'error'); 
                return redirect()->to('home')->with($notification);
            }else{
                if ($aamerpay->status==1) {
                    $url="https://secure.aamarpay.com/jsonpost.php"; // for Live Transection
                }else{
                     $url = "https://sandbox.aamarpay.com/jsonpost.php";
                }
                 $tran_id = "test".rand(1111111,9999999);//unique transection id for every transection 

                $currency= "BDT"; //aamarPay support Two type of currency USD & BDT  

                $amount = Cart::total();   //10 taka is the minimum amount for show card option in aamarPay payment gateway
                
                //For live Store Id & Signature Key please mail to support@aamarpay.com
                $store_id = $aamerpay->store_id; 

                $signature_key = $aamerpay->signature_key; 
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
                    "store_id": "'.$store_id.'",
                    "tran_id": "'.$tran_id.'",
                    "success_url": "'.route('success').'",
                    "fail_url": "'.route('fail').'",
                    "cancel_url": "'.route('cancel').'",
                    "amount": "'.$amount.'",
                    "currency": "'.$currency.'",
                    "signature_key": "'.$signature_key.'",
                    "desc": "Merchant Registration Payment",
                    "cus_name": "'.$request->c_name.'",
                    "cus_email": "'.$request->c_email.'",
                    "cus_add1": "'.$request->c_address.'",
                    "cus_add2": "'.$request->c_address.'",
                    "cus_city": "'.$request->city.'",
                    "cus_state": "'.$request->city.'",
                    "cus_postcode": "'.$request->zip_code.'",
                    "cus_country": "'.$request->country.'",
                    "cus_phone": "'.$request->c_phone.'",
                    "opt_a": "'.$request->c_address.'",
                    "opt_b": "'.$request->city.'",
                    "opt_c":  "'.$request->zip_code.'",
                    "opt_d": "'.$request->country.'",
                    "type": "json"
                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                // dd($response);
                
                $responseObj = json_decode($response);

                if(isset($responseObj->payment_url) && !empty($responseObj->payment_url)) {

                    $paymentUrl = $responseObj->payment_url;
                    // dd($paymentUrl);
                    return redirect()->away($paymentUrl);

                }else{
                    echo $response;
                }
            }
        }
        
    }
    //__payment gateway exter method
    public function success(Request $request){

        $order=array();
        $order['user_id']=Auth::id();
        $order['c_name']=$request->cus_name;
        $order['c_phone']=$request->cus_phone;
        $order['c_email']=$request->cus_email;
        $order['c_address']=$request->opt_a;
        $order['country']=$request->opt_d;
        $order['city']=$request->opt_b;
        $order['zip_code']=$request->opt_c;
        if(Session::has('coupon')){
            $order['subtotal']=Cart::subtotal();
            $order['coupon_code']=Session::get('coupon')['name'];
            $order['coupon_discount']=Session::get('coupon')['discount'];
            $order['after_discount']=Session::get('coupon')['after_discount'];
        }else{
            $order['subtotal']=Cart::subtotal();
        }
        $order['total']=Cart::total();
        $order['payment_type']='Aamerpay';
        $order['tax']=0;
        $order['shipping_charge']=0;
        $order['order_id']=rand(10000,900000);
        $order['status']=1;
        $order['date']=date('d-m-Y');
        $order['month']=date('F');
        $order['year']=date('Y');

        $order_id=DB::table('orders')->insertGetId($order);
        Mail::to(Auth::user()->email)->send(new Invoicemail($order));

        //__order detalis__//
        $content=Cart::content();

        $details=array();
        foreach($content as $row){
            $details['order_id']=$order_id;
            $details['product_id']=$row->id;
            $details['product_name']=$row->name;
            $details['color']=$row->options->color;
            $details['size']=$row->options->size;
            $details['quantity']=$row->qty;
            $details['single_price']=$row->price;
            $details['subtotal_price']=$row->price*$row->qty;

            DB::table('order_details')->insert($details);
        }
        Cart::destroy();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $notification=array('message' => 'successfully Order Placed!','alert-type' => 'success'); 
        return redirect()->route('home')->with($notification);

    }

    public function fail(Request $request){
        return $request;
    }

    public function cancel(){
        $notification=array('message' => 'Error!','alert-type' => 'error'); 
        return redirect()->to('/')->with($notification);
    }
}
