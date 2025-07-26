<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

  protected $table = "customer";
  protected $guarded = [];

  public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
