<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scategory extends Model
{

    protected $fillable = [
        'category',
        'status',
        'category_id',
        'image',
        'brands',
        'slug'
    ];
    public function storeData($data)
    {
        return Scategory::create($data);
    }

    public function listData()
    {
        return Scategory::orderBy('created_at', 'DESC')->get();
    }

    public function getDataById($id)
    {
        return Scategory::find($id);
    }

    public function updateData($data, $id)
    {
        return Scategory::find($id)->update($data);
    }

    public function deleteData($id)
    {
        return Scategory::find($id)->delete();
    }
    public function childcategories()
    {
        return $this->hasMany(Ccategory::class,'sub_category_id')->orderBy('created_at','desc');
    }
    public function products()
    {
        return $this->hasMany(Product::class,'sub_category_id')->orderBy('created_at','desc');
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
}
