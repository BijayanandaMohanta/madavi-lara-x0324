<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class MenusController extends Controller
{

    public function index()
    {
        $menus = Menu::orderby('created_at', 'DESC')->get();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'image' => 'required|mimes:jpg,jpeg,png,webp',
        ]);

        if ($request->hasFile('image')) {
            $image = 'menu_image_' . rand() . '.' . $request->image->extension();
            $data['image'] = $image;
            //dd($data['image']);
            $request->image->move(public_path('uploads/menus'), $image);
        }

        Menu::create($data);

        return redirect()->route('menus.index')->with('success', 'New Menu Added');
    }

    public function edit($id)
    {
        $data = Menu::where('id', $id)->first();
        return view('admin.menus.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'image' => 'mimes:jpg,jpeg,png,webp',
        ]);

        if ($request->hasFile('image')) {
            $image = 'menu_image_' . rand() . '.' . $request->image->extension();
            $data['image'] = $image;
            $request->image->move(public_path('uploads/menus'), $image);
        }
        Menu::find($id)->update($data);
        return redirect()->route('menus.index')->with('success', 'Menu Data Updated :)');
    }
    public function destroy($id)
    {
        $data = Menu::find($id);
        $image_path = public_path("/uploads/menus/$data->image");
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $data->delete();
        return redirect()->route('menus.index')->with('message', 'Menu Data Deleted');
    }
}
