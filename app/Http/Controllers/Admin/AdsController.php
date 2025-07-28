<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ad;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AdsController extends Controller
{

    public function index()
    {
        $banners = Ad::orderby('created_at', 'DESC')->get();
        return view('admin.ads.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.ads.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'image' => 'required|mimes:jpg,jpeg,png',
            'tag' => 'required',
            'title' => 'required',
            'sub_title' => 'required',
            'link' => 'nullable',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = 'ads_' . rand() . '.' . $request->image->extension();
            $imagePath = 'uploads/ads/' . $image;
            $data['image'] = $imagePath;
            $request->image->move(public_path('uploads/ads'), $image);
        }

        Ad::create($data);

        return redirect()->route('ads.index')->with('success', 'New Ads Added');
    }

    public function edit($id)
    {
        $data = Ad::where('id', $id)->first();
        return view('admin.ads.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'image' => 'mimes:jpg,jpeg,png',
            'tag' => 'required',
            'title' => 'required',
            'sub_title' => 'required',
            'link' => 'nullable',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = 'ads_' . rand() . '.' . $request->image->extension();
            $imagePath = 'uploads/ads/' . $image;
            $data['image'] = $imagePath;
            $request->image->move(public_path('uploads/ads'), $image);
        }

        Ad::find($id)->update($data);

        return redirect()->route('ads.index')->with('success', 'Ads Data Updated :)');
    }
    public function destroy($id) {
       $data = Ad::find($id);
       $image_path = public_path("/uploads/ads/$data->image");
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
        $data->delete();
        return redirect()->route('ads.index')->with('message', 'Ads Data Deleted');
    }
}
