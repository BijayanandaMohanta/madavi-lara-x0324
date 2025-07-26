<?php

namespace App\Http\Controllers\website;

use App\AboutUs;
use App\Brand;
use App\Banner;
use App\BreadcrumbImage;
use App\Category;
use App\ChargingSolutionsFullControl;
use App\ContactUs;
use App\Content;
use App\Enquiry;
use App\ChargingSolutionsData;
use App\ChargingSolution;
use App\ChargingSolutionsTotalControl;
use App\HaveToSay;
use App\Highlight;
use App\HowWeWork;
use App\Industries;
use App\IndustriesKeyPoint;
use App\Production;
use App\Service;
use App\Statistics;
use App\Subscriber;
use App\Talent;
use App\Testimonial;
use App\Timeline;
use App\Partner;
use App\Http\Controllers\Controller;
use App\Faq;
use App\Setting;
use App\NewsMedia;
use App\Writer;
use Illuminate\Http\Request;
use Validator;

class UsersController extends Controller
{
    public function login()
    {
        return view('main.user.login');
    }

    public function otp(Request $request)
    {
        return $request;
        return view('main.user.otp');
    }
}
