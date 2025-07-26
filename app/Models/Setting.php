<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = [];

    public static function boot()
       {
           parent::boot();
   
           static::retrieved(function ($setting) {
            $today = now()->format('Y-m-d');

            // Update expired coupons
            Coupon::where('exp_date', '<', $today)
                  ->where('status', '1')
                  ->update(['status' => '0']);
            
           });
       }
}
