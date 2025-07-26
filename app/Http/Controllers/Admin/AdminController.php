<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Scategory;
use App\Models\Brand;
use App\Models\Contact;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;




class AdminController extends Controller
{
    public function index()
    {
        $categories = Category::count();
        $scategories = Scategory::count();
        $brands = Brand::count();
        $products = Product::count();
        $recentOrders = Order::where('order_status', '!=', 'Pending')->orderBy('id', 'desc')->limit(10)->get();
        $productreviews = ProductReview::count();
        $contacts = Contact::count();
        $balance = (new \App\Http\Controllers\HelperController())->balance();

        $totalPlacedOrders = Order::where('txn_id', '!=', '')->where('ship_shipment_id', NULL)->whereNotIn('order_status',['Cancelled','Delivered','Store Pickuped'])->count();

        $todayOrders = Order::whereDate('created_at', today())
            ->where('order_status', '!=', 'Pending')
            ->count();

        $totalOrders = Order::where('order_status', '!=', 'Pending')
            ->where(function ($query) {
                $query->where('payment_option', '=', 'Pay Online')
                    ->where('txn_id', '!=', '')
                    ->orWhere('payment_option', '!=', 'Pay Online');
            })->count();

        $todayEarnings = Order::whereDate('created_at', today())
            ->where('order_status', '!=', 'Pending')
            ->where('order_status', '!=', 'Cancelled')
            ->sum('grand_total');

        $todayEarningsDiscounts = Order::whereDate('created_at', today())
            ->where('order_status', '!=', 'Pending')
            ->where('order_status', '!=', 'Cancelled')
            ->sum('coupon');

        $todayEarnings = $todayEarnings - $todayEarningsDiscounts;
        $todayEarnings = round($todayEarnings);

        $totalEarnings = Order::where('order_status', '!=', 'Cancelled')
            ->where('order_status', '!=', 'Pending')
            ->sum('grand_total');
        
       $weeklyStart = Carbon::now()->startOfWeek();     // Monday of this week
$monthStart  = Carbon::now()->startOfMonth();    // 1st of this month

// Get the later of weeklyStart and monthStart
$effectiveStart = $weeklyStart->greaterThan($monthStart) ? $weeklyStart : $monthStart;

$weeklyEarnings = Order::where('created_at', '>=', $effectiveStart)
    ->whereNotIn('order_status', ['Pending', 'Cancelled'])
    ->sum('grand_total');

$weeklyDiscounts = Order::where('created_at', '>=', $effectiveStart)
    ->whereNotIn('order_status', ['Pending', 'Cancelled'])
    ->sum('coupon');

$weeklyEarnings = round($weeklyEarnings - $weeklyDiscounts);

$monthlyEarnings = Order::where('created_at', '>=', $monthStart)
    ->whereNotIn('order_status', ['Pending', 'Cancelled'])
    ->sum('grand_total');

$monthlyDiscounts = Order::where('created_at', '>=', $monthStart)
    ->whereNotIn('order_status', ['Pending', 'Cancelled'])
    ->sum('coupon');

$monthlyEarnings = round($monthlyEarnings - $monthlyDiscounts);




        $totalEarningsDiscounts = Order::where('order_status', '!=', 'Cancelled')
            ->where('order_status', '!=', 'Pending')
            ->sum('coupon');

        $totalEarnings = $totalEarnings - $totalEarningsDiscounts;
        $totalEarnings = round($totalEarnings);

        $totalPayment = Order::where('order_status', '!=', 'Cancelled')->where('partial_amount', '=', 0)->sum('grand_total');
        $totalPayment += Order::where('order_status', '!=', 'Cancelled')->where('partial_amount', '!=', 0)->sum('partial_amount');
        $totalPaymentPending = Order::where('order_status', '!=', 'Cancelled')->where('partial_amount', '!=', 0)->sum('need_to_pay');
        //dd($totalEarnings);
        return view('admin.dashboard.index', compact(
            'categories',
            'scategories',
            'brands',
            'products',
            'recentOrders',
            'productreviews',
            'contacts',
            'balance',
            'todayOrders',
            'totalOrders',
            'todayEarnings',
            'totalEarnings',
            'totalPayment',
            'totalPaymentPending',
            'totalPlacedOrders',
            'weeklyEarnings',
            'monthlyEarnings',
        ));
    }



    public function contactrequest()
    {
        // dd('contact request');
        $contacts = Contact::orderBy('id', 'desc')->get();
        // dd($contacts);
        return view('admin.contact.index', compact('contacts'));
    }

    public function contactdelete(Request $request, $id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return redirect()->back()->with('danger', 'Contact deleted successfully');
    }

    public function profile()
    {
        return view('admin.admin_profile');
    }

    public function updateAdminProfile(Request $request)
    {
        $user = Auth::user();
        $requestData = $request->except(['_token', '_method', 'cpassword']);


        if (!empty($requestData['password'])) {
            if (Hash::check($request->old_password, auth()->user()->password)) {
                $requestData['password'] = Hash::make($request->password);
                User::find($user->id)->update($requestData);
                Auth::logout();
                return redirect()->route('login');
            } else {
                $requestData['password'] = $user->password;
                return redirect()->route('admin_profile')->with('danger', 'Profile Password Not Match');
            }
        } else {
            $requestData['password'] = $user->password;
        }

        $update = User::find($user->id);

        if (!empty($update)) {
            $update->update($requestData);

            return redirect()->route('admin_profile')->with('success', 'Profile Updated Successfully :)');
        } else {
            return redirect()->route('admin_profile')->with('danger', 'Profile Not Updated :(');
        }
    }

    public function exportDatabase()
    {
        $filePath = storage_path('app/export.sql');

        // Command to dump the database
        $command = sprintf(
            'mysqldump --user=%s --password=%s --host=%s %s > %s',
            env('DB_USERNAME'),
            env('DB_PASSWORD'),
            env('DB_HOST'),
            env('DB_DATABASE'),
            $filePath
        );

        system($command);

        // Check if the file exists and then allow for download
        if (file_exists($filePath)) {
            return Response::download($filePath, 'export.sql');
        } else {
            return response()->json(['error' => 'File not found.'], 404);
        }
    }



    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
