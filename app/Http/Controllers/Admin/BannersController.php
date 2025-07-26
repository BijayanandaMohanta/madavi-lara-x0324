<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class BannersController extends Controller
{

    public function index()
    {
        $banners = Banner::orderby('created_at', 'DESC')->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'image' => 'required|mimes:jpg,jpeg,png,webp',
           
            'link' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            $image = 'banner_image_' . rand() . '.' . $request->image->extension();
            $data['image'] = $image;
            //dd($data['image']);
            $request->image->move(public_path('uploads/banners'), $image);
        }

        Banner::create($data);

        return redirect()->route('banners.index')->with('success', 'New Banner Added');
    }

    public function edit($id)
    {
        $data = Banner::where('id', $id)->first();
        return view('admin.banners.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'image' => 'mimes:jpg,jpeg,png,webp',
            'link' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            $image = 'banner_image_' . rand() . '.' . $request->image->extension();
            $data['image'] = $image;
            $request->image->move(public_path('uploads/banners'), $image);
        }

        Banner::find($id)->update($data);

        return redirect()->route('banners.index')->with('success', 'Banner Data Updated :)');
    }
    public function destroy($id) {
       $data = DB::connection('read')->table('banners')->where('id', $id)->first();
       $image_path = public_path("/uploads/banners/$data->image");
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
        (new Banner)->deleteData($id);
        return redirect()->route('banners.index')->with('message', 'Banner Data Deleted');
    }
}
