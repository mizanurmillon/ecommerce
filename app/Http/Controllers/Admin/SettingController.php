<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__seo setting page method__//
    public function seoSetting()
    {
        $data=DB::table('seos')->first();
        return view('admin.setting.seo.seo',compact('data'));
    }
    //__seo update method__//
    public function seoUpdate(Request $request, $id)
    {
        $data=array();
        $data['meta_title']=$request->meta_title;
        $data['meta_author']=$request->meta_author;
        $data['meta_tag']=$request->meta_tag;
        $data['meta_keyword']=$request->meta_keyword;
        $data['meta_description']=$request->meta_description;
        $data['google_verification']=$request->google_verification;
        $data['alexa_verification']=$request->alexa_verification;
        $data['google_analytics']=$request->google_analytics;
        $data['google_adsense']=$request->google_adsense;

        DB::table('seos')->where('id',$id)->update($data);
        $notification=array('message' => 'SEO Setting Updated!', 'alert-type' => 'success'); 
        return redirect()->back()->with($notification);
    }

    //__SMTP Setting Page method__//
    public function smtpSetting()
    {
       $data=DB::table('smtps')->first();
       return view('admin.setting.smtp.smtp',compact('data'));
    }
    //__SMTP update method__//
    public function smtpUpdate(Request $request,$id)
    {
        $data=array();
        $data['type']=$request->type;
        $data['mail_host']=$request->mail_host;
        $data['mail_port']=$request->mail_port;
        $data['mail_username']=$request->mail_username;
        $data['mail_password']=$request->mail_password;
        $data['mail_encryption']=$request->mail_encryption;
        $data['mail_from_address']=$request->mail_from_address;
        $data['mail_from_name']=$request->mail_from_name;

        DB::table('smtps')->where('id',$id)->update($data);
        $notification=array('message' => 'SMTP Setting Updated!', 'alert-type' => 'success'); 
        return redirect()->back()->with($notification);
    }

    //__website setting page__//
    public function websiteSetting()
    {
        $website=DB::table('websites')->first();
        return view('admin.setting.website.website',compact('website'));
    }
    //__website setting update method__//
    public function websiteUpdate(Request $request,$id)
    {
        $data=array();
        $data['currency']=$request->currency;
        $data['language']=$request->language;
        $data['phone_one']=$request->phone_one;
        $data['phone_tow']=$request->phone_tow;
        $data['main_email']=$request->main_email;
        $data['support_email']=$request->support_email;
        $data['address']=$request->address;
        $data['facebook']=$request->facebook;
        $data['twitter']=$request->twitter;
        $data['linkedin']=$request->linkedin;
        $data['youtube']=$request->youtube;
        $data['instagram']=$request->instagram;
        //__logo
        if ($request->logo ) {
            $logo=$request->logo ;
            $logoname=uniqid().'.'.$logo->getClientOriginalExtension();
            Image::make($logo )->resize(220,120)->save('public/files/logo/'. $logoname);
            $data['logo']=$logoname;
        }else{
            $data['logo']=$request->old_logo;
        }
        //__favicon
        if ($request->favicon ) {
            $favicon=$request->favicon ;
            $faviconname=uniqid().'.'.$favicon->getClientOriginalExtension();
            Image::make($favicon )->resize(32,32)->save('public/files/logo/'. $faviconname);
            $data['favicon']=$faviconname;
        }else{
            $data['favicon']=$request->old_favicon;
        }

        DB::table('websites')->where('id',$id)->update($data);
        $notification=array('message' => 'Website Setting Updated!', 'alert-type' => 'success'); 
        return redirect()->back()->with($notification);
    }

    //__Payment Geatway__//
    public function PaymentGeatway()
    {
        $aamerpay=DB::table('payment_gateway_bd')->first();
        $surjopay=DB::table('payment_gateway_bd')->skip(1)->first();
        $ssl=DB::table('payment_gateway_bd')->skip(2)->first();
        return view('admin.setting.bdpayment_gateway.edit',compact('aamerpay','surjopay','ssl'));
    }

    //__Update Aamerpay method__//
    public function UpdateAamerpay(Request $request)
    {
        $data=array();
        $data['store_id']=$request->store_id;
        $data['signature_key']=$request->signature_key;
        $data['status']=$request->status;
        DB::table('payment_gateway_bd')->where('id',$request->id)->update($data);
        $notification=array('message' => 'Payment Gateway Updated!', 'alert-type' => 'success'); 
        return redirect()->back()->with($notification);
    }

    //__Update Surjopay method__//
    public function UpdateSurjopay(Request $request)
    {
        $data=array();
        $data['store_id']=$request->store_id;
        $data['signature_key']=$request->signature_key;
        $data['status']=$request->status;
        DB::table('payment_gateway_bd')->where('id',$request->id)->update($data);
        $notification=array('message' => 'Payment Gateway Updated!', 'alert-type' => 'success'); 
        return redirect()->back()->with($notification);
    }

    //__Update SSL Commerz method__//
    public function UpdateSSL(Request $request)
    {
        $data=array();
        $data['store_id']=$request->store_id;
        $data['signature_key']=$request->signature_key;
        $data['status']=$request->status;
        DB::table('payment_gateway_bd')->where('id',$request->id)->update($data);
        $notification=array('message' => 'Payment Gateway Updated!', 'alert-type' => 'success'); 
        return redirect()->back()->with($notification);
    }
}
