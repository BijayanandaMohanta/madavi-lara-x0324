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
            'type' => 'required',
            'link' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            $image = 'ads_' . rand() . '.' . $request->image->extension();
            $data['image'] = $image;
            //dd($data['image']);
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
            'type' => 'required',
            'link' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            $image = 'ads_' . rand() . '.' . $request->image->extension();
            $data['image'] = $image;
            $request->image->move(public_path('uploads/ads'), $image);
        }

        Ad::find($id)->update($data);

        return redirect()->route('ads.index')->with('success', 'Ads Data Updated :)');
    }
    public function destroy($id) {
       $data = DB::connection('read')->table('ads')->where('id', $id)->first();
       $image_path = public_path("/uploads/ads/$data->image");
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
        (new Ad)->deleteData($id);
        return redirect()->route('ads.index')->with('message', 'Ads Data Deleted');
    }
}
