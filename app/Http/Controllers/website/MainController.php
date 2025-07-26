<?php

namespace App\Http\Controllers\website;

use App\AboutUs;
use App\BlogCategory;
use App\BlogPost;
use App\ChargingSolutionsFullControl;
use App\ContactUs;
use App\Faqs;
use App\Subscriber;
use App\Http\Controllers\Controller;
use App\WebsiteHomeBanner;
use App\WebsiteOurTeam;
use Illuminate\Http\Request;
use Validator;

class MainController extends Controller
{
    public function home()
    {
        $banners = WebsiteHomeBanner::where('status', 1)->latest()->get();
        $about_us = AboutUs::where('id', 2)->first();
        $about_us_key_points = explode(',', $about_us->key_points);
        $our_team = WebsiteOurTeam::where('status', 1)->limit(4)->latest()->get();

        $data = [
            'banners' => $banners,
            'about_us' => $about_us,
            'about_us_key_points' => $about_us_key_points,
            'our_team' => $our_team,
        ];
        return view('main.index', compact('data'));
    }

    public function about_us()
    {
        $data = AboutUs::where('id', 2)->first();
        return view('main.about_us', compact('data'));
    }

    public function courses()
    {
        return view('main.courses');
    }

    public function course_listing($slug)
    {
        return view('main.course_listing');
    }

    public function course_view($slug)
    {
        return view('main.course_view');
    }

    public function faqs()
    {
        $data = Faqs::orderBy('priority', 'ASC')->get();
        return view('main.faqs', compact('data'));
    }

    public function blog()
    {
        $data = BlogPost::leftJoin('blog_categories', 'blog_categories.id', 'blog_posts.category_id')
            ->select('blog_posts.*', 'blog_categories.title as category_title')
            ->where('blog_posts.status', 1)
            ->orderby('blog_posts.created_at', 'DESC')
            ->paginate(1);

        $categories = BlogCategory::where('status', 1)->latest()->get();
        return view('main.blog', compact('data', 'categories'));
    }

    public function blog_view($slug)
    {
//        $data =
        return view('main.blog_view');
    }

    public function contact_us()
    {
        return view('main.contact');
    }

    public function terms_and_conditions()
    {
        return view('main.terms_and_conditions');
    }

    public function privacy_policy()
    {
        return view('main.privacy_policy');
    }

    public function refund_and_cancellation()
    {
        return view('main.refund_and_cancellation');
    }

    public function shop()
    {
        return view('main.shop');
    }

    public function amazing_apps()
    {
        return view('main.amazing_apps');
    }

    public function library_wishlist_books()
    {
        return view('main.library_wishlist_books');
    }

    public function our_team()
    {
        $data = WebsiteOurTeam::where('status', 1)->latest()->get();
        return view('main.our_team', compact('data'));
    }

    public function submit_contact(Request $request)
    {
        if ($request->from == 'contact_form') {
            $data = Validator::make($request->all(), [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email',
                'number' => 'required|numeric',
                'what_do_you_have_to_say' => 'required',
                'message' => 'required',
            ]);
        }

        if ($request->from == 'subscribe') {
            $data = Validator::make($request->all(), [
                'email' => 'required|email|unique:subscribers,email',
            ]);
        }

        if ($data->fails()) {
            $response = [
                'status' => 'error',
                'color' => '#bf441d',
                'header' => 'Please Fill',
                'message' => $data->errors()->first()
            ];
            return response()->json($response);
        }

        if ($request->from == 'contact_form') {
            $enquiry = new ContactUs();
            $enquiry->first_name = $request->first_name;
            $enquiry->last_name = $request->last_name;
            $enquiry->email = $request->email;
            $enquiry->number = $request->number;
            $enquiry->what_do_you_have_to_say = $request->what_do_you_have_to_say;
            $enquiry->message = $request->message;
            $save = $enquiry->save();
        }
        if ($request->from == 'subscribe') {
            $enquiry = new Subscriber();
            $enquiry->email = $request->email;
            $enquiry->save();
            $response = [
                'status' => 'success',
                'color' => '#5ba035',
                'header' => 'Thank You',
                'message' => 'For subscribing our news letter :)'
            ];
            return response()->json($response);
        }

        if ($save) {
            $response = [
                'status' => 'success',
                'color' => '#5ba035',
                'header' => 'Thank You',
                'message' => 'Your request received our team will get back to you soon :)'
            ];
        } else {
            $response = [
                'status' => 'error',
                'color' => '#bf441d',
                'header' => 'Sorry',
                'message' => 'Please Try Again'
            ];
        }

        return response()->json($response);
    }
}
