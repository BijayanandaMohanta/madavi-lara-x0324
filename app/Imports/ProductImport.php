<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    public function model(array $row)
    {
        return new Product([
            'name'              => $row[1],
            'mrp'               => $row[2],
            'price'             => $row[3],
            'stock'             => $row[4],
            'mop'               => $row[5],
        ]);
        
        
    }
}
