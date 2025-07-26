<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Coupon;
use App\Product;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CouponController extends Controller
{
  public function index()
  {
    $coupons = Coupon::orderBy('created_at', 'desc')->get();
    return view('admin.coupons.index', compact('coupons'));
  }

  public function create()
  {
    $brands = Brand::all();
    $products = Product::all();
    $categories = Category::all();
    return view('admin.coupons.create', compact('brands', 'categories', 'products'));
  }

  public function store(Request $request)
  {

    $data = $this->validate($request, [
      'code' => 'required',
      'title' => 'required',
      'description' => 'required',
      'discount_type' => 'required',
      'offer_amount' => 'required',
      'start_date' => 'required|date',
      'exp_date' => 'required|date',
      'categories' => 'nullable',
      'brands' => 'nullable',
      'products' => 'nullable',
      'uses_limit' => 'required',
      'min_amount' => 'required',
      'max_discount' => 'required',
      'status' => 'required',
    ]);


    $array_set = $request->input('categories');

    if (!empty($array_set)) {
      $array_data = implode(',', $array_set);
      $data['categories'] = $array_data;
    } else {
      $data['categories'] = null;
    }

    $array_set_brands = $request->input('brands');

    if (!empty($array_set_brands)) {
      $array_data_brands = implode(',', $array_set_brands);
      $data['brands'] = $array_data_brands;
    } else {
      $data['brands'] = null;
    }

    $array_set_products = $request->input('products');

    if (!empty($array_set_products)) {
      $array_data_products = implode(',', $array_set_products);
      $data['products'] = $array_data_products;
    } else {
      $data['products'] = null;
    }

    $data['str_start_date'] = Carbon::parse($data['start_date'])->timestamp;
    $data['str_exp_date'] = Carbon::parse($data['exp_date'])->timestamp;    


    Coupon::create($data);

    return redirect()->route('coupon.index')->with('success', 'Coupon created successfully.');
  }


  public function edit($id)
  {
    $data = Coupon::find($id);
    $brands = Brand::all();
    $products = Product::all();
    $categories = Category::all();
    return view('admin.coupons.edit', compact('data', 'categories', 'brands', 'products'));
  }

  public function update(Request $request, $id)
  {
    $data = $this->validate($request, [
      'code' => 'required',
      'title' => 'required',
      'description' => 'required',
      'discount_type' => 'required',
      'offer_amount' => 'required',
      'start_date' => 'required|date',
      'exp_date' => 'required|date',
      'categories' => 'nullable',
      'brands' => 'nullable',
      'products' => 'nullable',
      'uses_limit' => 'required',
      'min_amount' => 'required',
      'max_discount' => 'required',
      'status' => 'required',
    ]);


    // Get the existing coupon
    $coupon = Coupon::find($id);

    $array_set = $request->input('categories');

    if (!empty($array_set)) {
      $array_data = implode(',', $array_set);
      $data['categories'] = $array_data;
    } else {
      $data['categories'] = null;
    }

    $array_set_brands = $request->input('brands');

    if (!empty($array_set_brands)) {
      $array_data_brands = implode(',', $array_set_brands);
      $data['brands'] = $array_data_brands;
    } else {
      $data['brands'] = null;
    }

    $array_set_products = $request->input('products');

    if (!empty($array_set_products)) {
      $array_data_products = implode(',', $array_set_products);
      $data['products'] = $array_data_products;
    } else {
      $data['products'] = null;
    }

    $data['str_start_date'] = Carbon::parse($data['start_date'])->timestamp;
    $data['str_exp_date'] = Carbon::parse($data['exp_date'])->timestamp;    


    // Update the coupon
    $coupon->update($data);
    //Coupon::create($data);

    return redirect()->route('coupon.index')->with('success', 'Coupon Added successfully.');
  }

  public function destroy($id)
  {
    $coupon = Coupon::find($id);
    $coupon->delete();
    return redirect()->route('coupon.index')->with('success', 'Coupon deleted successfully.');
  }
}
