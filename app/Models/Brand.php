<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'image',
        'status','brand','slug'
    ];
    public function storeData($data)
    {
        return Brand::create($data);
    }

    public function listData()
    {
        return Brand::orderBy('created_at', 'DESC')->get();
    }

    public function getDataById($id)
    {
        return Brand::find($id);
    }

    public function updateData($data, $id)
    {
        return Brand::find($id)->update($data);
    }

    public function deleteData($id)
    {
        return Brand::find($id)->delete();
    }
}
