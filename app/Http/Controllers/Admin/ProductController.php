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
        'id','sl_no', 'name', 'price', 'mrp', 'stock', 'slug', 'status', 'category_id'
    ]);

    // Apply the search filter if the 'name' query parameter exists

    $search = $request->name;
    $search = str_replace(' ', '%', $search);

    if ($request->name) {
        $products = $products->when($search, function ($query) use ($search) {
                // Add keyword filter if provided
                return $query->where('name', 'like', '%' . $search . '%');
            });
    }

    // Order by created_at and paginate results
    $products = $products->orderBy('created_at', 'desc')->paginate(10);

    // Return the view with the paginated products
    return view('admin.products.index', compact('products'))
           ->with('search', $request->name); // Pass the search query to the view
}


  public function create()
  {
    $brands = Brand::all();
    $categories = Category::all();
    $subcategories = Scategory::all();
    $childcategories = Ccategory::all();
    $tags = Tag::all();
    return view('admin.products.create', compact('brands', 'categories', 'subcategories', 'childcategories', 'tags'));
  }

  public function store(Request $request)
  {

    $data = $this->validate($request, [
      'name' => 'required|unique:products,name',
      'category_id' => 'required',
      'sub_category_id' => 'nullable',
      'child_category_id' => 'nullable',
      'brand' => 'nullable',
      'gst' => 'nullable',
      'mrp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
      'mop' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
      'price' => [
        'required',
        'regex:/^([0-9\s\-\+\(\)]*\.)?([0-9\s\-\+\(\)]*)$/',
        function ($attribute, $value, $fail) use ($request) {
          if ($value > $request->input('mrp')) {
            $fail('The price must not be greater than MRP.');
          }
        },
      ],
      'stock' => 'required',
      'min_stock' => 'required',
      'description' => 'required',
      'specification' => 'nullable',
      'size_chart_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'size_chart_image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'size_chart_image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'youtube_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'youtube_video' => 'nullable',
      'tags' => 'nullable',
      'warranty' => 'nullable',
      'highlights' => 'nullable',
      'status' => 'required',
      'out_of_stock' => 'nullable'
    ]);


    if ($request->hasFile('size_chart_image')) {
      $image = 'product_' . rand() . '.' . $request->file('size_chart_image')->extension();
      $data['size_chart_image'] = $image;
      $request->file('size_chart_image')->move(public_path('uploads/products/'), $image);
    }
    if ($request->hasFile('size_chart_image2')) {
      $image = 'product_' . rand() . '.' . $request->file('size_chart_image2')->extension();
      $data['size_chart_image2'] = $image;
      $request->file('size_chart_image2')->move(public_path('uploads/products/'), $image);
    }
    if ($request->hasFile('size_chart_image3')) {
      $image = 'product_' . rand() . '.' . $request->file('size_chart_image3')->extension();
      $data['size_chart_image3'] = $image;
      $request->file('size_chart_image3')->move(public_path('uploads/products/'), $image);
    }
    if ($request->hasFile('youtube_thumbnail')) {
      $image = 'product_' . rand() . '.' . $request->file('youtube_thumbnail')->extension();
      $data['youtube_thumbnail'] = $image;
      $request->file('youtube_thumbnail')->move(public_path('uploads/products/'), $image);
    }

    $array_set = $request->input('tags');

    if (!empty($array_set)) {
      // If tags are present, implode them into a comma-separated string
      $array_data = implode(',', $array_set);
      $data['tags'] = $array_data;
    } else {
      // If no tags are selected, set to null
      $data['tags'] = null;
    }

    $data['slug'] = Str::slug($request->name, '-');
    Product::create($data);

    return redirect()->route('product.index')->with('success', 'Product created successfully.');
  }


  public function edit($id)
  {
    $data = Product::find($id);
    $categories = Category::all();
    $subcategories = $data->category_id ? Scategory::where('category_id', $data->category_id)->get() : collect();
    $childcategories = $data->sub_category_id ? Ccategory::where('sub_category_id', $data->sub_category_id)->get() : collect();
    $brands = Brand::all();
    $tags = Tag::all();
    return view('admin.products.edit', compact('data', 'categories', 'brands', 'tags', 'subcategories', 'childcategories'));
  }
  public function duplicate($id)
  {
    $data = Product::find($id);
    $categories = Category::all();
    $subcategories = $data->category_id ? Scategory::where('category_id', $data->category_id)->get() : collect();
    $childcategories = $data->sub_category_id ? Ccategory::where('sub_category_id', $data->sub_category_id)->get() : collect();
    $brands = Brand::all();
    $tags = Tag::all();
    return view('admin.products.duplicate', compact('data', 'categories', 'brands', 'tags', 'subcategories', 'childcategories'));
  }
  public function update(Request $request, $id)
  {
    // dd($request);
    $data = $this->validate($request, [
      'name' => 'required',
      'category_id' => 'required',
      'sub_category_id' => 'nullable',
      'child_category_id' => 'nullable',
      'brand' => 'nullable',
      'gst' => 'nullable',
      'mrp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
      'mop' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
      'price' => [
        'required',
        'regex:/^([0-9\s\-\+\(\)]*\.)?([0-9\s\-\+\(\)]*)$/',
        function ($attribute, $value, $fail) use ($request) {
          if ($value > $request->input('mrp')) {
            $fail('The price must not be greater than MRP.');
          }
        },
      ],
      'stock' => 'required',
      'description' => 'required',
      'specification' => 'nullable',
      'size_chart_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'size_chart_image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'size_chart_image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'youtube_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'youtube_video' => 'nullable',
      'tags' => 'nullable',
      'warranty' => 'nullable',
      'highlights' => 'nullable',
      'status' => 'required',
      'out_of_stock' => 'required'
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
    // Check if the size_chart_image is being updated
    if ($request->hasFile('size_chart_image2')) {
      // Delete the existing image if it exists
      $existingImage = $product->size_chart_image2;
      // $filePath = public_path('uploads/products/' . $existingImage);
      // if (file_exists($filePath)) {
      //   unlink($filePath);
      // }

      // Upload the new image
      $image = 'product_' . rand() . '.' . $request->file('size_chart_image2')->extension();
      $data['size_chart_image2'] = $image;
      $request->file('size_chart_image2')->move(public_path('uploads/products/'), $image);
    }
    // Check if the size_chart_image is being updated
    if ($request->hasFile('size_chart_image3')) {
      // Delete the existing image if it exists
      $existingImage = $product->size_chart_image3;
      // $filePath = public_path('uploads/products/' . $existingImage);
      // if (file_exists($filePath)) {
      //   unlink($filePath);
      // }

      // Upload the new image
      $image = 'product_' . rand() . '.' . $request->file('size_chart_image3')->extension();
      $data['size_chart_image3'] = $image;
      $request->file('size_chart_image3')->move(public_path('uploads/products/'), $image);
    }
    if ($request->hasFile('youtube_thumbnail')) {
      // Delete the existing image if it exists
      $existingImage = $product->youtube_thumbnail;
      // $filePath = public_path('uploads/products/' . $existingImage);
      // if (file_exists($filePath)) {
      //   unlink($filePath);
      // }

      // Upload the new image
      $image = 'product_' . rand() . '.' . $request->file('youtube_thumbnail')->extension();
      $data['youtube_thumbnail'] = $image;
      $request->file('youtube_thumbnail')->move(public_path('uploads/products/'), $image);
    }

    $array_set = $request->input('tags');

    if (!empty($array_set)) {
      // If tags are present, implode them into a comma-separated string
      $array_data = implode(',', $array_set);
      $data['tags'] = $array_data;
    } else {
      // If no tags are selected, set to null
      $data['tags'] = null;
    }

    $data['slug'] = Str::slug($request->name, '-');
    // Update the product
    $product->update($data);
    //Product::create($data);

    if ($data['status'] == '0') {
      DB::table('carts')->where('product_id', $id)->where('status', 'Pending')->delete();
    }

    Cart::where('product_id', $id)
    ->where('status', 'Pending')
    ->update([
        'mrp' => $request->mrp,
        'mop' => $request->mop,
        'price' => $request->price,
        'sub_total' => DB::raw('quantity * '.$request->price),
    ]);

    return redirect()->route('product.index')->with('success', 'Product Added successfully.');
  }


  public function duplicate_store(Request $request, $id)
  {
    // dd($request);
    $data = $this->validate($request, [
      'name' => 'required|unique:products,name',
      'category_id' => 'required',
      'sub_category_id' => 'nullable',
      'child_category_id' => 'nullable',
      'brand' => 'nullable',
      'gst' => 'nullable',
      'mrp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
      'mop' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
      'price' => [
        'required',
        'regex:/^([0-9\s\-\+\(\)]*\.)?([0-9\s\-\+\(\)]*)$/',
        function ($attribute, $value, $fail) use ($request) {
          if ($value > $request->input('mrp')) {
            $fail('The price must not be greater than MRP.');
          }
        },
      ],
      'stock' => 'required',
      'description' => 'required',
      'specification' => 'nullable',
      'size_chart_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
      'size_chart_image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
      'size_chart_image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
      'youtube_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
      'youtube_video' => 'nullable',
      'tags' => 'nullable',
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

    if ($product->size_chart_image2) {
      copyImage($product, 'size_chart_image2', $data);
    }

    if ($product->size_chart_image3) {
      copyImage($product, 'size_chart_image3', $data);
    }

    if ($product->youtube_thumbnail) {
      copyImage($product, 'youtube_thumbnail', $data);
    }

    $array_set = $request->input('tags');

    if (!empty($array_set)) {
      // If tags are present, implode them into a comma-separated string
      $array_data = implode(',', $array_set);
      $data['tags'] = $array_data;
    } else {
      // If no tags are selected, set to null
      $data['tags'] = null;
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
  public function fetchccategory(Request $request)
  {
    $data['ccategories'] = Ccategory::where("sub_category_id", $request->sub_category_id)
      ->get(["category", "id"]);

    return response()->json($data);
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

  public function product_export(Request $request)
  {
    return Excel::download(new ProductExportBasic, 'products_basic.xlsx');
  }
  public function product_export_all(Request $request)
  {
    return Excel::download(new ProductExportDetailed, 'products_all.xlsx');
  }

  public function product_data_update(Request $request)
  {
    $request->validate([
      'file' => 'required',
    ]);
    $array = Excel::toArray(new ProductImport, $request->file('file'));
    // dd($array);
    $index = 0;
    foreach ($array[0] as $item) {
      // Skip the first iteration
      if ($index == 0) {
        $index++;
        continue;
      }
      // Update data into the database
      $product = Product::find($item[0]);

      if ($product) {
        // $product->name = $item[1];
        $product->mrp = $item[2];
        $product->price = $item[3];
        $product->stock = $item[4];
        $product->mop = $item[5];
        $product->save();

        //inert Stock
        $checkproductstock = ProductStock::where('product_id', $item[0])->count();
        if ($checkproductstock > 0) {
          continue;
        }
        $remark = "Add by admin";
        $product_stock = new ProductStock();
        $product_stock->product_id = $item[0];
        $product_stock->stock = $item[4];
        $product_stock->type = 'Credit';
        $product_stock->remark = $remark;
        $product_stock->save();
      } else {
        // If the product does not exist, create a new one
        // $product = new Product();
        // $product->name = $item[1];
        // $product->price = $item[2];
      }
      $index++;
    }
    return back()->with('success', 'Data updated successfully.');
  }
}
