<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'link',
        'image'
    ];

    public function deleteData($id) {
        return self::find($id)->delete();
    }
}
