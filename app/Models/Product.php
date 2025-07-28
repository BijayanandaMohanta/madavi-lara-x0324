<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $guarded = [];

  public function category()
  {
    return $this->belongsTo(Category::class, 'category_id');
  }
  public function prices(){
    return $this->hasMany(Price::class,'product_id');
  }

  public function productimages()
  {
    return $this->hasMany(ProductImage::class)->orderBy('priority', 'asc');
  }
  public function carts()
  {
    return $this->hasMany(Cart::class, 'product_id');
  }
  public function productReviews()
  {
    return $this->hasMany(ProductReview::class, 'product_id')->where('status', '1');
  }
}
