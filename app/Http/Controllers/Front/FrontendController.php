<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Mail;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    public function index()
    {
        $category=DB::table('categories')->get();
        $brand=DB::table('brands')->where('brands.status',1)->get();
        $slider=DB::table('products')->leftJoin('categories','products.category_id','categories.id')
                ->leftJoin('subcategories','products.subcategory_id','subcategories.id')
                ->select('products.*','categories.category_name','subcategories.subcategory_name')
                ->where('status',1)->where('product_slider',1)->latest()->get();
        $today_deal=DB::table('products')->where('status',1)->where('today_deal',1)->latest()->first();
        $trending_product=DB::table('products')->where('status',1)->where('trendy',1)->orderBy('id','DESC')->limit(4)->get();
        $random_product=DB::table('products')->where('status',1)->inRandomOrder()->limit(4)->get();
        $featured_product=DB::table('products')->where('status',1)->where('featured',1)->orderBy('id','DESC')->limit(8)->get();

        return view('welcome',compact('category','brand','slider','today_deal','trending_product','random_product','featured_product')); 
    }

    //__product details method__//
    public function productDetails($product_slug)
    {
        $product=DB::table('products')->leftJoin('categories','products.category_id','categories.id')
                ->leftJoin('brands','products.brand_id','brands.id')->select('products.*','categories.category_name','brands.brand_name')->where('product_slug',$product_slug)->first();
                DB::table('products')->where('product_slug',$product_slug)->increment('product_views');
        $related_product=DB::table('products')->where('subcategory_id',$product->subcategory_id)->orderBy('id','DESC')->take(8)->get();
        $review=DB::table('product_reviews')->leftJoin('users','product_reviews.user_id','users.id')
                ->select('product_reviews.*','users.name')->where('product_id',$product->id)->orderBy('id','DESC')->limit(5)->get();
        $review_count=DB::table('product_reviews')->where('product_id',$product->id)->count();
        return view('customer.product_details',compact('product','related_product','review','review_count'));
    }

    //__Today Deal product details method__//
    public function TodayProduct($product_slug)
    {
        $product=DB::table('products')->leftJoin('categories','products.category_id','categories.id')
                ->leftJoin('brands','products.brand_id','brands.id')->select('products.*','categories.category_name','brands.brand_name')->where('product_slug',$product_slug)->first();
                DB::table('products')->where('product_slug',$product_slug)->increment('product_views');
        $related_product=DB::table('products')->where('subcategory_id',$product->subcategory_id)->orderBy('id','DESC')->take(8)->get();
        $review=DB::table('product_reviews')->leftJoin('users','product_reviews.user_id','users.id')
                ->select('product_reviews.*','users.name')->where('product_id',$product->id)->orderBy('id','DESC')->limit(5)->get();
        $review_count=DB::table('product_reviews')->where('product_id',$product->id)->count();
        return view('customer.today_product',compact('product','related_product','review','review_count'));
    }

    //__all product method__//
    public function allProduct()
    {
        $category=DB::table('categories')->get();
        $subcategory=DB::table('subcategories')->get();
        $brand=DB::table('brands')->get();
        $allproduct=DB::table('products')->where('status',1)->orderBy('id','DESC')->paginate(60);

        return view('customer.shop',compact('category','subcategory','brand','allproduct'));
    }

    //__all featured Product method__//
    public function featuredProduct()
    {
        $featured_product=DB::table('products')->where('featured',1)->where('status',1)->orderBy('id','DESC')->paginate(60);
        return view('customer.featured_product',compact('featured_product'));
    }

    //__Brandwise Product method__//
    public function BrandwiseProduct($id)
    {
        $brand=DB::table('brands')->where('id',$id)->first();
        $category=DB::table('categories')->get();
        $subcategory=DB::table('subcategories')->get();
        $brands=DB::table('brands')->get();
        $product=DB::table('products')->where('brand_id',$id)->orderBy('id','DESC')->paginate(60);

        return view('customer.brand',compact('brand','brands','category','subcategory','product'));
    }

    //__Categorywise Product method__//
    public function CategorywiseProduct($id)
    {
        $category=DB::table('categories')->where('id',$id)->first();
        $categories=DB::table('categories')->get();
        $subcategory=DB::table('subcategories')->where('category_id',$id)->get();
        $brand=DB::table('brands')->get();
        $product=DB::table('products')->where('category_id',$id)->orderBy('id','DESC')->paginate(60);

        return view('customer.category',compact('category','categories','subcategory','brand','product'));
    }
    
    //___Subcategorywise Product method__//
    public function SubcategorywiseProduct($id)
    {
        $subcategory=DB::table('subcategories')->where('id',$id)->first();
        $category=DB::table('categories')->get();
        $subcategories=DB::table('subcategories')->get();
        $brand=DB::table('brands')->get();
        $product=DB::table('products')->where('subcategory_id',$id)->orderBy('id','DESC')->paginate(60);

        return view('customer.subcategory',compact('subcategory','subcategories','category','brand','product'));
    }

    //__newsletter store method__//
    public function store(Request $request)
    {
        $email=$request->email;
        $check=DB::table('newsletters')->where('email',$email)->first();
        if ($check) {
           return response()->json(['error'=>'Email Allready Exist!']);
        }else{
            $data=array();
            $data['email']=$request->email;
            DB::table('newsletters')->insert($data);
            return response()->json(['success'=>'Thanks For Subscribe us!']);
        }
    }
    public function newsletterStore(Request $request)
    {
        $email=$request->email;
        $check=DB::table('newsletters')->where('email',$email)->first();
        if ($check) {
           return response()->json(['error'=>'Email Allready Exist!']);
        }else{
            $data=array();
            $data['email']=$request->email;
            DB::table('newsletters')->insert($data);
            return response()->json(['success'=>'Thanks For Subscribe us!']);
        }
    }

    //__order tracking method__//
    public function orderTracking()
    {
        return view('customer.order_tracking');
    }

    //__order chack method__//
    public function ChackOrder(Request $request)
    {
        $chack=DB::table('orders')->where('order_id',$request->order_id)->first();
        if($chack){
           $order=DB::table('orders')->where('order_id',$request->order_id)->first();
           $order_details=DB::table('order_details')->where('order_id',$order->id)->get();
           return view('customer.order_tracking_details',compact('order','order_details'));
        }else{
            $notification=array('message' => 'Invalid order id! try again','alert-type' => 'error'); 
            return redirect()->back()->with($notification);
        }
    }

    //__page view method__//
    public function pageView($page_slug)
    {
       $page=DB::table('pages')->where('page_slug',$page_slug)->first();
       if ($page==NULL) {
           about(405);
       }
       return view('customer.page',compact('page'));
    }

    //__sendContact method__//
    public function sendContact(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'subject' =>'required|min:10'
        ]);
        if($validator->passes()){
            $mailData = array();
            $mailData['name'] = $request->name;
            $mailData['phone'] = $request->phone;
            $mailData['email'] = $request->email;
            $mailData['subject'] = $request->subject;
            $mailData['message']= $request->message;

            $admin=DB::table('users')->where('is_admin',1)->where('id',1)->first();
            Mail::to($admin->email)->send(new ContactMail($mailData));
            return response()->json([
                'status' => true,
                'success'=>'Thanks for contacting us, we will get back to you soon!'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    
}
