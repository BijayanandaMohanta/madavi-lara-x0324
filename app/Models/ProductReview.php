<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{

  protected $table = "product_review";
  protected $guarded = [];

  public function product()
  {
    return $this->belongsTo('App\Product', 'product_id', 'id');
  }
}
