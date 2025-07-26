<?php

namespace App\Http\Controllers\Admin;

use App\Models\VideoReviews;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoReviewsController extends Controller
{
  public function index()
  {
    $videos = VideoReviews::orderBy('created_at', 'DESC')->get();
    return view('admin.video_reviews.index', compact('videos'));
  }

  public function create()
  {
    return view('admin.video_reviews.create');
  }

  public function store(Request $request)
  {
    //dd($request);
    $data = $this->validate($request, [
      'video' => 'nullable|mimes:mp4,mkv',
      'link' => 'required|max:255'
    ]);
    if ($request->hasFile('video')) {
      $video = 'brand_' . rand() . '.' . $request->video->extension();
      $data['video'] = $video;
      //dd($data['image']);
      $request->video->move(public_path('uploads/videos/'), $video);
    }

    VideoReviews::create($data);

    return redirect()->route('videoreviews.index')->with('success', 'New video Added');
  }

  public function edit($id)
  {
    $data = VideoReviews::where('id', $id)->first();
    return view('admin.video_reviews.edit', compact('data'));
  }

  public function update(Request $request, $id)
  {
    $data = $this->validate($request, [
      'video' => 'nullable|mimes:mp4,mkv',
      'link' => 'required|max:255'
    ]);
    if ($request->hasFile('video')) {
      $video = 'video_' . rand() . '.' . $request->video->extension();
      $data['video'] = $video;
      $request->video->move(public_path('uploads/videos/'), $video);
    }

    VideoReviews::find($id)->update($data);

    return redirect()->route('videoreviews.index')->with('success', 'video Data Updated');
  }
  public function destroy($id)
  {

    $data = VideoReviews::findOrFail($id);

    
    $data->delete();

    return redirect()->route('videoreviews.index')->with('danger', 'video Deleted');
  }
}
