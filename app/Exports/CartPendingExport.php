<?php
namespace App\Exports;

use App\Cart;
use App\Product;
use App\Category;
use App\Ccategory;
use App\Scategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CartPendingExport implements FromCollection, WithHeadings
{
    public function collection(){
        
        $carts = Cart::where('status', 'Pending')->get();
        $cartCollection = collect([]);

        foreach($carts as $cart){
            if($cart->category_id){
                $category = Category::find($cart->category_id);
                $categoryName = $category ? $category->category : null;
            } else {
                $categoryName = null;
            }

            if($cart->sub_category_id){
                $subCategory = Scategory::find($cart->sub_category_id);
                $subCategoryName = $subCategory ? $subCategory->category : null;
            } else {
                $subCategoryName = null;
            }

            if($cart->child_category_id){
                $childCategory = Ccategory::find($cart->child_category_id);
                $childCategoryName = $childCategory ? $childCategory->category : null;
            } else {
                $childCategoryName = null;
            }

            // CartCollection

            $cartCollection->push([
                'ID' => $cart->id,
                'SID' => $cart->sid ?? null, // assuming 'sid' is a field in Cart
                'Product Name' => $cart->product_name,
                'Category' => $categoryName,
                'Sub Category' => $subCategoryName,
                'Child Category' => $childCategoryName,
                'Brand' => $cart->brand,
                'Status' => $cart->status,
                'MRP' => $cart->mrp,
                'MOP' => $cart->mop,
                'Price' => $cart->price,
                'Quantity' => $cart->quantity,
                'Added Date Name' => $cart->added_date_time,
                'Sub Total' => $cart->sub_total,
                'Created At' => $cart->created_at,
                'Updated At' => $cart->updated_at
            ]);
        }
        return $cartCollection;
    }

    public function headings(): array
    {
        return [
            'ID',
            'SID',
            'Product Name',
            'Category',
            'Sub Category',
            'Child Category',
            'Brand',
            'Status',
            'MRP',
            'MOP',
            'Price',
            'Quantity',
            'Added Date Time',
            'Sub Total',
            'Created At',
            'Updated At'
        ];
    }
}
