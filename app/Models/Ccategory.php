<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ccategory extends Model
{

    protected $fillable = [
        'category',
        'sub_category_id',
        'category_id',
        'status',
        'image',
        'slug'
    ];

    public function products()
    {
        return $this->hasMany(Product::class,'child_category_id')->orderBy('created_at', 'DESC');
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
    public function storeData($data)
    {
        return Ccategory::create($data);
    }

    public function listData()
    {
        return Ccategory::orderBy('created_at', 'DESC')->get();
    }

    public function getDataById($id)
    {
        return Ccategory::find($id);
    }

    public function updateData($data, $id)
    {
        return Ccategory::find($id)->update($data);
    }

    public function deleteData($id)
    {
        return Ccategory::find($id)->delete();
    }
}
