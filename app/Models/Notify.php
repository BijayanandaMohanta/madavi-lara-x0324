<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
  protected $table = "notify";
  protected $guarded = [];
  public function product(){
    return $this->belongsTo('App\Product', 'product_id', 'id');
  }
  public function customer(){
    return $this->belongsTo('App\Customer', 'customer_id', 'id');
  }

}
