<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\CategoryAd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();
        
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $existingPriorities = Category::where('display_menu',1)->pluck('priority')->all();

        $priorities = range(1, 7);
        $availablePriorities = array_diff($priorities, $existingPriorities);
        return view('admin.categories.create',compact('availablePriorities'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'category' => 'required|unique:categories,category',
            'status' => 'required',
            'display_menu' => 'required',
            'display_home' => 'required',
            'priority' => 'nullable',
            'image' => 'required|mimes:jpg,jpeg,png,webp',
            'banner_image' => 'required|mimes:jpg,jpeg,png,webp',
            'homepage_side' => 'required|mimes:jpg,jpeg,png,webp',
            'homepage_side_mobile' => 'required|mimes:jpg,jpeg,png,webp'
        ]);
        if ($request->hasFile('image')) {
            $image = 'category_' . rand() . '.' . $request->image->extension();
            $data['image'] = $image;
            //dd($data['image']);
            $request->image->move(public_path('uploads/category/'), $image);
        }
        if ($request->hasFile('banner_image')) {
            $image1 = 'category_' . rand() . '.' . $request->banner_image->extension();
            $data['banner_image'] = $image1;
            //dd($data['image']);
            $request->banner_image->move(public_path('uploads/category/'), $image1);
        }
        if ($request->hasFile('homepage_side')) {
            $image11 = 'category_' . rand() . '.' . $request->homepage_side->extension();
            $data['homepage_side'] = $image11;
            //dd($data['image']);
            $request->homepage_side->move(public_path('uploads/category/'), $image11);
        }
        if ($request->hasFile('homepage_side_mobile')) {
            $image11 = 'category_' . rand() . '.' . $request->homepage_side_mobile->extension();
            $data['homepage_side_mobile'] = $image11;
            //dd($data['image']);
            $request->homepage_side_mobile->move(public_path('uploads/category/'), $image11);
        }
        $data['slug'] = Str::slug($request->category, '-');
        Category::create($data);

        return redirect()->route('categories.index')->with('success', 'New Category Added');
    }

    public function edit($id)
    {
        $data = Category::where('id', $id)->first();
        $existingPriorities = Category::where('display_menu',1)->pluck('priority')->all();

        $priorities = range(1, 7);
        $availablePriorities = array_diff($priorities, $existingPriorities);
        return view('admin.categories.edit', compact('data','availablePriorities'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'category' => 'required',
            'status' => 'required',
            'display_menu' => 'required',
            'display_home' => 'required',
            'priority' => 'nullable',
            'image' => 'mimes:jpg,jpeg,png,webp',
            'banner_image' => 'mimes:jpg,jpeg,png,webp',
            'homepage_side' => 'mimes:jpg,jpeg,png,webp',
            'homepage_side_mobile' => 'mimes:jpg,jpeg,png,webp'
        ]);
        if ($request->hasFile('image')) {
            $image = 'category_' . rand() . '.' . $request->image->extension();
            $data['image'] = $image;
            $request->image->move(public_path('uploads/category/'), $image);
        }
        if ($request->hasFile('banner_image')) {
            $image1 = 'category_' . rand() . '.' . $request->banner_image->extension();
            $data['banner_image'] = $image1;
            $request->banner_image->move(public_path('uploads/category/'), $image1);
        }
        if ($request->hasFile('homepage_side')) {
            $image11 = 'category_' . rand() . '.' . $request->homepage_side->extension();
            $data['homepage_side'] = $image11;
            $request->homepage_side->move(public_path('uploads/category/'), $image11);
        }
        if ($request->hasFile('homepage_side_mobile')) {
            $image11 = 'category_' . rand() . '.' . $request->homepage_side_mobile->extension();
            $data['homepage_side_mobile'] = $image11;
            $request->homepage_side_mobile->move(public_path('uploads/category/'), $image11);
        }
        $data['slug'] = Str::slug($request->category, '-');
        if($request->display_menu == '0'){
            $data['priority']=0;
        }
        Category::find($id)->update($data);

        return redirect()->route('categories.index')->with('success', 'Category Data Updated');
    }
    public function destroy($id)
    {

        $data = DB::connection('read')->table('categories')->where('id', $id)->first();

        $image_path = public_path("/uploads/category/$data->image");
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        (new Category)->deleteData($id);
        return redirect()->route('categories.index')->with('danger', 'category Deleted');
    }

    //ads

    // Additional Floor plan

    public function ad_index($id)
    {
        $data = CategoryAd::where('category_id', $id)->get();
        return view('admin.categories.ad', compact('data', 'id'));
    }
    public function ad_edit($id)
    {
        $data = CategoryAd::where('id', $id)->first();
        return view('admin.categories.ad_edit', compact('data'));
    }

    public function ad_store(Request $request)
    {
        // 
        $data = $this->validate($request, [
            'category_id' => 'required',
            'image' => 'required',
            'priority' => 'required|integer',
            'redirect_link' => 'required|max:255',
        ]);

        // Handle the thumbnail image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $thumbnail_name = time() . 'ad.' . $image->getClientOriginalExtension();
            $thumbnail_path = public_path('/uploads/ads/');
            $image->move($thumbnail_path, $thumbnail_name);
            $data['image'] = $thumbnail_name;
        }

        CategoryAd::create($data);

        return redirect()->back()->with('success', 'New Ad Added');
    }

    public function ad_update(Request $request, $id)
    {
        // var_dump($request);
        $data = $this->validate($request, [
            'image' => 'nullable',
            'priority' => 'required|integer',
            'redirect_link' => 'required|max:255',
        ]);

        $record = CategoryAd::find($id);

        // Handle the thumbnail image upload
        if ($request->hasFile('image')) {
            // Delete the old thumbnail image if it exists
            $oldThumbnailPath = public_path('uploads/ads/' . $record->image);
            if ($record->image) {
                if (file_exists($oldThumbnailPath)) {
                    unlink($oldThumbnailPath);
                }
            }
            // Upload the new thumbnail image
            $image = $request->file('image');
            $thumbnail_name = time() . 'ad.' . $image->getClientOriginalExtension();
            $thumbnail_path = public_path('/uploads/ads/');
            $image->move($thumbnail_path, $thumbnail_name);
            $data['image'] = $thumbnail_name;
        }

        $record->update($data);

        return redirect()->route('categories.ad_index', $request->category_id)->with('primary', 'Ad Data Updated :)');
    }

    public function ad_destroy($id)
    {
        $record = CategoryAd::findOrFail($id);

        // Delete the thumbnail image if it exists
        if ($record->image) {
            $oldThumbnailPath = public_path('uploads/ads/' . $record->image);
            if (file_exists($oldThumbnailPath)) {
                unlink($oldThumbnailPath);
            }

            $record->delete();

            return redirect()->back()->with('danger', 'Ad Deleted successfully');
        }
    }
}
