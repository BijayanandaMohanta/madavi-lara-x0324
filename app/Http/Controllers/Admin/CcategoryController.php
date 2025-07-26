<?php

namespace App\Http\Controllers\Admin;

use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Ccategory;
use App\Models\Scategory;
use App\Models\Category;
use App\Models\Test;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CcategoryController extends Controller
{
   public function index()
{
    $scategories = DB::connection('read')->table('ccategories')->orderBy('created_at', 'DESC')->get();
    foreach ($scategories as $data) {
            $data->name = Category::where('id', $data->category_id)->value('category');
            $data->sub_cat = Scategory::where('id', $data->sub_category_id)->value('category');
        }

    return view('admin.ccategories.index', compact('scategories'));
}

    public function create()
    {
      
        $categories = DB::connection('read')->table('categories')->where('status',1)->get();
        $scategories = DB::connection('read')->table('scategories')->where('status',1)->get();
        return view('admin.ccategories.create', compact('categories','scategories'));
    }

    public function store(Request $request)
    {
        //return $request;
        $data = $this->validate($request, [
            'category' => 'required|unique:ccategories,category',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp',
            'status' => 'required'
        ]);
        if ($request->hasFile('image')) {
            $image = 'scategory_' . rand() . '.' . $request->image->extension();
            $data['image'] = $image;
            //dd($data['image']);
            $request->image->move(public_path('uploads/ccategory'), $image);
        }
        $data['slug'] = Str::slug($request->category, '-');
        Ccategory::create($data);

        return redirect()->route('ccategories.index')->with('success', 'New Child category Added');

    }

    public function edit($id)
    {
        $data = DB::connection('read')->table('ccategories')->where('id', $id)->first();
       
        $categories = DB::connection('read')->table('categories')->where('status',1)->get();
        $scategories = DB::connection('read')->table('scategories')->where('status',1)->get();
        
        return view('admin.ccategories.edit', compact('data','categories','scategories'));
    }
    public function fetchscategory(Request $request)
    {
        $data['scategories'] = Scategory::where("category_id", $request->category_id)
                                    ->get(["category", "id"]);

        return response()->json($data);
    }
    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'category' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp',
            'status' => 'required'
        ]);
        if ($request->hasFile('image')) {
            $image = 'child_category_' . rand() . '.' . $request->image->extension();
            $data['image'] = $image;
            //dd($data['image']);
            $request->image->move(public_path('uploads/ccategory'), $image);
        }
        $data['slug'] = Str::slug($request->category, '-');
        Ccategory::find($id)->update($data);

        return redirect()->route('ccategories.index')->with('success', 'Child category Data Updated');

    }
    public function destroy($id) {

        $data = DB::connection('read')->table('ccategories')->where('id', $id)->first();
       
       
       

        (new Ccategory)->deleteData($id);
        return redirect()->route('ccategories.index')->with('danger', 'Child category Deleted');
    }
}
