<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;
use Auth;

class SettingController extends Controller
{
    public function __construct() {
        $this->middleware('auth.admin:admin');
    }

    public function edit()
    {
        $setting = GeneralSetting::where('id',1)->first();
        return view('admin.setting_general', compact('setting'));
    }

    public function update(Request $request)
    {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        if($request->hasFile('logo')){

            $request->validate([
                'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ],[
                'logo.image' => ERR_PHOTO_IMAGE,
                'logo.mimes' => ERR_PHOTO_JPG_PNG_GIF,
                'logo.max' => ERR_PHOTO_MAX
            ]);

            @unlink(public_path('uploads/site_photos/'.$request->logo));

            $ext = $request->file('logo')->extension();
            $rand_value = md5(mt_rand(11111111,99999999));
            $final_name = $rand_value.'.'.$ext;
            $request->file('logo')->move(public_path('uploads/site_photos/'), $final_name);

            $data['logo'] = $final_name;
        }

        if($request->hasFile('favicon')){

            $request->validate([
                'favicon' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ],[
                'favicon.image' => ERR_PHOTO_IMAGE,
                'favicon.mimes' => ERR_PHOTO_JPG_PNG_GIF,
                'favicon.max' => ERR_PHOTO_MAX
            ]);

            @unlink(public_path('uploads/site_photos/'.$request->favicon));

            $ext = $request->file('favicon')->extension();
            $rand_value = md5(mt_rand(11111111,99999999));
            $final_name1 = $rand_value.'.'.$ext;
            $request->file('favicon')->move(public_path('uploads/site_photos/'), $final_name1);

            $data['favicon'] = $final_name1;
        }
        $socialData = [];
        foreach ($request->social_icon as $index => $icon) {
            $socialData[$icon] = $request->social_url[$index] ?? null; // Use null if the URL is not set
        }
        // Convert the associative array to JSON
        $socialDataJson = json_encode($socialData);


        // // Convert the associative array to JSON
        // $socialDataJson = json_encode($socialData);

        $data['top_phone'] = $request->input('top_phone');
        $data['top_email'] = $request->input('top_email');


        $data['footer_address_1_heading'] = $request->input('footer_address_1_heading');
        $data['footer_address'] = $request->input('footer_address');
        $data['footer_address_2_heading'] = $request->input('footer_address_2_heading');
        $data['footer_another_address'] = $request->input('footer_another_address');
        $data['footer_email'] = $request->input('footer_email');
        $data['footer_phone'] = $request->input('footer_phone');
        $data['footer_other_phone'] = $request->input('footer_other_phone');
        $data['footer_copyright'] = $request->input('footer_copyright');

        $data['app_name'] = $request->input('app_name');
        $data['short_description'] = $request->input('short_description');
        $data['long_description'] = $request->input('long_description');
        $data['about_us'] = $request->input('about_us');

        $data['sms_api_key'] = $request->get('sms_api_key');
        $data['sms_api_secret'] = $request->get('sms_api_secret');
        $data['sms_sender_id'] = $request->get('sms_sender_id');
        $data['sms_api_url'] = $request->get('sms_api_url');
        $data['sms_gateway_username'] = $request->get('sms_gateway_username');
        $data['sms_gateway_password'] = $request->get('sms_gateway_password');
        $data['sms_status'] = $request->get('sms_status');

        $data['paypal_environment'] = $request->get('paypal_environment');
        $data['paypal_client_id'] = $request->get('paypal_client_id');
        $data['paypal_secret_key'] = $request->get('paypal_secret_key');
        $data['paypal_status'] = $request->get('paypal_status');

        $data['stripe_public_key'] = $request->get('stripe_public_key');
        $data['stripe_secret_key'] = $request->get('stripe_secret_key');
        $data['stripe_status'] = $request->get('stripe_status');

        $data['razorpay_key_id'] = $request->get('razorpay_key_id');
        $data['razorpay_key_secret'] = $request->get('razorpay_key_secret');
        $data['razorpay_status'] = $request->get('razorpay_status');

        $data['flutterwave_country'] = $request->get('flutterwave_country');
        $data['flutterwave_public_key'] = $request->get('flutterwave_public_key');
        $data['flutterwave_secret_key'] = $request->get('flutterwave_secret_key');
        $data['flutterwave_status'] = $request->get('flutterwave_status');

        $data['aws_key_id'] = $request->get('aws_key_id');
        $data['aws_secret_key'] = $request->get('aws_secret_key');
        $data['aws_default_region'] = $request->get('aws_default_region');
        $data['aws_bucket'] = $request->get('aws_bucket');
        $data['aws_use_path_style_endpint'] = $request->get('aws_use_path_style_endpint');
        $data['aws_status'] = $request->get('aws_status');

        $data['mollie_api_key'] = $request->get('mollie_api_key');
        $data['mollie_status'] = $request->get('mollie_status');

        $data['social_details'] = $socialDataJson;
        // dd($data);
        GeneralSetting::where('id',1)->update($data);
        return redirect()->back()->with('success', SUCCESS_ACTION);
    }


    public function payment_edit()
    {
        $g_setting = GeneralSetting::where('id',1)->first();
        return view('admin.setting_payment', compact('g_setting'));
    }

    public function payment_update(Request $request)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $data['paypal_environment'] = $request->get('paypal_environment');
        $data['paypal_client_id'] = $request->get('paypal_client_id');
        $data['paypal_secret_key'] = $request->get('paypal_secret_key');
        $data['paypal_status'] = $request->get('paypal_status');

        $data['stripe_public_key'] = $request->get('stripe_public_key');
        $data['stripe_secret_key'] = $request->get('stripe_secret_key');
        $data['stripe_status'] = $request->get('stripe_status');

        $data['razorpay_key_id'] = $request->get('razorpay_key_id');
        $data['razorpay_key_secret'] = $request->get('razorpay_key_secret');
        $data['razorpay_status'] = $request->get('razorpay_status');

        $data['flutterwave_country'] = $request->get('flutterwave_country');
        $data['flutterwave_public_key'] = $request->get('flutterwave_public_key');
        $data['flutterwave_secret_key'] = $request->get('flutterwave_secret_key');
        $data['flutterwave_status'] = $request->get('flutterwave_status');

        $data['mollie_api_key'] = $request->get('mollie_api_key');
        $data['mollie_status'] = $request->get('mollie_status');

        GeneralSetting::where('id',1)->update($data);

        return redirect()->back()->with('success', SUCCESS_ACTION);
    }


}
