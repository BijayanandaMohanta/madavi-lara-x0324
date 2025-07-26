<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;

class Order extends Model
{

  protected $table = "orders";
  protected $guarded = [];

  public function getCustomer(){
    return $this->belongsTo('Customer', 'customer_id', 'id');
  }

  public function customer()
  {
    return $this->belongsTo(Customer::class, 'customer_id');
  }

  public function orderCarts(){
    return $this->hasMany(Cart::class, 'sid', 'sid');
  }

  public function scopeOrdersByMonth($query)
  {
    return $query->select(DB::raw("DATE_FORMAT(STR_TO_DATE(date, '%d-%m-%Y'), '%Y-%m') as month_year"), DB::raw('COUNT(*) as order_count'))->groupBy('month_year')->orderBy('month_year');
  }
}
