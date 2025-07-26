<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
   
    public function index()
    {
        $pages = (new Pages)->listData();
        return view('admin.pages.index', compact('pages'));
    }


  
    public function edit($id)
    {
        $page = (new Pages)->getDataById($id);
        return view('admin.pages.edit', compact('page'));
    }

   
    public function update(Request $request, $id)
    {
        $page = (new Pages)->getDataById($id);
        $data = $this->validate($request, [
            'description' => 'required|string'
        ]);

        $image_name = $page->image;
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $path = public_path('/uploads');
            $image->move($path,$image_name);
        }

        $data['image'] = $image_name;
        $data['description2'] = $request['description2'];

        $update = (new Pages)->updateData($data, $id);
       
        return redirect()->route('pages.index')->with('message', 'Page Update');
    }

}
