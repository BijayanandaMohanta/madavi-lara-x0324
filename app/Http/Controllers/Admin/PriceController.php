<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Price;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index(Request $request)
    {
        // edit
        $edit_id = $request->edit_id;
        if ($edit_id) {
            $product_price = Price::find($edit_id);
            if ($product_price) {
                $data = Price::find($edit_id);
                $product_id = $data->product_id;
            } else {
                $data = [];
            }
        } else {
            $data = [];
        }

        $product_id = $product_id ?? $request->id;
        $product = Product::find($product_id);
        // Return if issue
        if ($product_id == null) {
            return redirect()->route('products.index')->with('danger', 'Product not found');
        }

        $product_price = Price::where('product_id', $product_id)->get();
        if ($product_price) {
            $alldata = Price::where('product_id', $product_id)->get();
        } else {
            $alldata = [];
        }
        // dd($data);
        return view('admin.product_price.index', compact('data', 'product_id', 'product', 'alldata'));
    }
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'product_id' => 'required',
            'quantity' => 'required',
            'amount' => 'required',
        ]);
       
        Price::create($data);

        return redirect()->back()->with('success', 'New Added');
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'product_id' => 'required',
            'quantity' => 'required',
            'amount' => 'required',
        ]);
       
        $section = Price::findOrFail($id);
        $section->update($data);
        return redirect()
        ->route("product-price.index", ['id' => $data['product_id']])
        ->with('primary', 'Updated Successfully');
    }
    public function destroy($id)
    {
        $section = Price::findOrFail($id);
        if($section->image && file_exists(public_path($section->image))) {
            unlink(public_path($section->image));
        }
        $section->delete();
        return redirect()
        ->route("product-price.index", ['id' => $section->product_id])
        ->with('danger', 'Deleted Successfully');
    }
}
