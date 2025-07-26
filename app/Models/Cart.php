<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

  protected $table = "carts";
  protected $guarded = [];

  public function product()
  {
    return $this->belongsTo(Product::class, 'product_id');
  }
  public function category(){
    return $this->belongsTo(Category::class, 'category_id');
  }
  public function subcategory(){
    return $this->belongsTo(Scategory::class, 'sub_category_id');
  }
  public function childcategory(){
    return $this->belongsTo(Ccategory::class, 'child_category_id');
  }
}
