<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $guarded = [];

  // protected static function booted()
  // {
  //   if (!Auth::check() || Auth::user()->role_id != 1) {
  //     static::addGlobalScope('status', function (Builder $builder) {
  //       $builder->where('status', 1);
  //     });
  //   }
  // }

  public function category()
  {
    return $this->belongsTo(Category::class, 'category_id');
  }
  public function subcategory()
  {
    return $this->belongsTo(Scategory::class, 'sub_category_id');
  }
  public function childcategory()
  {
    return $this->belongsTo(Ccategory::class, 'child_category_id');
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
