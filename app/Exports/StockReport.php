<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StockReport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Product::select(['id', 'name','stock','price'])->orderby('stock','desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Stock',
            'Price',
        ];
    }
}
