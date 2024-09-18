<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Category;
use App\Models\Admin\Subcategory;
use App\Models\Admin\Childcategory;
use App\Models\Admin\Brand;
use App\Models\Admin\Warehouse;
use App\Models\Admin\Pickuppoint;

class Products extends Model
{
    use HasFactory;

     protected $fillable = [
        'admin_id',
        'category_id',
        'subcategory_id',
        'childcategory_id',
        'brand_id',
        'pickup_point_id',
        'warehouse_id',
        'product_name',
        'product_slug',
        'product_code',
        'unit',
        'tag',
        'video',
        'color',
        'size',
        'purchase_price',
        'selling_price',
        'discount_price',
        'stock_quantity',
        'stock_available',
        'description',
        'thumbnail',
        'images',
        'featured',
        'today_deal',
        'trendy',
        'status',
        'product_slider',
        'product_views',
        'month',
        'year',
        'date',
    ];
    //joind cateroy table
    public function category() {
        return $this->belongsTo(Category::class , 'category_id');
    }
    //joind Subcategory table
    public function subcategory() {
        return $this->belongsTo(Subcategory::class , 'subcategory_id');
    }
    //joind Subcategory table
    public function childcategory() {
        return $this->belongsTo(Childcategory::class , 'childcategory_id');
    }
    //joind brand table
    public function brand() {
        return $this->belongsTo(Brand::class , 'brand_id');
    }
    //joind pickuppoint table
    public function pickuppoint() {
        return $this->belongsTo(Pickuppoint::class , 'pickup_point_id');
    }
    //joind warehouse table
    public function warehouse() {
        return $this->belongsTo(Warehouse::class , 'warehouse_id');
    }
}
