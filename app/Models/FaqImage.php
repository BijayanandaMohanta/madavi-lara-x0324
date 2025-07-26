<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqImage extends Model
{

  protected $table = "faq_images";
  protected $guarded = [];

  public function faq()
  {
    return $this->belongsTo(Product::class, 'faq_id');
  }
}
