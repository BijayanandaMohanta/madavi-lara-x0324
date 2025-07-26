<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
  public function index()
  {
    $faqs = Faq::orderBy('id', 'desc')->get();
    return view('admin.faqs.index', compact('faqs')); // Pass the search query to the view
  }


  public function create()
  {
    return view('admin.faqs.create');
  }

  public function store(Request $request)
  {

    $data = $this->validate($request, [
      'question' => 'required',
      'answer' => 'required'
    ]);
    Faq::create($data);

    return redirect()->route('faq.index')->with('success', 'Faq created successfully.');
  }


  public function edit($id)
  {
    $data = Faq::find($id);
    return view('admin.faqs.edit', compact('data'));
  }

  public function update(Request $request, $id)
  {
    $data = $this->validate($request, [
      'question' => 'required',
      'answer' => 'required'
    ]);

    // Get the existing product
    $faq = Faq::find($id);
    $faq->update($data);

    return redirect()->route('faq.index')->with('success', 'Faq Added successfully.');
  }

  public function destroy($id)
  {
    $faq = Faq::find($id);
    $faq->delete();

    return redirect()->route('faq.index')->with('success', 'Faq deleted successfully.');
  }
}
