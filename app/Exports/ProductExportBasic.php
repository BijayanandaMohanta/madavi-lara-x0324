<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExportBasic implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Product::select(['id', 'name', 'mrp', 'price', 'stock', 'mop'])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'MRP',
            'Price',
            'Stock',
            'MOP',
        ];
    }
}
