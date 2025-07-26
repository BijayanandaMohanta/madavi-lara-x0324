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
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'category' => 'required|unique:categories,category',
            'status' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,webp',
        ]);
        if ($request->hasFile('image')) {
            $image = 'category_' . rand() . '.' . $request->image->extension();
            $data['image'] = $image;
            //dd($data['image']);
            $request->image->move(public_path('uploads/category/'), $image);
        }
       
        $data['slug'] = Str::slug($request->category, '-');
        Category::create($data);

        return redirect()->route('categories.index')->with('success', 'New Category Added');
    }

    public function edit($id)
    {
        $data = Category::where('id', $id)->first();
        return view('admin.categories.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'category' => 'required',
            'status' => 'required',
            'image' => 'mimes:jpg,jpeg,png,webp',
        ]);
        if ($request->hasFile('image')) {
            $image = 'category_' . rand() . '.' . $request->image->extension();
            $data['image'] = $image;
            $request->image->move(public_path('uploads/category/'), $image);
        }
     
        $data['slug'] = Str::slug($request->category, '-');
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

}
