<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $fillable = ['description'];



    public function listData()
    {
        return Pages::orderBy('created_at', 'DESC')->get();
    }


    public function getDataById($id)
    {
        return Pages::find($id);
    }

    public function updateData($data, $id)
    {
        return Pages::find($id)->update($data);
    }


}
