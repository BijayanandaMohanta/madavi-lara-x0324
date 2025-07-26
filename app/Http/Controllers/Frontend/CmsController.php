<?php

namespace App\Http\Controllers\frontend;

use App\Contact;
use App\Faq;
use App\Http\Controllers\Controller;
use App\Pages;
use App\Setting;
use App\StoreGallery;
use Illuminate\Http\Request;

class CmsController extends Controller
{
  //
  public function termsofservice()
  {
    $data = Pages::where('id', 2)->first();
    return view("frontend.terms-of-service", compact("data"));
  }
  public function privacypolicy()
  {
    $data = Pages::where('id', 3)->first();
    return view('frontend.privacy-policy', compact("data"));
  }
  public function refundpolicy()
  {
    $data = Pages::where('id', 5)->first();
    return view('frontend.refund-policy', compact("data"));
  }
  public function shoppingpolicy()
  {
    $data = Pages::where('id', 9)->first();
    return view('frontend.shipping-policy', compact("data"));
  }
  public function paymentpolicy()
  {
    $data = Pages::where('id', 8)->first();
    return view('frontend.payment-policy', compact("data"));
  }
  public function aboutus()
  {
    $data = Pages::where('id', 7)->first();
    return view('frontend.about-us', compact("data"));
  }
  public function contactus()
  {
    $setting = Setting::first();
    return view('frontend.contact-us', compact('setting'));
  }
  public function contactsave(Request $request)
  {
    $request->validate([
      'first_name' => 'required|string|max:255',
      'last_name' => 'required|string|max:255',
      'email' => 'required|email|max:255',
      'mobile_no' => 'required|string|max:20',
      'message' => 'nullable|string',
    ]);
    $data = $request->all();

    Contact::create($data);
    return redirect()->back()->with('success', 'Message sent successfully');
  }
  public function faq()
  {
    $faqs = Faq::with('faqimages')->get();
    return view('frontend.faqs',compact('faqs'));
  }
  public function warranty()
  {
    $data = Pages::where('id', 10)->first();
    return view('frontend.warranty', compact("data"));
  }
  public function storegallery()
  {
    $images = StoreGallery::all();
    return view('frontend.store-gallery', compact('images'));
  }
}
