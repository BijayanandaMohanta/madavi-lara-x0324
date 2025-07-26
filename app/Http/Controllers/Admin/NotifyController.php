<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notify;
use Illuminate\Http\Request;
use Carbon\Carbon;
class NotifyController extends Controller
{
  public function index(Request $request)
{
    // Initialize the query
    $notifyQuery = Notify::orderBy('created_at', 'desc');

    // Validate date inputs
    if ($request->from_date != '' && $request->to_date == '') {
        return redirect()->back()->with('message', 'To date is required');
    }
    if ($request->from_date == '' && $request->to_date != '') {
        return redirect()->back()->with('message', 'From date is required');
    }

    // Apply date filter if both from_date and to_date are provided
    if ($request->from_date != '' && $request->to_date != '') {
        $notifyQuery->whereBetween('created_at', [
            Carbon::parse($request->from_date)->startOfDay(), // Start of the from_date
            Carbon::parse($request->to_date)->endOfDay()      // End of the to_date
        ]);
    }

    // Fetch the results
    $notify = $notifyQuery->get();

    // Pass the results to the view
    return view('admin.notify.index', compact('notify'));
}
}
