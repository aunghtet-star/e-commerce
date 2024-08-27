<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=['category_id','supplier_id','brand_id', 'slug','name','image','description','discount_price','buy_price','sale_price','total_quantity','view_count','like_count'];
    protected $appends=['image_url'];
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function color()
    {
        return $this->belongsToMany(Color::class , 'product_color');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function transaction()
    {
        return $this->hasMany(ProductAddTransaction::class);
    }

    public function productcart()
    {
        return $this->hasMany(Productcart::class);
    }

    public function order()
    {
        return $this->hasMany(Productorder::class);
    }

    public function review()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function getImageUrlAttribute()
    {
        return asset('/images/'.$this->image);
    }
}
