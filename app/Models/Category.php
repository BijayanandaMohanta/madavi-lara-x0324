<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = [
        'category',
        'status',
        'display_menu',
        'about_us_description',
        'image',
        'banner_image',
        'homepage_side',
        'homepage_side_mobile',
        'slug',
        'display_home',
        'priority'
    ];

    public function products()
    {
        return $this->hasMany(Product::class)->where('status',1)->orderBy('created_at', 'DESC');
    }

    public function uniqueBrands()
    {
        $products = $this->products;
        $allBrands = [];

        foreach ($products as $product) {
            $brands = explode(',', $product->brand);
            $allBrands = array_merge($allBrands, $brands);
        }
        return array_unique($allBrands);
    }

    public function subcategories()
    {
        return $this->hasMany(Scategory::class,'category_id')->orderBy('created_at', 'DESC');
    }
    public function storeData($data)
    {
        return Category::create($data);
    }

    public function listData()
    {
        return Category::orderBy('created_at', 'DESC')->get();
    }

    public function getDataById($id)
    {
        return Category::find($id);
    }

    public function updateData($data, $id)
    {
        return Category::find($id)->update($data);
    }

    public function deleteData($id)
    {
        return Category::find($id)->delete();
    }
}
