<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Models\Admin\Products;
use App\Models\Admin\Category;
use App\Models\Admin\Subcategory;
use App\Models\Admin\Brand;
use App\Models\Admin\Warehouse;
use App\Models\Admin\Pickuppoint;
use Illuminate\Support\Str;
use Image;
use Auth;
use File;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //___products index method___//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=Products::all();
            $imgurl=asset('public/files/product/');
            $product="";
            $query=DB::table('products')->leftJoin('categories','products.category_id','categories.id')->leftJoin('subcategories','products.subcategory_id','subcategories.id')->leftJoin('brands','products.brand_id','brands.id');
                if($request->category_id)
                {
                    $query->where('products.category_id',$request->category_id);
                }
                if ($request->brand_id) 
                {
                    $query->where('products.brand_id',$request->brand_id);
                }
                if ($request->warehouse_id)
                {
                   $query->where('products.warehouse_id',$request->warehouse_id); 
                }
            $product=$query->select('products.*','categories.category_name','subcategories.subcategory_name','brands.brand_name')->get();

            return DataTables::of($product)
                ->addIndexColumn()
                ->editColumn('thumbnail', function($row) use($imgurl){
                    return '<img src="'.$imgurl.'/'.$row->thumbnail.'" width="100" height="100" />';
                })
                ->editColumn('featured', function($row){
                    if ($row->featured==1) {
                       return '<a href="'.route('product.deactive',$row->id).'" data-id="'.$row->id.'" class="deactive_featured"><i class="fa fa-thumbs-down text-danger"></i> <span class="badge badge-success">active</span></a>';
                    }else{
                        return '<a href="'.route('product.active',$row->id).'" class="active_featured"><i class="fa fa-thumbs-up text-success"></i> <span class="badge badge-danger">deactive</span></a>';
                    }
                })
                ->editColumn('today_deal', function($row){
                    if ($row->today_deal==1) {
                        return '<a href="'.route('deactive.todaydeal',$row->id).'" class="deactive_deal"><i class="fa fa-thumbs-down text-danger"></i> <span class="badge badge-success">active</span></a>'; 
                    }else{
                        return '<a href="'.route('active.todaydeal',$row->id).'" class="active_deal"><i class="fa fa-thumbs-up text-success"></i> <span class="badge badge-danger">deactive</span></a>';
                    }
                })
                ->editColumn('status', function ($row){

                    if ($row->status==1) {
                        return '<a href="'.route('deactive.status',$row->id).'" class="deactive_status"><i class="fa fa-thumbs-down text-danger"></i> <span class="badge badge-success">active</span></a>';
                    }else{
                        return '<a href="'.route('active.status',$row->id).'" class="active_status"><i class="fa fa-thumbs-up text-success"></i> <span class="badge badge-danger">deactive</span></a>';
                    }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="'.route('product.details',[$row->product_slug]).'" class="m-1"><i class="fa fa-eye text-success"></i></a>
                    <a href="'.route('product.edit',[$row->id]).'" class="m-1"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('product.delete',[$row->id]).'" class="m-1" id="product_delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','thumbnail','category_name','subcategory_name','brand_name','featured','today_deal','status'])
                ->make(true);
        }
        $category=DB::table('categories')->get();
        $brand=DB::table('brands')->get();
        $warehouse=DB::table('warehouses')->get();

        return view('admin.product.index',compact('category','brand','warehouse'));        
    }

    //___create product method____//
    public function create()
    {
        $category=Category::all();
        $brand=Brand::all();
        $warehouse=DB::table('warehouses')->get();
        $pickuppoint=DB::table('pickup_points')->get();

        return view('admin.product.create',compact('category','brand','warehouse','pickuppoint'));

    }

    //____store product method__//
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required',
            'product_code' => 'required|unique:products|max:55',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'unit' => 'required',
            'selling_price' => 'required',
            'stock_quantity' => 'required',
            'thumbnail' => 'required',
            'description' => 'required',
        ]);

        $subcategory=DB::table('subcategories')->where('id',$request->subcategory_id)->first();
        $data=array();
        $data['admin_id']=Auth::id();
        $data['category_id']=$subcategory->category_id;
        $data['subcategory_id']=$request->subcategory_id;
        $data['brand_id']=$request->brand_id;
        $data['pickup_point_id']=$request->pickup_point_id;
        $data['warehouse_id']=$request->warehouse_id;
        $data['product_name']=$request->product_name;
        $data['product_slug']=Str::slug($request->product_name,'-');
        $data['product_code']=$request->product_code;
        $data['unit']=$request->unit;
        $data['tag']=$request->tag;
        $data['video']=$request->video;
        $data['color']=$request->color;
        $data['size']=$request->size;
        $data['purchase_price']=$request->purchase_price;
        $data['selling_price']=$request->selling_price;
        $data['discount_price']=$request->discount_price;
        $data['stock_quantity']=$request->stock_quantity;
        $data['stock_available']=$request->stock_available;
        $data['description']=$request->description;
        $data['featured']=$request->featured;
        $data['today_deal']=$request->today_deal;
        $data['trendy']=$request->trendy;
        $data['status']=$request->status;
        $data['product_slider']=$request->product_slider;
        $data['month']=date('F');
        $data['year']=date('Y');
        $data['date']=date('d-m-Y');
        //Single Image--------
        if($request->thumbnail){
            $thumbnail=$request->thumbnail;
            $thumbnailname=uniqid().'.'.$thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->resize(600,600)->save('public/files/product/'. $thumbnailname);
            $data['thumbnail']=$thumbnailname;
        }
        //Multiple Image----
        $images=array();
        if($request->hasFile('images')){
            foreach ($request->file('images') as $key => $image) {
                $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(600,600)->save('public/files/product/'. $image_name);
                $upload_image=$image_name;
                array_push($images, $upload_image);
            }
            $data['images']  = json_encode($images);
        }
        DB::table('products')->insert($data);
        $notification=array('message' => 'successfully add a new product!', 'alert-type' => 'success'); 
        return redirect()->back()->with($notification);
    }

    //__product edit method___//
    public function edit($id)
    {
        $category=DB::table('categories')->get();
        $subcategory=DB::table('subcategories')->get();
        $brand=DB::table('brands')->get();
        $warehouse=DB::table('warehouses')->get();
        $pickuppoint=DB::table('pickup_points')->get();
        $product=DB::table('products')->where('id',$id)->first();

        return view('admin.product.edit',compact('category','subcategory','warehouse','brand','pickuppoint','product'));
    }

    //__update product method___//
    public function update(Request $request)
    {
        $subcategory=DB::table('subcategories')->where('id',$request->subcategory_id)->first();
        $data=array();
        $data['admin_id']=Auth::id();
        $data['category_id']=$subcategory->category_id;
        $data['subcategory_id']=$request->subcategory_id;
        $data['brand_id']=$request->brand_id;
        $data['pickup_point_id']=$request->pickup_point_id;
        $data['warehouse_id']=$request->warehouse_id;
        $data['product_name']=$request->product_name;
        $data['product_slug']=Str::slug($request->product_name,'-');
        $data['product_code']=$request->product_code;
        $data['unit']=$request->unit;
        $data['tag']=$request->tag;
        $data['video']=$request->video;
        $data['color']=$request->color;
        $data['size']=$request->size;
        $data['purchase_price']=$request->purchase_price;
        $data['selling_price']=$request->selling_price;
        $data['discount_price']=$request->discount_price;
        $data['stock_quantity']=$request->stock_quantity;
        $data['stock_available']=$request->stock_available;
        $data['description']=$request->description;
        $data['featured']=$request->featured;
        $data['today_deal']=$request->today_deal;
        $data['trendy']=$request->trendy;
        $data['status']=$request->status;
        $data['product_slider']=$request->product_slider;
        $data['month']=date('F');
        $data['year']=date('Y');
        $data['date']=date('d-m-Y');

        $thumbnail=$request->file('thumbnail');
        if ($thumbnail) {
            $old_thumbnail='public/files/product/'.$request->old_thumbnail;
            if (File::exists($old_thumbnail)) {
                File::delete($old_thumbnail);
            }
            $thumbnail=$request->thumbnail;
            $thumbnailname=uniqid().'.'.$thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->resize(600,600)->save('public/files/product/'. $thumbnailname);
            $data['thumbnail']=$thumbnailname;
        }
        //Multiple Image------
       $old_images=$request->has('old_image');
       if ($old_images) {
           $images=$request->old_images;
           $data['images']=json_encode($images);
       }else{
            $images=array();
            $data['images']=json_encode($images);
       }

       if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(600,600)->save('public/files/product/'. $image_name);
                $upload_image=$image_name;
                array_push($images, $upload_image);
            }
            $data['images']  = json_encode($images);
       }
        DB::table('products')->where('id',$request->id)->update($data);
        $notification=array('message' => 'Product Updated Successfully!','alert-type' => 'success'); 
        return redirect()->back()->with($notification);

    }

    //__product delete method__//
    public function destroy($id)
    {
        $product=DB::table('products')->where('id',$id)->first();
        
        if (File::exists('public/files/product/'.$product->thumbnail)) {
            File::delete('public/files/product/'.$product->thumbnail);
        }

        DB::table('products')->where('id',$id)->delete();
        return response()->json('successfully product deleted!');
    }

    //__deactive Featured product__//
    public function deactive($id)
    {
        DB::table('products')->where('id',$id)->update(['featured'=>0]);
        $notification=array('message' => 'Featured Deactive!','alert-type' => 'warning'); 
        return redirect()->back()->with($notification);
    }
    //__active Featured__//
    public function active($id)
    {
        DB::table('products')->where('id',$id)->update(['featured'=>1]);
        $notification=array('message' => 'Featured Active!','alert-type' => 'success'); 
        return redirect()->back()->with($notification);
    }

    //__deactive Today deal product method__//
    public function todaydealDeactive($id)
    {
        DB::table('products')->where('id',$id)->update(['today_deal'=>0]);
        $notification=array('message' => 'Today Deal Deactive!','alert-type' => 'warning'); 
        return redirect()->back()->with($notification);
    }
    //__active Today del product method__//
    public function todaydealActive($id)
    {
        DB::table('products')->where('id',$id)->update(['today_deal'=>1]);
        $notification=array('message' => 'Today Deal Active!','alert-type' => 'success'); 
        return redirect()->back()->with($notification);
    }

    //__deactive Status method__//
    public function statusDeactive($id)
    {
        DB::table('products')->where('id',$id)->update(['status'=>0]);
        $notification=array('message' => 'Status Deactive!','alert-type' => 'warning'); 
        return redirect()->back()->with($notification);
    }
    //__active Status method__//
    public function statusActive($id)
    {
        DB::table('products')->where('id',$id)->update(['status'=>1]);
        $notification=array('message' => 'Status Active!','alert-type' => 'success'); 
        return redirect()->back()->with($notification);
    }
    
}
