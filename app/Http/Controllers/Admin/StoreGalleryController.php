<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\StoreGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class StoreGalleryController extends Controller
{

  public function index()
  {
    $images = StoreGallery::all();
    return view('admin.store_gallery.edit',compact('images'));
  }
  public function edit()
  {
    $images = StoreGallery::all();
    return view('admin.store_gallery.edit',compact('images'));
  }

  public function store(Request $request)
  {
    // Validate the request
    $request->validate([
      'images.*' => 'required', // Adjust validation rules as needed
    ]);

    // Handle file upload for each image
    if ($request->hasFile('images')) {
      foreach ($request->file('images') as $image) {
        // Generate a unique filename for each image
        $imageName = time() . '_' . $image->getClientOriginalName();

        // Move the uploaded image to the storage directory
        $image->move(public_path('uploads/gallery/'), $imageName);

        // Save the image information to the database
        StoreGallery::create([
          'image' => $imageName
        ]);
      }
    }

    // Redirect back with success message
    return redirect()->back()->with('success', 'Images uploaded successfully');
  }

  public function destroy($id)
  {
    // return("Coming in destory");
    $record = StoreGallery::findOrFail($id);

    if ($record->image) {
      $oldThumbnailPath = public_path('uploads/gallery/' . $record->image);
      if (file_exists($oldThumbnailPath)) {
        unlink($oldThumbnailPath);
      }
    }

    $record->delete();
    return redirect()->back()->with('danger', 'Gallery Image Deleted');
  }
}
