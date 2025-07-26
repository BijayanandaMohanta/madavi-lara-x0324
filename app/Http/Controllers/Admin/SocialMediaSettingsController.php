<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialMediaSettingsController extends Controller
{
    public function edit($id)
    {
        $data = Setting::find($id);

        return view('admin.settings.sm_settings.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $requestData = $this->validate($request, [
            'facebook' => 'required',
            'instagram' => 'required',
            'linkedin' => 'required',
            'twitter' => 'required',
            'youtube' => 'required',
        ]);

        Setting::find($id)->update($requestData);

        return redirect()->back()->with('success', 'Social Media Settings Updated Successfully');
    }
}
