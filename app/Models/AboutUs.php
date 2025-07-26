<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'about_us';

    protected $fillable = [
        'title',
        'about_us_image',
        'about_us_description',
        'designation',
        'image_1',
        'image_2',
        'key_points',
    ];
    public function storeData($data)
    {
        return AboutUs::create($data);
    }

    public function listData()
    {
        return AboutUs::orderBy('created_at', 'DESC')->get();
    }

    public function getDataById($id)
    {
        return AboutUs::find($id);
    }

    public function updateData($data, $id)
    {
        return AboutUs::find($id)->update($data);
    }

    public function deleteData($id)
    {
        return AboutUs::find($id)->delete();
    }
}
