<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NewsLetterExport;
class NewsletterController extends Controller
{
  public function index()
  {
    $newsletter = Newsletter::orderBy('created_at', 'desc')->get();
    return view('admin.newsletter.index', compact('newsletter'));
  }

  public function newsletter_export(Request $request)
  {
    return Excel::download(new NewsLetterExport, 'newsletter_emails.xlsx');
  }

}
