<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagsController extends Controller
{
  public function index()
  {
    $tags = Tag::orderBy('created_at', 'DESC')->get();
    return view('admin.tags.index', compact('tags'));
  }

  public function create()
  {
    return view('admin.tags.create');
  }

  public function store(Request $request)
  {
    //dd($request);
    $data = $this->validate($request, [
      'tag' => 'required|max:70'
    ]);
    
    Tag::create($data);

    return redirect()->route('tags.index')->with('success', 'New tag Added');
  }

  public function edit($id)
  {
    $data = Tag::where('id', $id)->first();
    return view('admin.tags.edit', compact('data'));
  }

  public function update(Request $request, $id)
  {
    $data = $this->validate($request, [
      'tag' => 'required|max:70'
    ]);
    
    Tag::find($id)->update($data);

    return redirect()->route('tags.index')->with('success', 'Data Updated');
  }
  public function destroy($id)
  {

    $data = Tag::findOrFail($id);

    $data->delete();

    return redirect()->route('tags.index')->with('danger', 'tag Deleted');
  }
}
