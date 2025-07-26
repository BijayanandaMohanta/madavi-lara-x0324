<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use App\Http\Controllers\Controller;
use App\Models\FaqImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class FaqImageController extends Controller
{
    //
    public function index()
    {
        $data = Faq::orderby('created_at', 'DESC')->get();
        return view('admin.faq_image.index', compact('data'));
    }


    public function edit($id)
    {
        $data = Faq::where('id', $id)->first();
        $faq_images = FaqImage::where('faq_id', $id)->get();
        $faq_images_count = FaqImage::where('faq_id', $id)->count();
        // $categories = Category::all();

        return view('admin.faq_image.edit', compact('data', 'faq_images', 'faq_images_count'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'images' => 'required',
            'faq_id' => 'required'
        ]);

        $max_priority = FaqImage::where('faq_id', $request->faq_id)->max('priority');


        if ($request->hasFile('images')) {
            $next_priority = $max_priority + 1; // increment the max priority for new images
            foreach ($request->file('images') as $image) {                
                $imageName = time() . '_' . $image->getClientOriginalName();

                $image->move(public_path('uploads/faqs/'), $imageName);

                // Save the image information to the database with the next priority
                FaqImage::create([
                    'image' => $imageName,
                    'faq_id' => $request->faq_id,
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
        $faq_image = FaqImage::findOrFail($id);

        if ($faq_image->image) {
            $oldThumbnailPath = public_path('uploads/faqs/' . $faq_image->image);
            if (file_exists($oldThumbnailPath)) {
                unlink($oldThumbnailPath);
            }
        }

        $faq_image->delete();
        // return response()->json(['success' => true]);
        return redirect()->back()->with('danger', 'Product Image Deleted');
    }
}
