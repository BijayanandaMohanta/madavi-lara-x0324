<?php

namespace App\Http\Controllers\Admin;

use App\Models\AboutUs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $data = AboutUs::find(1);
        return view('admin.about_us.index', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'title' => 'required',
            'image' => 'mimes:jpg,jpeg,png',
            'description' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = 'image_' . rand() . '.' . $request->image->extension();
            $data['image'] = $image;
            $request->image->move(public_path('uploads'), $image);
        }

        AboutUs::find($id)->update($data);
        return redirect()->back()->with('success', 'About Us  Updated Successfully');
    }

   
}
