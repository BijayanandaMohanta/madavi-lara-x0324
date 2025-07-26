<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
  protected $guarded = [];
  public function faqimages()
  {
    return $this->hasMany(FaqImage::class)->orderBy('priority', 'asc');
  }
}
