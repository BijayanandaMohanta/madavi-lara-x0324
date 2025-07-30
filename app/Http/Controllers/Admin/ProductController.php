<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Brand;
use App\Models\Ccategory;
use App\Models\Scategory;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductExportBasic;
use App\Exports\ProductExportDetailed;
use App\Imports\ProductImport;
use App\Models\ProductStock;
use App\Models\ProductImage;


class ProductController extends Controller
{
  public function index(Request $request)
{
    // Start with the query to select products
    $products = Product::select([
        'id','sl_no', 'name','slug', 'status', 'category_id','current_status'
    ]);

    // Apply the search filter if the 'name' query parameter exists

    $search = $request->name;
    $search = str_replace(' ', '%', $search);

    if ($request->name) {
        $products = $products->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%');
            });
    }

    $products = $products->orderBy('created_at', 'desc')->paginate(10);

    // Return the view with the paginated products
    return view('admin.products.index', compact('products'))
           ->with('search', $request->name);
}


  public function create()
  {
    $categories = Category::all();
    return view('admin.products.create', compact( 'categories'));
  }

  public function store(Request $request)
  {

    $data = $this->validate($request, [
      'name' => 'required|unique:products,name',
      'category_id' => 'required',
      'description' => 'required',
      'below_description' => 'required',
      'specification' => 'nullable',
      'size_chart_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'warranty' => 'nullable',
      'highlights' => 'nullable',
      'status' => 'required'
    ]);


    if ($request->hasFile('size_chart_image')) {
      $image = 'product_' . rand() . '.' . $request->file('size_chart_image')->extension();
      $data['size_chart_image'] = $image;
      $request->file('size_chart_image')->move(public_path('uploads/products/'), $image);
    }

    $data['slug'] = Str::slug($request->name, '-');
    Product::create($data);

    return redirect()->route('product.index')->with('success', 'Product created successfully.');
  }


  public function edit($id)
  {
    $data = Product::find($id);
    $categories = Category::all();
    return view('admin.products.edit', compact('data', 'categories'));
  }
  public function duplicate($id)
  {
    $data = Product::find($id);
    $categories = Category::all();
    return view('admin.products.duplicate', compact('data', 'categories'));
  }
  public function update(Request $request, $id)
  {
    // dd($request);
    $data = $this->validate($request, [
      'name' => 'required',
      'category_id' => 'required',
      'description' => 'required',
      'below_description' => 'required',
      'specification' => 'nullable',
      'size_chart_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'warranty' => 'nullable',
      'highlights' => 'nullable',
      'status' => 'required'
    ]);

    // Get the existing product
    $product = Product::find($id);

    // Check if the size_chart_image is being updated
    if ($request->hasFile('size_chart_image')) {
      // Delete the existing image if it exists
      $existingImage = $product->size_chart_image;
      // $filePath = public_path('uploads/products/' . $existingImage);
      // if (file_exists($filePath)) {
      //   unlink($filePath);
      // }

      // Upload the new image
      $image = 'product_' . rand() . '.' . $request->file('size_chart_image')->extension();
      $data['size_chart_image'] = $image;
      $request->file('size_chart_image')->move(public_path('uploads/products/'), $image);
    }

    // Update the product
    $product->update($data);
    //Product::create($data);

    if ($data['status'] == '0') {
      DB::table('carts')->where('product_id', $id)->where('status', 'Pending')->delete();
    }

    // Cart::where('product_id', $id)
    // ->where('status', 'Pending')
    // ->update([
    //     'mrp' => $request->mrp,
    //     'mop' => $request->mop,
    //     'price' => $request->price,
    //     'sub_total' => DB::raw('quantity * '.$request->price),
    // ]);

    return redirect()->route('product.index')->with('success', 'Product Added successfully.');
  }


  public function duplicate_store(Request $request, $id)
  {
    // dd($request);
    $data = $this->validate($request, [
      'name' => 'required|unique:products,name',
      'category_id' => 'required',
      'description' => 'required',
      'below_description' => 'required',
      'specification' => 'nullable',
      'size_chart_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
      'warranty' => 'nullable',
      'highlights' => 'nullable',
    ]);

    // Get the existing product
    $product = Product::find($id);

    // Helper function to copy image
    function copyImage($product, $imageField, &$data)
    {
      $originalImagePath = public_path('uploads/products/' . $product->$imageField);
      $newImageName = uniqid() . '-' . $product->$imageField;
      $newImagePath = public_path('uploads/products/' . $newImageName);

      if (file_exists($originalImagePath)) {
        if (copy($originalImagePath, $newImagePath)) {
          $data[$imageField] = $newImageName;
        } else {
          echo "Failed to copy $originalImagePath...\n";
        }
      }
    }

    if ($product->size_chart_image) {
      copyImage($product, 'size_chart_image', $data);
    }

    $data['slug'] = Str::slug($request->name, '-');
    $newProduct = Product::create($data); // $data contains the new product details
    $newProductId = $newProduct->id;


    // all product images
    $product_images = ProductImage::where('product_id', $id)->get();
    // 'uploads/products/$product_images->image;

    foreach ($product_images as $productImage) {
      // Generate a unique filename for the new image
      $originalImagePath = public_path('uploads/products/' . $productImage->image);
      $newImageName = uniqid() . '-' . $productImage->image;
      $newImagePath = public_path('uploads/products/' . $newImageName);

      // Copy the original image to the new filename
      if (file_exists($originalImagePath)) {
        if (copy($originalImagePath, $newImagePath)) {
          // Create a new record in the ProductImage table 
          ProductImage::create(['product_id' => $newProductId, 'image' => $newImageName,'priority' => $productImage->priority]);
        } else {
          // Handle the error if the copy fails 
          echo "Failed to copy $originalImagePath...\n";
        }
      }
    }

    return redirect()->route('product.index')->with('success', 'Product updated successfully.');
  }

  public function destroy($id)
  {
    $product = Product::find($id);
    Cart::where('product_id', $id)->where('status', 'Pending')->delete();
    $product->delete();
    return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
  }
  
  public function deleteFile(Request $request)
  {
    // dd($request);
    $file = $request->input('file');
    $filePath = $file;

    if (file_exists($filePath)) {
      unlink($filePath);
    }

    // Update the database column to blank
    $product = Product::find($request->input('id'));
    $product->update([$request->input('column') => null]);

    return response()->json(['success' => true]);
  }

}
