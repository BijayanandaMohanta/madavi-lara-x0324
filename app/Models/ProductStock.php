<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{

  protected $table = "stock_transaction";
  protected $guarded = [];

  public function product()
  {
    return $this->belongsTo(Product::class, 'product_id');
  }
}
