<?php

namespace App\Exports;

use App\Product;
use App\Category;
use App\Ccategory;
use App\Scategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExportDetailed implements FromCollection, WithHeadings
{
    public function collection()
    {
        $products = Product::with('productimages')->get();
        $productCollection = collect([]);

        foreach($products as $product){
            if($product->category_id){
                $category = Category::find($product->category_id);
                $categoryName = $category ? $category->category : null;
            } else {
                $categoryName = null;
            }

            if($product->sub_category_id){
                $subCategory = Scategory::find($product->sub_category_id);
                $subCategoryName = $subCategory ? $subCategory->category : null;
            } else {
                $subCategoryName = null;
            }

            if($product->child_category_id){
                $childCategory = Ccategory::find($product->child_category_id);
                $childCategoryName = $childCategory ? $childCategory->category : null;
            } else {
                $childCategoryName = null;
            }

            $sizeChartImage2 = asset("uploads/products/{$product->size_chart_image2}");
            $sizeChartImage3 = asset("uploads/products/{$product->size_chart_image3}");
            $productImage = $product->productimages->first() ? asset("uploads/products/{$product->productimages->first()->image}") : null;
            $productLink = "https://openboxwale.in/product/".$product->slug;
            $productCollection->push([
                'ID' => $product->id,
                'Name' => $product->name,
                'Category' => $categoryName,
                'Sub Category' => $subCategoryName,
                'Child Category' => $childCategoryName,
                'Brand' => $product->brand,
                'GST' => $product->gst,
                'MRP' => $product->mrp,
                'Price' => $product->price,
                'Stock' => $product->stock,
                'Description' => $product->description,
                'Specification' => $product->specification,
                'Size Chart Image' => $product->size_chart_image,
                'YouTube Video' => $product->youtube_video,
                'Created At' => $product->created_at,
                'Updated At' => $product->updated_at,
                'Tags' => $product->tags,
                'Slug' => $product->slug,
                'Warranty' => $product->warranty,
                'Highlights' => $product->highlights,
                'Size Chart Image 2' => $sizeChartImage2,
                'Size Chart Image 3' => $sizeChartImage3,
                'MOP' => $product->mop,
                'Min Stock' => $product->min_stock,
                'YouTube Thumbnail' => $product->youtube_thumbnail,
                'Out of Stock' => $product->out_of_stock,
                'Status' => $product->status,
                'Image' => $productImage,
                'Product Link' => $productLink,
            ]);
        }

        return $productCollection;
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Category', 'Sub Category', 'Child Category', 'Brand', 'GST', 'MRP', 'Price', 'Stock', 'Description', 'Specification', 'Size Chart Image', 'YouTube Video', 'Created At', 'Updated At', 'Tags', 'Slug', 'Warranty', 'Highlights', 'Size Chart Image 2', 'Size Chart Image 3', 'MOP', 'Min Stock', 'YouTube Thumbnail', 'Out of Stock', 'Status', 'Image','Product Link'];
    }
}
