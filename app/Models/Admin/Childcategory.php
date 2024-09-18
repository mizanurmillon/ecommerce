<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Category;
use App\Models\Admin\Subcategory;

class Childcategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'subcategory_name',
        'slug',
        'image',
    ];
    public function category() {
        return $this->belongsTo(Category::class , 'category_id');
    }
    public function subcategory() {
        return $this->belongsTo(Subcategory::class , 'subcategory_id');
    }
}
