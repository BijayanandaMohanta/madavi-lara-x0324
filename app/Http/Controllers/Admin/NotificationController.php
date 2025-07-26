<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notification;
use App\Models\Patient;
use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\HelperController;
use DB;

class NotificationController extends Controller
{
    public function index()
    {
        $apps = DB::connection('read')->table('notifications')->orderBy('id', 'desc')->get();

        return view('admin.notification.index', compact('apps'));
    }

    public function create()
    {
        
        return view('admin.notification.create');
    }

    public function store(Request $request)
    {
        $validatedata = $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            
            'image' => 'required|mimes:jpg,jpeg,png,webp'
        ]);
        if ($request->hasFile('image')) {
            $image = 'apps_' . rand() . '.' . $request->image->extension();
            $validatedata['image'] = $image;
            //dd($data['image']);
            $request->image->move(public_path('uploads/notification/'), $image);
        }

        Notification::create($validatedata);
        $settings = Setting::where('id', 1)->first();
        $user_data = Patient::where('otp_status', 'Verified')->get();

foreach($user_data as $value){
    
            $tokens = $value->android_device_id;
            $title = $validatedata['title'];
            $description = $validatedata['description'];
            
            $image = url('/') . '/public/uploads/notification/' . $image;

            $data = array(
            "title" => $title,
            "body" => $description,
            "image" => $image,
            'sound' => 'notification_tone',
            'url' => 'http://google.com',
            'video_url' => 'http://google.com',
            'photo_url' => 'http://google.com',
            'style' => 'picture',
            'android_channel_id' => 'warnings'
        );

        $serviceAccountFilePath = url('/') . '/public/uploads/firebase.json';
    
             $jwt = (new HelperController)->generateJWT($serviceAccountFilePath);

    // Get access token
            $accessToken = (new HelperController)->getAccessToken($jwt);
         
            
            (new HelperController)->sendUserFCMNotification($accessToken,$data, $tokens, $settings->firebase_key);
            //send_push_notification($data, $tokens, $settings->firebase_key);

}

        return redirect()->route('notification.index')->with('success', 'Notification Sent');

    }

    public function edit($id)
    {
        
       
        $data = AmazingApp::where('id', $id)->first();
        return view('admin.notification.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
           
            'image' => 'mimes:jpg,jpeg,png,webp'
        ]);
        if ($request->hasFile('image')) {
            $image = 'apps_' . rand() . '.' . $request->image->extension();
            $data['image'] = $image;
            $request->image->move(public_path('uploads/notification/'), $image);
        }

        Notification::find($id)->update($data);

        return redirect()->route('notification.index')->with('success', 'App Data Updated');

    }
    public function destroy($id) {

        $data = DB::connection('read')->table('notifications')->where('id', $id)->first();
       
       $image_path = public_path("/uploads/notification/$data->image");
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
       //dd($image_path);
        (new Notification)->deleteData($id);
        return redirect()->route('notification.index')->with('message', 'Notification Deleted');
    }
}
