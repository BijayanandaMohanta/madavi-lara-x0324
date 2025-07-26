<?php

namespace App\Http\Controllers\Admin;

use App\Models\AboutUs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $data = (new AboutUs)->getDataById('1');
        return view('admin.about_us.index', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'title' => 'required',
            'about_us_image' => 'mimes:jpg,jpeg,png',
            'about_us_description' => 'required',
            'designation' => 'required',
        ]);

        if ($request->hasFile('about_us_image')) {
            $image = 'about_us_image_' . rand() . '.' . $request->about_us_image->extension();
            $data['about_us_image'] = $image;
            $request->about_us_image->move(public_path('uploads'), $image);
        }

        AboutUs::find($id)->update($data);
        return redirect()->back()->with('success', 'About Us  Updated Successfully');
    }

    public function website_index()
    {
        $data = (new AboutUs)->getDataById('2');
        return view('admin.website.about_us.index', compact('data'));
    }

    public function website_update(Request $request)
    {
        $id = 2;
        $data = $this->validate($request, [
            'title' => 'required',
            'image_1' => 'mimes:jpg,jpeg,png',
            'image_2' => 'mimes:jpg,jpeg,png',
            'about_us_description' => 'required',
            'key_points' => 'required',
        ]);

        if ($request->hasFile('image_1')) {
            $image = 'about_us_image_1_' . rand() . '.' . $request->image_1->extension();
            $data['image_1'] = $image;
            $request->image_1->move(public_path('uploads'), $image);
        }
        if ($request->hasFile('image_2')) {
            $image = 'about_us_image_2_' . rand() . '.' . $request->image_2->extension();
            $data['image_2'] = $image;
            $request->image_2->move(public_path('uploads'), $image);
        }

        AboutUs::find($id)->update($data);
        return redirect()->back()->with('success', 'Website About Us  Updated Successfully');
    }

}
