<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use Illuminate\Http\Request;

class SeoSettingsController extends Controller
{
    public function index()
    {
        $seo_data = SeoSetting::get();
        return view('admin.settings.seo_settings.index', compact('seo_data'));
    }

    public function create()
    {
        return view('admin.settings.seo_settings.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'page_name' => 'required',
            'title' => 'required',
            'keywords' => 'required',
            'description' => 'required',
        ]);

        SeoSetting::create($data);

        return redirect()->route('seo-settings.index')->with('success', 'New Page SEO Settings Added');
    }

    public function edit($id)
    {
        $data = SeoSetting::find($id)->first();
        return view('admin.settings.seo_settings.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'page_name' => 'required',
            'title' => 'required',
            'keywords' => 'required',
            'description' => 'required',
        ]);

        SeoSetting::find($id)->update($data);

        return redirect()->route('seo-settings.index')->with('success', 'SEO Settings Updated');

    }

    public function destroy($id)
    {
        $result = SeoSetting::find($id)->delete();

        if ($result) {
            return redirect()->route('seo-settings.index')->with('success', 'SEO Setting Deleted Successfully');
        } else {
            return redirect()->route('seo-settings.index')->with('danger', 'No SEO Setting Deleted');
        }
    }
}
