<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductImageController extends Controller
{
    //
    public function index()
    {
        $data = Product::orderby('created_at', 'DESC')->get();
        return view('admin.product_image.index', compact('data'));
    }


    public function edit($id)
    {
        $data = Product::where('id', $id)->first();
        $product_images = ProductImage::where('product_id', $id)->orderBy('priority', 'asc')->get();
        $product_images_count = ProductImage::where('product_id', $id)->count();
        // $categories = Category::all();

        return view('admin.product_image.edit', compact('data', 'product_images', 'product_images_count'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'images' => 'required',
            'product_id' => 'required'
        ]);

        $max_priority = ProductImage::where('product_id', $request->product_id)->max('priority');


        if ($request->hasFile('images')) {
            $next_priority = $max_priority + 1; // increment the max priority for new images
            foreach ($request->file('images') as $image) {                
                $imageName = time() . '_' . $image->getClientOriginalName();

                $image->move(public_path('uploads/products/'), $imageName);

                // Save the image information to the database with the next priority
                ProductImage::create([
                    'image' => $imageName,
                    'product_id' => $request->product_id,
                    'priority' => $next_priority++,
                ]);
            }
        }

        // Redirect back with success message
        return redirect()->back()->with('success', 'Images uploaded successfully');
    }

    public function destroy($id)
    {
        // return("Coming in destory");
        $product_image = ProductImage::findOrFail($id);

        if ($product_image->image) {
            $oldThumbnailPath = public_path('uploads/products/' . $product_image->image);
            if (file_exists($oldThumbnailPath)) {
                unlink($oldThumbnailPath);
            }
        }

        $product_image->delete();
        // return response()->json(['success' => true]);
        return redirect()->back()->with('danger', 'Product Image Deleted');
    }

    public function product_image_priority(Request $request)
    {
        $product_image = ProductImage::findOrFail($request->image_id);
        $product_image->priority = $request->priority;
        $product_image->save();
        return response()->json(['success' => true]);
    }
}
