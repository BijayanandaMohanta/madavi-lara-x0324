<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
  public function index()
  {
    $data = Testimonial::all();
    return view('admin.testimonial.index', compact("data"));
  }
  //
  public function create()
  {
    return view('admin.testimonial.create');
  }

  public function store(Request $request)
  {
    // dd($request);
    $data = $this->validate($request, [
      'rating' => 'required',
      'name' => 'required|max:150',
      'designation' => 'required|max:120',
      'city' => 'required|max:100',
      'review' => 'required',
      'profile_image' => 'required|image',
    ]);

    if ($request->hasFile('profile_image')) {
      $profile_image = 'profile_image' . rand() . '.' . $request->profile_image->extension();
      $data['profile_image'] = $profile_image;
      $request->profile_image->move(public_path('uploads/testimonial/'), $profile_image);
    }

    Testimonial::create($data);

    return redirect()->route('testimonial.index')->with('success', 'New Testimonial Added');
  }

  public function edit($id)
  {
    $data = Testimonial::where('id', $id)->first();
    return view('admin.testimonial.edit', compact('data'));
  }

  public function update(Request $request, $id)
  {
    $data = $this->validate($request, [
      'rating' => 'required',
      'name' => 'required|max:150',
      'designation' => 'required|max:120',
      'city' => 'required|max:100',
      'review' => 'required',
      'profile_image' => 'nullable|image',
    ]);
    $record = Testimonial::find($id);

    if ($request->hasFile('profile_image')) {
      // Upload the new video file
      $profile_image = 'profile_image' . rand() . '.' . $request->profile_image->extension();
      $request->profile_image->move(public_path('uploads/testimonial/'), $profile_image);

      $data['profile_image'] = $profile_image;
    }
    $record->update($data);

    return redirect()->route('testimonial.index')->with('primary', 'Testimonial Updated Successfully');
  }
  function destroy($id)
  {
    $record = Testimonial::findOrFail($id);
    // Delete the old video file if it exists
    if ($record->profile_image) {
      $oldFilePath = public_path('uploads/testimonial/' . $record->profile_image);
      if (file_exists($oldFilePath)) {
        unlink($oldFilePath);
      }
    }
    $record->delete();
    return redirect()->back()->with('danger', 'Testimonial Deleted Successfully');
  }
}
