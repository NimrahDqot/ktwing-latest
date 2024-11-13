<?php
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use App\Models\Banner;
use App\Models\Enquiry;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Village;
use App\Models\Volunteer;
use App\Models\Attendees;
use Illuminate\Support\Str;

use App\Models\Module;

use Illuminate\Http\Request;
use Auth;

class WebController extends Controller
{




    public function enquiry_form(Request $request){

        $request->validate([
            'email'=> 'required|email|max:30',
            'phone'=> 'required|digits:10|min:10|max:10',
            'image' => 'nullable',
        ]);
        $enquiry = new Enquiry();

        $data = $request->only($enquiry->getFillable());
        $data['name'] = $request->firstName .' '. $request->firstName;
        if($request->hasFile('image')){

            $rand_value = md5(mt_rand(11111111,99999999));
            $ext = $request->file('image')->extension();
            $final_name = $rand_value.'.'.$ext;
            $request->file('image')->move(public_path('uploads/enquiry/'), $final_name);
            unset($data['image']);
            $data['image'] = $final_name;
        }
        $enquiry->fill($data)->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Your Enquiry submitted successfully!',
        ]);

    }

    public function maha_kumbh_create(Request $request){
        return view('front.web.maha_kumbh_create');
    }

    public function maha_kumbh_store(Request $request){

        $request->validate([
            'firstName'=> 'required|string|min:3|max:50',
            'lastName'=> 'required|string|min:3|max:50',
            'email'=> 'required|email|max:30',
            'phone'=> 'required|digits:10|min:10|max:10',
            'image' => 'nullable',
        ]);
        $user = new User();

        $data = $request->only($user->getFillable());
        $data['referal_code'] = 'KTW'.strtoupper(Str::random(5));
        $data['refer_id'] = 0;
        $data['ip_address'] = $request->ip();
        $data['name'] = $request->firstName .' '. $request->firstName;
        $data['father_name'] = $request->father_name;
        $data['address'] = $request->address;
        $data['adhar_no'] = $request->adhar_no;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;

        if($request->hasFile('image')){

            $rand_value = md5(mt_rand(11111111,99999999));
            $ext = $request->file('image')->extension();
            $final_name = $rand_value.'.'.$ext;
            $request->file('image')->move(public_path('uploads/user/'), $final_name);
            unset($data['image']);
            $data['image'] = $final_name;
        }


        $user->fill($data)->save();
        if($user){

            // Generate the referral code after saving the user
            $email = isset($request->email) ? strtoupper(substr($request->email, 0, 4)) : 'KTUSER';
            $timestamp = now()->format('Hi') . now()->format('s'); // Get the last 4 digits (HHMM + SS)
            $timestamp = substr($timestamp, -4); // Ensure you have only the last 4 digits
            // Combine to form the referral code
            $data['referal_code'] = $email . $user->id . $timestamp;
            // Update the user with the referral code
            $user->referal_code = $data['referal_code'];
            $six_digit_id = str_pad($user->id, 6, '0', STR_PAD_LEFT); // This ensures the ID is 6 digits

            // Get the current date in yymmdd format (6 digits)
            $today = now()->format('ymd');

            // Concatenate the date and the 6-digit user ID to form a 12-digit member_id
            $memberId = $today . $six_digit_id;

            // Save the member_id to the user record
            $user->member_id = $memberId;
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Form submitted successfully!',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong!',
            ], 500);
        }
    }

}
