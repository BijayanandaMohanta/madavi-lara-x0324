<?php

namespace App\Exports;

use App\Cart;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BestSellingProductReport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Fetch the data
        $data = Cart::where('carts.status', 'Completed') // Explicitly specify the table name
            ->join('products', 'carts.product_id', '=', 'products.id') // Join with products table
            ->groupBy('carts.product_id', 'products.name') // Group by product_id and product name
            ->select('products.name as product_name', DB::raw('count(*) as count_per_product'))
            ->orderBy('count_per_product', 'desc')
            ->get();

        // Add a row number to each item
        $dataWithRowNumber = $data->map(function ($item, $index) {
            return [
                'No.' => $index + 1, // Add row number
                'Name' => $item->product_name,
                'Count Per Product' => $item->count_per_product,
            ];
        });

        return $dataWithRowNumber;
    }

    public function headings(): array
    {
        return [
            'No.', // Add header for row number
            'Name',
            'Count Per Product',
        ];
    }
}