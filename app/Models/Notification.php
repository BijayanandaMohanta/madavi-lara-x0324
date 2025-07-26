<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Notification extends Model {
    protected $fillable = [
        'title',
        'image',
        'description'
    ];

    public function deleteData($id) {
        return self::find($id)->delete();
    }

    public static function getNotifications($service_provider_id) {
        
    }

}
