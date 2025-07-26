<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandsController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('created_at', 'DESC')->get();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'brand' => 'required',
            'status' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,webp'
        ]);
        if ($request->hasFile('image')) {
            $image = 'brand_' . rand() . '.' . $request->image->extension();
            $data['image'] = $image;    
            //dd($data['image']);
            $request->image->move(public_path('uploads/brand/'), $image);
        }
        $data['slug'] = Str::slug($request->brand, '-');
        Brand::create($data);

        return redirect()->route('brands.index')->with('success', 'New Brand Added');

    }

    public function edit($id)
    {
        $data = Brand::where('id', $id)->first();
        return view('admin.brands.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'brand' => 'required',
            'status' => 'required',
            'image' => 'mimes:jpg,jpeg,png,webp'
        ]);
        if ($request->hasFile('image')) {
            $image = 'brand_' . rand() . '.' . $request->image->extension();
            $data['image'] = $image;
            $request->image->move(public_path('uploads/brand/'), $image);
        }
        $data['slug'] = Str::slug($request->brand, '-');
        Brand::find($id)->update($data);

        return redirect()->route('brands.index')->with('success', 'Brand Data Updated');

    }
    public function destroy($id) {

        $data = DB::connection('read')->table('brands')->where('id', $id)->first();
       
       $image_path = public_path("/uploads/brand/$data->image");
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
       
        (new Brand)->deleteData($id);
        return redirect()->route('brands.index')->with('danger', 'Brand Deleted');
    }
}
