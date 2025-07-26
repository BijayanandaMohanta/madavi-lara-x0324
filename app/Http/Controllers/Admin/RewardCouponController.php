<?php

namespace App\Http\Controllers\Admin;

use App\Models\RewardCoupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RewardCouponController extends Controller
{
  public function index()
  {
    $data = RewardCoupon::all();
    return view('admin.reward_coupons.index', compact("data"));
  }
  //
  public function create()
  {
    return view('admin.reward_coupons.create');
  }

  public function store(Request $request)
  {
    // dd($request);
    $data = $this->validate($request, [
      'min_amount' => 'required',
      'discount_percentage' => 'required',
      'coupon_code' => 'required',
      'description' => 'required',
      'status' => 'required',
    ]);

    
    RewardCoupon::create($data);

    return redirect()->route('reward_coupons.index')->with('success', 'New Reward Coupon Added');
  }

  public function edit($id)
  {
    $data = RewardCoupon::where('id', $id)->first();
    return view('admin.reward_coupons.edit', compact('data'));
  }

  public function update(Request $request, $id)
  {
    $data = $this->validate($request, [
      'min_amount' => 'required',
      'discount_percentage' => 'required',
      'coupon_code' => 'required',
      'description' => 'required',
      'status' => 'required',
    ]);
    $record = RewardCoupon::find($id);
    $record->update($data);

    return redirect()->route('reward_coupons.index')->with('primary', 'Reward Coupons Updated Successfully');
  }
  function destroy($id)
  {
    $record = RewardCoupon::findOrFail($id);
    $record->delete();
    return redirect()->back()->with('danger', 'Reward Coupons Deleted Successfully');
  }
}
