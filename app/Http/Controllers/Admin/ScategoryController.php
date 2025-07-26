<?php

namespace App\Http\Controllers\Admin;

use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Scategory;
use App\Models\Category;
use App\Models\Test;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScategoryController extends Controller
{
    public function index()
    {
        $scategories = DB::connection('read')->table('scategories')->orderBy('created_at', 'DESC')->get();
        foreach ($scategories as $data) {
            $data->name = Category::where('id', $data->category_id)->value('category');
        }

        return view('admin.scategories.index', compact('scategories'));
    }

    public function create()
    {

        $categories = DB::connection('read')->table('categories')->where('status', 1)->get();
        $brands = DB::connection('read')->table('brands')->where('status', 1)->get();
        return view('admin.scategories.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        //return $request;
        $data = $this->validate($request, [
            'category' => 'required',

            'category_id' => 'required',
            
            'image' => 'nullable|mimes:jpg,jpeg,png,webp',
            'status' => 'required'
        ]);
        if ($request->hasFile('image')) {
            $image = 'scategory_' . rand() . '.' . $request->image->extension();
            $data['image'] = $image;
            //dd($data['image']);
            $request->image->move(public_path('uploads/scategory'), $image);
        }
        //$selectedCategories = $request->input('brands');

        // Implode selected categories into a comma-separated string
        //$categoriesString = implode(',', $selectedCategories);
        //$data['brands'] = $categoriesString;
        $data['slug'] = Str::slug($request->category, '-');
        Scategory::create($data);

        return redirect()->route('scategories.index')->with('success', 'New Sub category Added');
    }

    public function edit($id)
    {
        $data = DB::connection('read')->table('scategories')->where('id', $id)->first();

        $categories = DB::connection('read')->table('categories')->where('status', 1)->get();
        $brands = DB::connection('read')->table('brands')->where('status', 1)->get();
        return view('admin.scategories.edit', compact('data', 'categories', 'brands'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'category' => 'required',
            'category_id' => 'required',
           
            'image' => 'nullable|mimes:jpg,jpeg,png,webp',
            'status' => 'required'
        ]);
        if ($request->hasFile('image')) {
            $image = 'profile_' . rand() . '.' . $request->image->extension();
            $data['image'] = $image;
            //dd($data['image']);
            $request->image->move(public_path('uploads/scategory'), $image);
        }
        //$selectedCategories = $request->input('brands');

        // Implode selected categories into a comma-separated string
        // $categoriesString = implode(',', $selectedCategories);
        // $data['brands'] = $categoriesString;
        $data['slug'] = Str::slug($request->category, '-');
        Scategory::find($id)->update($data);

        return redirect()->route('scategories.index')->with('success', 'Sub category Data Updated');
    }
    public function destroy($id)
    {

        $data = DB::connection('read')->table('scategories')->where('id', $id)->first();

        $image_path = public_path("/uploads/scategory/$data->image");
        // if (file_exists($image_path)) {
        //     unlink($image_path);
        // }


        (new Scategory)->deleteData($id);
        return redirect()->route('scategories.index')->with('danger', 'Sub category Deleted');
    }
}
