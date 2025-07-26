<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'type',
        
        
        'image','link'
    ];

    public function deleteData($id) {
        return self::find($id)->delete();
    }
}
