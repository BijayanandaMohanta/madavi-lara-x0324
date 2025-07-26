<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Ccategory;
use App\Models\ProductReview;
use App\Models\Scategory;
use App\Models\Tag;
use App\Models\Testimonial;
use Illuminate\Support\Str;

class ProductReviewController extends Controller
{
  public function index()
  {
    $productreviews = ProductReview::orderBy('created_at', 'desc')->with('product')->get();
    return view('admin.productreviews.index', compact('productreviews'));
  }

  public function update_review_status(Request $request)
  {
    $productreview = ProductReview::find($request->review_id);
    $productreview->status =  ($productreview->status == 1) ? 0 : 1;
    $productreview->save();
    $success = 'Updated';
    return response()->json(['success' => $success]);
  }
  public function update_review_status_home(Request $request)
  {
    $productreview = ProductReview::find($request->review_id);
    print_r($request->review_id);
    $productreview->home_display =  ($productreview->home_display == 1) ? 0 : 1;
    $productreview->save();
    $success = 'Updated';

    $productreview_data = ProductReview::find($request->review_id);
    $home = $productreview->home_display;
    if($home == 1){
      $testi = new Testimonial();
      $testi->name = $productreview_data->name;
      $testi->rating = $productreview_data->rating;
      $testi->review = $productreview_data->review;
      $testi->profile_image = 'defaultprofile.png';
      $testi->city = 'N/A';
      $testi->save();
    }else{
       Testimonial::where('name', $productreview_data->name)
            ->where('profile_image', 'defaultprofile.png')
            ->where('rating', $productreview_data->rating)
            ->where('review', $productreview_data->review)
            ->delete();
    }


    return response()->json(['success' => $success]);
  }
 

  public function destroy($id)
  {
    $record = ProductReview::find($id);
    $record->delete();
    return redirect()->route('productreviews.index')->with('danger', 'Product Review deleted successfully.');
  }
}
