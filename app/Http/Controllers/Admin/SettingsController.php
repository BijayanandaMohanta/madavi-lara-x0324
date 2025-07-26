<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit($id)
    {
        $data = Setting::find($id);

        return view('admin.settings.general_settings.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $requestData = $this->validate($request, [
            'welcome_message' => 'required',
            'aware_message' => 'required',
            'offer_message' => 'required|max:255',
            'offer_link' => 'required|max:255',
            'site_name' => 'required',
            'address' => 'required',
            'store_address' => 'required',
            'email' => 'required|email',
            'mobile_number' => 'nullable',
            'retail_number' => 'required',
            'wholesale_number' => 'required',
            'toll_free_number' => 'required',
            'map_iframe' => 'required',
            'google_map_link' => 'required',
        ]);

        if ($request->logo) {
            $logo = 'logo' . rand() . '.' . $request->logo->extension();
            $requestData['logo'] = $logo;
            $request->logo->move(public_path('site_settings'), $logo);
        }
        if ($request->favicon) {
            $favicon = 'favicon' . rand() . '.' . $request->favicon->extension();
            $requestData['favicon'] = $favicon;
            $request->favicon->move(public_path('site_settings'), $favicon);
        }
        if ($request->footer_logo) {
            $footer_logo = 'footer_logo' . rand() . '.' . $request->footer_logo->extension();
            $requestData['footer_logo'] = $footer_logo;
            $request->footer_logo->move(public_path('site_settings'), $footer_logo);
        }
        if ($request->login_image) {
            $login_image = 'login_image' . rand() . '.' . $request->login_image->extension();
            $requestData['login_image'] = $login_image;
            $request->login_image->move(public_path('site_settings'), $login_image);
        }
// dd($requestData);
        Setting::find($id)->update($requestData);
        return redirect()->back()->with('success', 'Site Settings Updated Successfully');
    }
}
