<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Volunteer;
use App\Models\AppLanguage;
use App\Models\Notification;
use App\Models\Visitor;
use App\Models\EventPhotoRequest;
use App\Models\EventVideoRequest;
use App\Models\EventAudioRequest;
use App\Models\LevelReward;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Attendees;
use App\Models\Banner;
use App\Models\Event;
use App\Models\EventCompleteRequest;
use Validator;
use Hash;
use Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\RateLimiter;
use Helper;
class VolunteerController extends BaseController
{


    public function login(Request $request) {
        // Validation logic
        $validator = Validator::make($request->only(['email', 'password']), [
            'email' => 'required|string|max:25',
            'password' => 'required|string',
        ], [
            'password.required' => ERR_PASSWORD_REQUIRED
        ]);

        // Return validation errors if validation fails
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        // Define the rate limit key, based on the IP address
        $rateLimitKey = 'login_attempt:' . $request->ip();
        // Check if the user has exceeded the login attempt limit (3 attempts in 1 minute)
        if (RateLimiter::tooManyAttempts($rateLimitKey, 3)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);
            return $this->sendError('Too many login attempts. Please try again in ' . ceil($seconds / 60) . ' minutes.');
        }

        // Get credentials
        $credentials = $request->only('email', 'password');

        // Find the volunteer by email
        $volunteer = Volunteer::where('email', $credentials['email'])->first();

        // Check if the volunteer exists and if the password is correct
        if ($volunteer && Hash::check($credentials['password'], $volunteer->password)) {
            // Clear the rate limit on successful login
            RateLimiter::clear($rateLimitKey);

            // Check if the volunteer account is active
            if ($volunteer->status !== '1') {
                return $this->sendError('Volunteer account is inactive.');
            }
            // Update FCM token and device ID
            $volunteer->update([
                'fcm_token' => $request->fcm_token,
                'device_id' => $request->device_id,
            ]);
            // Generate an access token
            $success = [
                'token' => $volunteer->createToken('MyApp')->plainTextToken,
                'id' => $volunteer->id,
                'name' => $volunteer->name, // or any other field you'd like to return
            ];

            return $this->sendResponse($success, 'Volunteer logged in successfully.');
        } else {
            // Increment rate limit attempt count on failed login
            RateLimiter::hit($rateLimitKey, 60); // 60 seconds lockout for each failed attempt

            return $this->sendError('Email and Password mismatch please try again..!');
        }
    }

    public function app_string() {
        try {
            // Fetch language data
            // $language_data = AppLanguage::select('lang_key','lang_value')->orderBy('id', 'asc')->get();
            $language_data = AppLanguage::pluck('lang_value', 'lang_key')->toArray();
            // Return success response
            // $language_data['audio_min_time']=1;
            // $language_data['audio_max_time']=2;
            // $language_data['video_min_time']=1;
            // $language_data['video_max_time']=2;
            return $this->sendResponse($language_data, 'App string retrieved successfully.');
        } catch (\Exception $e) {
            // Handle exceptions and return error response
            return $this->sendError('An error occurred while retrieving app strings.', $e->getMessage());
        }
    }

    public function banner() {
        try {
            // Fetch language data
            $language_data = Banner::select('title','image','type')->orderBy('sort_by', 'asc')->get();
            // Return success response
            return $this->sendResponse($language_data, 'App string retrieved successfully.');
        } catch (\Exception $e) {
            // Handle exceptions and return error response
            return $this->sendError('An error occurred while retrieving app strings.', $e->getMessage());
        }
    }

    public function notification(Request $request) {

        $user_id = $request->user_id;
        $type = (!empty($request->user_type) && $request->user_type==1) ? 1: 0;
        $loginResponse = $this->validateLogin($user_id, $type);
        if ($loginResponse->getStatusCode() !== 200) {
            return $this->sendUnauthorize('Unauthorized', 202);
        }
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|max:25',

        ]);

        // Return validation errors if validation fails
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        try {
            $type = (string)(!empty($request->type) && $request->type==1) ? 1: 0;
            $per_page = isset($request->per_page) ? (int)$request->per_page : 50;
            $user_id = $request->user_id;

            // Fetch language data

            $language_data = Notification::where('user_id',$user_id)->where('type',(int)$type)->select('id','user_id','title','description','created_at','type')->orderBy('created_at', 'asc')->paginate($per_page);
            $language_data->map(function($data){
                $data->type = (string)$data->type;
            });

          $response = [
                'current_page' => $language_data->currentPage(),
                'next_page' => $language_data->hasMorePages() ? $language_data->currentPage() + 1 : null,
                'total_pages' => $language_data->lastPage(),
                'data' => $language_data->items(),
            ];  // Return success response
            return $this->sendResponse($response, 'Notification list retrieved successfully.');
        } catch (\Exception $e) {
            // Handle exceptions and return error response
            return $this->sendError('An error occurred while retrieving app strings.', $e->getMessage());
        }
    }

    public function profile(Request $request){
        $user_id = $request->user_id;
        $type = 0;
        $loginResponse = $this->validateLogin($user_id, $type);
        if ($loginResponse->getStatusCode() !== 200) {
            return $this->sendUnauthorize('Unauthorized', 202);
        }
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|max:25',
        ]);

        // Return validation errors if validation fails
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        try {
            $user_id = $request->user_id;

            // $profile_detail = Volunteer::where('id', $user_id)->where('status', "1")->select('id','name','email','role_id','image','phone','experience')->first();
            $profile_detail = Volunteer::where('id', $user_id)->select('id','village_id','current_level','password','name','email','role_id','image','phone','experience','referal_code','created_at')->first();
            $profile_detail->usertype ="Team";

            $profile_detail->current_level = ($profile_detail->current_level==0) ? 1 : $profile_detail->current_level;


            $level_name = DB ::table('level_rewards')->where('id',$profile_detail->current_level)->first()->level_name;

            $profile_detail['role_name'] = isset($profile_detail->Role->name) ? $profile_detail->Role->name : 'Team';
            $profile_detail['village_count'] = $profile_detail['village_count'];

            $app_refer_url = !empty($profile_detail->referal_code) ? env('APP_URL').'download/'.$profile_detail->referal_code : env('APP_URL').'/get-apk/KTW'.rand(0,10000);
            $events = $this->getEventsByUserId($user_id);
            $total_events = $this->getTotalEventsByUserId($user_id);
            $profile_detail['event_count'] = $total_events;
            $profile_detail['level_name'] =  $level_name;
            $profile_detail['events'] = $events;
            $rank = DB ::table('level_rewards')->where('id',$profile_detail->current_level)->first()->rank;
            $profile_detail->current_level = $rank;
            $profile_detail['refercode_share'] = 'Welcome to KT Wing , Please download and installed App using following url :'.$app_refer_url.' for join with us';
            $profile_detail['referal_download_url'] =  $app_refer_url;

        //         $type = 'team';
        //         $data = Volunteer::find($user_id);
        //         $volunteer = $data;
        //         // Construct the image URL manually
        //         $imagePath = $volunteer->image;

        //     // Extract only the image name (e.g., '35ce80e0112560d7575c66d0af7407a9.jpg')
        //     $imageUrl = basename($imagePath); // This will give you just the file name
        //     $imageType = pathinfo($imageUrl, PATHINFO_EXTENSION) === 'jpg' ? 'jpeg' : 'png'; // Determine the image type
        //     $options = new Options();
        //     $options->set('defaultFont', 'Courier'); // Set default font
        //     $options->set('isHtml5ParserEnabled', true); // Enable HTML5 support
        //     $dompdf = new Dompdf($options);

        //     $html = view('admin.id_card.id_card', compact('volunteer', 'imageUrl', 'imageType', 'type'))->render(); // Your Blade view
        //     $dompdf->loadHtml($html);
        //     $dompdf->setPaper('A4', 'portrait');
        //     $dompdf->render();
        //    // Define the temporary storage path for the PDF
        //     $pdfName = 'id_card_' . $user_id . '.pdf';
        //     $tempPath = public_path('temp/' . $pdfName); // Store the PDF in the 'temp' folder

        //     // Ensure the 'temp' directory exists
        //     if (!file_exists(public_path('temp'))) {
        //         mkdir(public_path('temp'), 0777, true);  // Create the directory if it doesn't exist
        //     }

        //     // Save the generated PDF to the temporary location
        //     file_put_contents($tempPath, $dompdf->output());

        //     // Generate the URL for downloading the PDF (using asset() to create a public URL)
        //     $pdfUrl = asset('temp/' . $pdfName);

        //     // Return the URL in the response
        //     $profile_detail['pdf_url'] = $pdfUrl;

            $profile_detail['pdf_url'] = $this->generatePdfUrl($user_id);


            return $this->sendResponse($profile_detail, 'Profile detail retrieved successfully.');

        } catch (\Exception $e) {

            return $this->sendError('An error occurred while retrieving app strings.', $e->getMessage());
        }
    }

    public function generatePdfUrl($user_id)
    {
        try {
            $volunteer = Volunteer::find($user_id);

            // Check if volunteer exists
            if (!$volunteer) {
                throw new \Exception('Volunteer not found.');
            }

            // Construct the image URL manually
            $imagePath = $volunteer->image;
            $imageUrl = basename($imagePath); // Extract the image name
            $imageType = pathinfo($imageUrl, PATHINFO_EXTENSION) === 'jpg' ? 'jpeg' : 'png'; // Determine the image type
                $type = 'team';

            $options = new Options();
            $options->set('defaultFont', 'Courier'); // Set default font
            $options->set('isHtml5ParserEnabled', true); // Enable HTML5 support
            $dompdf = new Dompdf($options);
            $html =  view('admin.id_card.id_card', compact('volunteer', 'imageUrl', 'imageType', 'type'))->render(); // Your Blade view

            // Render the HTML view for the PDF
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            // Define the temporary storage path for the PDF
            $pdfName = 'id_card_' . $user_id . '.pdf';
            $tempPath = public_path('temp/' . $pdfName); // Store the PDF in the 'temp' folder

            // Ensure the 'temp' directory exists
            if (!file_exists(public_path('temp'))) {
                mkdir(public_path('temp'), 0777, true);  // Create the directory if it doesn't exist
            }

            // Save the generated PDF to the temporary location
            file_put_contents($tempPath, $dompdf->output());

            // Generate the URL for downloading the PDF (using asset() to create a public URL)
            return asset('temp/' . $pdfName); // Return the URL of the generated PDF

        } catch (\Exception $e) {
            $pdfName = '';
            return $pdfName; // Return the URL of the generated PDF
            // throw new \Exception('An error occurred while generating the PDF: ' . $e->getMessage());
        }
    }

    public function update_profile_image(Request $request){
                $user_id = $request->user_id;
                $type = 0;

                $loginResponse = $this->validateLogin($user_id, $type);
                if ($loginResponse->getStatusCode() !== 200) {
                    return $this->sendUnauthorize('Unauthorized', 202);
                }
                $validator = Validator::make($request->all(), [
                    'user_id' => 'required|max:25',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image validation
                ]);

                // Return validation errors if validation fails
                if ($validator->fails()) {
                    return $this->sendError($validator->errors()->first());
                }

                try {
                    $user_id = $request->user_id;

                    // $profile_detail = Volunteer::where('id', $user_id)->where('status', "1")->select('id','name','email','role_id','image','phone','experience')->first();
                    $volunteer = Volunteer::where('id', $user_id)->select('id','image','updated_at')->first();

                    // Check if a profile was found
                    if (!$volunteer) {
                        return $this->sendError('No active profile found for this user.');
                    }
                    if($request->hasFile('image')){
                        @unlink(public_path('uploads/volunteer/'.$volunteer->image)); // Unlink old image
                        $ext = $request->file('image')->extension();
                        $rand_value = md5(mt_rand(11111111,99999999));
                        $final_name = $rand_value.'.'.$ext;
                        $request->file('image')->move(public_path('uploads/volunteer/'), $final_name);

                        $data['image'] = $final_name; // Update with new image name
                    }
                    $volunteer->fill($data)->save();
                    return $this->sendResponse($volunteer, 'Profile image updated successfully.');

                } catch (\Exception $e) {
                    return $this->sendError('An error occurred while retrieving app strings.', $e->getMessage());
                }
        }


    public function getEventsByUserId($user_id)
    {
        // Fetch events that match the user_id
        $events = Event::whereRaw("FIND_IN_SET(?, volunteer_id)", [$user_id])
            ->select('event_status', 'image','name','village_id') // Select the required fields
            ->get();

        // Group by event status and count
        $eventsCount = $events->groupBy('event_status')->map(function ($group) {
            return [
                // Using ternary operator to handle potential null values
                'event_status' => $group->first()->event_status ?: 'Unknown Status', // Default value if event_status is null or empty
                'count' => $group->count() > 0 ? $group->count() : 0, // Ensure count is a valid number
                'image' => !empty($group->first()->image) ? $group->first()->image : 'default-image.jpg', // Default image if none exists
                'name' => !empty($group->first()->name) ? $group->first()->name : 'Unnamed Event', // Default name if none exists
                'village' => ($group->first()->village_name_info && !empty($group->first()->village_name_info->name))
                    ? $group->first()->village_name_info->name
                    : 'No Village Name', // Handle case when village name is not present
            ];

        })->values();
         // Get the final collection
        return $eventsCount;
    }

    public function getTotalEventsByUserId($user_id)
    {
        // Fetch events that match the user_id
        $eventsCount = Event::whereRaw("FIND_IN_SET(?, volunteer_id)", [$user_id])
            ->count();


        return $eventsCount;
    }

    public function store_visitor(Request $request){
        $user_id = $request->user_id;
        $type = 0;
        $loginResponse = $this->validateLogin($user_id, $type);
        if ($loginResponse->getStatusCode() !== 200) {
            return $this->sendUnauthorize('Unauthorized', 202);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:25',
            'phone' => 'required|min:10|max:10',
            'dob' => 'required|date',
            'role' => 'required|max:255',
            'bio' => 'required|max:255',
            // 'grade' => 'required|numeric|min:0|max:5',
            // 'grade' => 'required|in:A,B,C,D',
            'grade' => 'required',
            'review' => 'required',
            'audio' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image validation
            'user_id' => 'required|max:25',
        ]);
        // Return validation errors if validation fails
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        try{
            $volunteer_id = $request->user_id;
            $visitor = new User();
            $data = $request->only($visitor->getFillable());
            if($request->hasFile('image')){

                $rand_value = md5(mt_rand(11111111,99999999));
                $ext = $request->file('image')->extension();
                $final_name = $rand_value.'.'.$ext;
                $request->file('image')->move(public_path('uploads/users/'), $final_name);
                unset($data['image']);
                $data['image'] = $final_name;
            }

            if ($request->hasFile('audio')) {
                $audio = $request->file('audio');
                $audioName = time() . '.' . $audio->getClientOriginalExtension();
                $audio->move(public_path('uploads/users'), $audioName);
                $data['audio'] = $audioName;
            }
            $data['volunteer_id'] = $volunteer_id;
            $data['user_type'] = 'visitor';
            $visitor->fill($data)->save();
            if($visitor){
                Helper::user_member_id($visitor);
            }
            return $this->sendResponse($visitor, 'Visitor created successfully successfully.');
        }catch (\Exception $e) {
            // Handle exceptions and return error response
            return $this->sendError('An error occurred while retrieving app strings.', $e->getMessage());
        }
    }


    public function all_events_users($request){
        $user_id = $request->user_id;
        $type = 1;
        $loginResponse = $this->validateLogin($user_id, $type);
        if ($loginResponse->getStatusCode() !== 200) {
            return $this->sendUnauthorize('Unauthorized', 202);
        }
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'type' => 'required|in:Completed,Ongoing,Upcoming',
            'user_type'=>'nullable|in:1,0' // 0=>volunteer, 1=>user
        ]);
        // Return validation errors if validation fails
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        try{
            $user_type = $request->user_type;
            $user_id = $request->user_id;
            $type = $request->type;
            $per_page = isset($request->per_page) ? (int)$request->per_page : 10;
            $page_no = isset($request->page_no) ? (int)$request->page_no : 1; // Default to page 1 if not set


            $event_data = Event::where('event_status',$type)
            ->with('village_info:name,id')
            ->select('id','event_status', 'image','name','village_id','event_date','event_time'); // Select the required fields


            if($user_type == 0){

                $eventRequest = Volunteer::find($user_id);

                if (!$eventRequest) {
                    return $this->sendError('Volunteer id not found.');
                }
                $events = $event_data->whereRaw("FIND_IN_SET(?, volunteer_id)", [$user_id])->paginate($per_page,['*'], 'page', $page_no);
            }else{
                $eventRequest = User::find($user_id);

                if (!$eventRequest) {
                    return $this->sendError('User id not found.');
                }
                $events = $event_data->paginate($per_page,['*'], 'page', $page_no);
            }

            $response = [
                'current_page' => $events->currentPage(),
                'next_page' => $events->hasMorePages() ? $events->currentPage() + 1 : $events->lastPage(),
                'total_pages' => $events->lastPage(),
                'data' => $events->map(function ($event) {
                    return [
                        'id' => $event->id,
                        'event_status' => $event->event_status,
                        'image' => $event->image,
                        'name' => $event->name,
                        'village' => ($event->village_name_info->name && !empty($event->village_name_info->name)) ? $event->village_name_info->name : 'No Village Name',
                        'event_date' => $event->event_date,
                        'event_time' => $event->event_time,
                    ];
                })->toArray(),
            ];
            return $this->sendResponse($response, 'Events Retrieve successfully.');
        }catch (\Exception $e) {
            // Handle exceptions and return error response
            return $this->sendError('An error occurred while retrieving app strings.', $e->getMessage());
        }
    }

    public function all_events(Request $request){
        $user_id = $request->user_id;
        $type = (!empty($request->user_type) && $request->user_type==1) ? 1: 0;
        if($type==1){
            return $this->all_events_users($request);
          die;
        }
        $loginResponse = $this->validateLogin($user_id, $type);
        if ($loginResponse->getStatusCode() !== 200) {
            return $this->sendUnauthorize('Unauthorized', 202);
        }
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'type' => 'required|in:Completed,Ongoing,Upcoming',
            'user_type'=>'nullable|in:1,0' // 0=>volunteer, 1=>user
        ]);
        // Return validation errors if validation fails
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        try{
            $user_type = $request->user_type;
            $user_id = $request->user_id;
            $type = $request->type;
            $per_page = isset($request->per_page) ? (int)$request->per_page : 10;
            $page_no = isset($request->page_no) ? (int)$request->page_no : 1; // Default to page 1 if not set


              $event_data = Event::where('event_status',$type)
            ->with('village_name_info:name,id')
            ->select('id','event_status', 'image','name','village_id','event_date','event_time','volunteer_id'); // Select the required fields

            if($user_type == 0){
                $eventRequest = Volunteer::find($user_id);
                if (!$eventRequest) {
                return $this->sendError('Volunteer id not found.');
                }
                $events = $event_data->whereRaw("FIND_IN_SET(?, volunteer_id)", [$user_id])->paginate($per_page,['*'], 'page', $page_no);

            }else{
                $eventRequest = User::find($user_id);

                if (!$eventRequest) {
                    return $this->sendError('User id not found.');
                }
                $events = $event_data->paginate($per_page,['*'], 'page', $page_no);
            }


            $response = [
                'current_page' => $events->currentPage(),
                'next_page' => $events->hasMorePages() ? $events->currentPage() + 1 : $events->lastPage(),
                'total_pages' => $events->lastPage(),
                'data' => $events->map(function ($event) {
                     return [
                        'id' => $event->id,
                        'event_status' => $event->event_status,
                        'image' => $event->image,
                        'name' => $event->name,
                        'village' => (isset($event->village_name_info->name) && !empty($event->village_name_info->name)) ? $event->village_name_info->name : 'No Village Name',
                        'event_date' => $event->event_date,
                        'event_time' => $event->event_time,
                    ];
                })->toArray(),
            ];
            return $this->sendResponse($response, 'Events Retrieve successfully.');
        }catch (\Exception $e) {
            dd($e);
            // Handle exceptions and return error response
            return $this->sendError('An error occurred while retrieving events.', $e->getMessage());
        }
    }


    /// EVENT DETAIL FOR USER ///
    public function event_detail_users(Request $request){
      $user_id = $request->user_id;
      $event_id = $request->event_id;
      $type = 1;
        $loginResponse = $this->validateLogin($user_id, $type);
        if ($loginResponse->getStatusCode() !== 200) {
            return $this->sendUnauthorize('Unauthorized', 202);
        }
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'event_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        try{


            $event = Event::where('id',$event_id)
            ->with('village_name_info:id,name') // Eager load village name
            ->with('attendee_info:id,name,role,image') // Eager load village name
            ->select('id','event_status', 'image','name','village_id','event_date','event_time','description','event_duration','event_agenda','attendees_id','expected_attendance','volunteer_id','event_status','uploaded_photos','uploaded_videos','uploaded_audios') // Select the required fields
            ->first();
            if (!$event) {
                return $this->sendError('Event not found.');
            }
            $attendeeIds = explode(',', $event->attendees_id);

            $attendees = Attendees::whereIn('id', $attendeeIds)
                ->select('id', 'name', 'role', 'image')
                ->get();
                // Process uploaded photos, videos, and audios


            $response = [
                'id' => $event->id,
                'event_status' => $event->event_status,
                'image' => $event->image,
                'name' => $event->name,
                'expected_attendance' => $event->expected_attendance,
                'village' => (isset($event->village_name_info->name) && !empty($event->village_name_info->name)) ? $event->village_name_info->name : 'No Village Name',
                'event_date' => $event->event_date,
                'event_time' => $event->event_time,
                'description' => $event->description,
                'event_duration' => $event->event_duration,
                'event_agenda' => $event->event_agenda,
                'uploaded_photos' =>$event->uploaded_photos,
                'uploaded_videos' =>$event->uploaded_videos,
                'uploaded_audios' =>$event->uploaded_audios,
                'attendees' => $attendees,
            ];


            return $this->sendResponse($response, 'Events Retrieve successfully.');
        }catch (\Exception $e) {
            // Handle exceptions and return error response
            return $this->sendError('An error occurred while retrieving app strings.', $e->getMessage());
        }
    }
    /// FOR USER ///


    public function event_detail(Request $request){

        $user_id = $request->user_id;
        $type = (!empty($request->user_type) && $request->user_type==1) ? 1: 0;
        if($type==1){
          return $this->event_detail_users($request);
          die;
        }

        $loginResponse = $this->validateLogin($user_id, $type);
        if ($loginResponse->getStatusCode() !== 200) {
            return $this->sendUnauthorize('Unauthorized', 202);
        }
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|max:25',
            'event_id' => 'required|exists:events,id|max:25',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        try{
            $user_id = $request->user_id;
            $event_id = $request->event_id;
            $event = Event::whereRaw("FIND_IN_SET(?, volunteer_id)", [$user_id])
            ->where('id',$event_id)
            ->with('village_name_info:id,name') // Eager load village name
            ->with('attendee_info:id,name,role,image') // Eager load village name
            ->select('id','event_status', 'image','name','village_id','event_date','event_time','description','event_duration','event_agenda','attendees_id','expected_attendance','volunteer_id','event_status','uploaded_photos','uploaded_videos','uploaded_audios') // Select the required fields
            ->first();

            if (!$event) {
                return $this->sendError('Event not found.');
            }
            $attendeeIds = explode(',', $event->attendees_id);

            $attendees = Attendees::whereIn('id', $attendeeIds)
                ->select('id', 'name', 'role', 'image')
                ->get();
                // Process uploaded photos, videos, and audios


            $response = [
                'id' => $event->id,
                'event_status' => $event->event_status,
                'image' => $event->image,
                'name' => $event->name,
                'expected_attendance' => (isset($event->expected_attendance)) ? $event->expected_attendance:  '0',
                'village' =>(isset($event->village_name_info->name) && !empty($event->village_name_info->name)) ? $event->village_name_info->name : 'No Village Name',
                'event_date' => $event->event_date,
                'event_time' => $event->event_time,
                'description' => $event->description,
                'event_duration' => $event->event_duration,
                'event_agenda' => $event->event_agenda,
                'uploaded_photos' =>$event->uploaded_photos,
                'uploaded_videos' =>$event->uploaded_videos,
                'uploaded_audios' =>$event->uploaded_audios,
                'attendees' => $attendees,
            ];


            return $this->sendResponse($response, 'Events Retrieve successfully.');
        }catch (\Exception $e) {
            // Handle exceptions and return error response
            return $this->sendError('An error occurred while retrieving app strings.', $e->getMessage());
        }
    }

    public function create_event_request(Request $request){
        $user_id = $request->user_id;
        $type = 0;

        $loginResponse = $this->validateLogin($user_id, $type);
        if ($loginResponse->getStatusCode() !== 200) {
             Log::error('event in 202 error: ');
                 return $this->sendUnauthorize('Unauthorized', 202);
        }
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|max:25',
            'event_id' => 'required|exists:events,id|max:25',
            'uploaded_photos' => 'required|array',
            // 'uploaded_photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'uploaded_videos' => 'required|array',
            'uploaded_audios' => 'required|array',
        ]);
        // Return validation errors if validation fails
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        try{
            $user_id = $request->user_id;
            $event_id = $request->event_id;

            $eventRequest = Event::find($event_id);

            if (!$eventRequest) {
                return $this->sendError('Event id not found.');
            }
            // Initialize arrays to hold created instances
            $createdPhotos = [];
            $createdVideos = [];
            $createdAudios = [];

            if ($request->hasFile('uploaded_photos')) {
                foreach ($request->file('uploaded_photos') as $uploadedImage) {
                    try {
                        $imageName = $request->user_id . '-' . uniqid() . '.' . $uploadedImage->getClientOriginalExtension();
                        $uploadedImage->move(public_path('uploads/event/photos'), $imageName);

                        // Create a new EventPhotoRequest and collect the instance
                        $createdPhoto = EventPhotoRequest::create([
                            'event_id' => $request->event_id,
                            'volunteer_id' => $request->user_id,
                            'uploaded_photos' => $imageName,
                        ]);

                        // Add the created instance to the array
                        $createdPhotos[] = $createdPhoto;
                    } catch (\Exception $e) {
                        // Handle any exceptions that may occur
                        return $this->sendError('Error uploading photo: ' . $e->getMessage());
                    }
                }
           }
           if ($request->hasFile('uploaded_videos')) {
            foreach ($request->file('uploaded_videos') as $video) {
                try {
                    $videoName = $request->user_id . '-' . uniqid() . '.' . $video->getClientOriginalExtension();
                    $video->move(public_path('uploads/event/videos'), $videoName);

                    // Create a new EventPhotoRequest and collect the instance
                    $createdVideo = EventVideoRequest::create([
                        'event_id' => $event_id,
                        'volunteer_id' => $user_id,
                        'uploaded_videos' => $videoName,
                    ]);

                    // Add the created instance to the array
                    $createdVideos[] = $createdVideo;
                } catch (\Exception $e) {
                    // Handle any exceptions that may occur
                    return $this->sendError('Error uploading photo: ' . $e->getMessage());
                }
            }
           }
            if ($request->hasFile('uploaded_audios')) {
                foreach ($request->file('uploaded_audios') as $audio) {
                try {
                   $audioName = $request->user_id . '-' . uniqid() . '.' . $audio->getClientOriginalExtension();
                   $audio->move(public_path('uploads/event/audios'), $audioName);

                    // Create a new EventPhotoRequest and collect the instance
                    $createdAudio =  EventAudioRequest::create([
                        'event_id' => $event_id,
                        'volunteer_id' => $user_id,
                        'uploaded_audios' => $audioName,
                    ]);

                    // Add the created instance to the array
                    $createdAudios[] = $createdAudio;
                } catch (\Exception $e) {
                       Log::error('Login error: ' . $e->getMessage());  // Handle any exceptions that may occur
                    return $this->sendError('Error uploading photo: ' . $e->getMessage());
                }
                }
            }

        // Update event status to Completed
        $eventRequest->event_status = 'Completed'; // Update the status
        $eventRequest->save(); // Save the event
        $success['createdPhotos'] = $createdPhotos;
        $success['createdVideos'] = $createdVideos;
        $success['createdAudios'] = $createdAudios;
        return $this->sendResponse($success, 'Event request created successfully.');

            }catch (\Exception $e) {
               Log::error('Login error: ' . $e->getMessage());      // Handle exceptions and return error response
                return $this->sendError('An error occurred while retrieving app strings.', $e->getMessage());
            }
    }

    public function create_event_requestn(Request $request){

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|max:25',
            'event_id' => 'required|exists:events,id|max:25',
            'uploaded_photos' => 'required|array',
            // 'uploaded_photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'uploaded_videos' => 'required|array',
            // 'uploaded_audios' => 'required|array',
        ]);
        // Return validation errors if validation fails
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

            $createdPhotos = []; // Initialize an array to hold created photo requests

        if ($request->hasFile('uploaded_photos')) {
            foreach ($request->file('uploaded_photos') as $uploadedImage) {
                try {
                    $imageName = $request->user_id . '-' . uniqid() . '.' . $uploadedImage->getClientOriginalExtension();
                    $uploadedImage->move(public_path('uploads/event/photos'), $imageName);

                    // Create a new EventPhotoRequest and collect the instance
                    $createdPhoto = EventPhotoRequest::create([
                        'event_id' => $request->event_id,
                        'volunteer_id' => $request->user_id,
                        'uploaded_photos' => $imageName,
                    ]);

                    // Add the created instance to the array
                    $createdPhotos[] = $createdPhoto;
                } catch (\Exception $e) {
                    // Handle any exceptions that may occur
                    return $this->sendError('Error uploading photo: ' . $e->getMessage());
                }
            }
            return $this->sendResponse($createdPhotos, 'Event photos uploaded successfully.');
        }
    }

    public function event_medias(Request $request)
    {
        // $user_id = $request->user_id;
        // $type = 0;
        // $loginResponse = $this->validateLogin($user_id, $type);
        // if ($loginResponse->getStatusCode() !== 200) {
        //     return $this->sendUnauthorize('Unauthorized', 202);
        // }
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|max:25',
            'event_id' => 'required|exists:events,id|max:25',
            'type' => 'required|in:Photo,Video,Audio',
        ]);

        // Return validation errors if validation fails
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        try {
            $user_id = $request->user_id;
            $event_id = $request->event_id;
            $type = $request->type;

            $event = Event::find($event_id);


            if (!$event) {
                return $this->sendError('Event id not found.');
            }

            $event = Event::whereRaw("FIND_IN_SET(?, volunteer_id)", [$user_id])
            ->where('id',$event_id)
            ->with('village_name_info:id,name') // Eager load village name
            ->select('id','name','village_id','event_date','expected_attendance','uploaded_photos','uploaded_videos','uploaded_audios','volunteer_id') // Select the required fields
            ->first();
            if(!$event){
                return $this->sendError('Event not found.');

            }
            $response = [
                'id' => $event->id,
                'name' => $event->name,
                'expected_attendance' => $event->expected_attendance,
                'village' => (isset($event->village_name_info->name) && !empty($event->village_name_info->name)) ? $event->village_name_info->name : 'No Village Name',
                'event_date' => $event->event_date,

            ];
            $media = match ($type) {
                'Photo' => [
                    'uploaded_photos' => $event->getUploadedPhotos(), // Calls the accessor
                    'uploaded_videos' => [],
                    'uploaded_audios' => []
                ],
                'Video' => [
                    'uploaded_photos' => [],
                    'uploaded_videos' => $event->getUploadedVidios(), // Calls the accessor
                    'uploaded_audios' => []
                ],
                'Audio' => [
                    'uploaded_photos' => [],
                    'uploaded_videos' => [],
                    'uploaded_audios' => $event->getUploadedAudios() // Calls the accessor
                ],
            };
            return $this->sendResponse(array_merge($response, $media), 'Event Media Retrieved successfully.');
            // return $this->sendResponse($response, 'Event Media Retrieve successfully.');

        } catch (\Exception $e) {
            // Handle exceptions and return error response
            return $this->sendError('An error occurred while creating the event request.', $e->getMessage());
        }
    }

    public function refer_list(Request $request){
        $user_id = $request->user_id;
        $type = 0;
        if($request->user_type ==1){

        return  $this->refer_list_user($request);
        }
        $loginResponse = $this->validateLogin($user_id, $type);
        if ($loginResponse->getStatusCode() !== 200) {
            return $this->sendUnauthorize('Unauthorized', 202);
        }
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|max:25',
        ]);

        // Return validation errors if validation fails
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        try {
            $per_page = isset($request->per_page) ? (int)$request->per_page : 10;
            $user_id = $request->user_id;
            // Fetch language data
            $users = User::where('refer_id',$user_id)->select('id','name','phone','image')->orderBy('created_at', 'desc')->paginate($per_page);
            $response = [
                'data' => $users->items(),
                'current_page' => $users->currentPage(),
                'next_page' => $users->hasMorePages() ? $users->currentPage() + 1 : null,
                'total_pages' => $users->lastPage(),
            ];  // Return success response
            return $this->sendResponse($response, 'Refer User list retrieved successfully.');
        } catch (\Exception $e) {
            // Handle exceptions and return error response
            return $this->sendError('An error occurred while retrieving app strings.', $e->getMessage());
        }
    }
    public function refer_list_user($request){

        $user_id = $request->user_id;
        $type = 1;
        try {
            $per_page = isset($request->per_page) ? (int)$request->per_page : 10;
            $user_id = $request->user_id;
            // Fetch language data

            $users = User::where('users_refer_id',$user_id)->select('id','name','phone','image')->orderBy('created_at', 'desc')->paginate($per_page);

            $response = [
                'data' => $users->items(),
                'current_page' => $users->currentPage(),
                'next_page' => $users->hasMorePages() ? $users->currentPage() + 1 : null,
                'total_pages' => $users->lastPage(),
            ];  // Return success response
            return $this->sendResponse($response, 'Refer User list retrieved successfully.');
        } catch (\Exception $e) {
            // Handle exceptions and return error response
            return $this->sendError('An error occurred while retrieving app strings.', $e->getMessage());
        }
    }

    public function level_reward(Request $request)
    {
        $user_id = $request->user_id;
        $type = 0;
        $loginResponse = $this->validateLogin($user_id, $type);
        if ($loginResponse->getStatusCode() !== 200) {
            return $this->sendUnauthorize('Unauthorized', 202);
        }
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|max:25',
        ]);

        // Return validation errors if validation fails
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        try {
            $user_id = $request->user_id;

            $volunteer = Volunteer::find($user_id);
            if (!$volunteer) {
                return $this->sendError('Volunteer not found.');
            }

            $refer_id_count = User::where('refer_id', $user_id)->count();
            $level_rewards = LevelReward::active()->select('id', 'level_name', 'min_points', 'max_points', 'min_users_for_level');
            $data = $level_rewards->get();

            // Check if the count is less than or equal to min_users_for_level
            $current_level = null;
            foreach ($data as $level_reward) {
                if ($refer_id_count <= $level_reward->min_users_for_level) {
                    $current_level = $level_reward; // Assign the current level based on the condition
                    break; // Exit the loop once the current level is found
                }
            }
            if (!$current_level) {
                return $this->sendError('No appropriate level found for the current user count.');
            }
            $level = $level_rewards->orderBy('id','desc')->get();
            $response = [
                'level' => $level,
                'current_level' => $current_level->level_name,
                'current_users' => $refer_id_count,
                'next_level' => isset($data[$data->search($current_level) + 1]) ? $data[$data->search($current_level) + 1]->level_name : null,
                'user_needed_for_next_level' => isset($data[$data->search($current_level) + 1]) ? $data[$data->search($current_level) + 1]->min_users_for_level : null,
            ];

            // Return success response
            return $this->sendResponse($response, 'Refer User list retrieved successfully.');
        } catch (\Exception $e) {
            // Handle exceptions and return error response
            return $this->sendError('An error occurred while retrieving app strings.', $e->getMessage());
        }
    }



    public function logout(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|max:25',
            'fcm_token' => 'required',
            'device_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        // Find the user based on the given user_id, fcm_token, and device_id
        $user = Volunteer::where([
            ['id', $request->user_id],
            ['fcm_token', $request->fcm_token]

        ])
        //->OrWhere('device_id', $request->device_id)
        ->first();

        // If the user is found, remove fcm_token and device_id, then save
        if ($user) {
            // Set FCM token and device ID to null and save
            if ($user->update(['fcm_token' => null, 'device_id' => null])) {
                return $this->sendResponse('', 'User Logout Successfully');
            }

            return $this->sendError('Logout failed, please try again.');
        }

        // Return error if the user is not found
        return $this->sendError('Invalid user data, please try again.');
    }

    public function validateLogin($user_id, $type){
        // Determine the correct model based on type
        $model = ($type == 0) ? Volunteer::class : User::class;
        $all_header = getallheaders();

        Log::error('FCM data', [
      'headers' => $all_header,
      'model' => $model,
      'user_id' => $user_id,
      'type' => $type,
  ]);
        $FcmToken = $all_header['Fcmtoken'] ?? '';
        // dd( $FcmToken,$model,$user_id);
        // Check if the user exists with the given ID and FCM token
        if ($model::where(['id' => $user_id, 'fcm_token' => $FcmToken])->exists()) {
          Log::error('Login successful', [
          'user_id' => $user_id,
          'type' => $type,
          'fcm_token' => $FcmToken,
      ]);
            return response()->json(['message' => 'Login Successfully'], 200);
        }else{
          Log::error('Unauthorized login attempt', [
         'user_id' => $user_id,
         'type' => $type,
         'fcm_token' => $FcmToken,
     ]);
            return response()->json(['error' => 'Unauthorized.'], 202);
        }
    }


    public function get_volunteer_home_actiity(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        $apiresponse=array();
        $user_id = $request->user_id;
      // ############## PROFILE DATA #################
        $profile_detail = Volunteer::where('id', $user_id)->select('id',   'name', 'phone', 'email',  'image','referal_code','referral_count','current_level', 'status','created_at')->first();
        if(!$profile_detail){
            return $this->sendError('Team id not found.');

        }
        $profile_detail->usertype ="Team";
        $app_refer_url = !empty($profile_detail->referal_code) ? env('APP_URL').'download/'.$profile_detail->referal_code : env('APP_URL').'/get-apk/KTW'.rand(0,10000);

        $profile_detail->current_level = ($profile_detail->current_level==0) ? 1 : $profile_detail->current_level;

        $level_name = DB ::table('level_rewards')->where('id',$profile_detail->current_level)->first()->level_name;
        $rank = DB ::table('level_rewards')->where('id',$profile_detail->current_level)->first()->rank;
        $profile_detail->current_level =  $rank ;
        $profile_detail['user_refer_level']=!empty($level_name) ? $level_name : "No Level";
        $profile_detail['user_refer_share']='Welcome to KT Wing , Please download and installed App using following url :'.$app_refer_url.' for join with us';;
        $profile_detail['total_users_refered']=$profile_detail->referral_count;
        $apiresponse['profile']=$profile_detail;
      // ############## PROFILE DATA #################

      // ############## OFFERS DATA #################
        $apiresponse['offers']=Banner::select('image')->where('type','offer')->orderBy('sort_by', 'asc')->pluck('image')
        ->toArray();
     // ############## OFFERS DATA #################

      // ############## IMPROVE SHARE DATA #################
        $apiresponse['imporve']['refer_code']=Volunteer::where('id', $user_id)->first()->referal_code;
        $apiresponse['imporve']['refer_text']="This is Testing";
     // ############## IMPROVE SHARE DATA #################

      // ############## Team  DATA #################
        $teams = User::where('refer_id', $user_id)->select('id','name','image','created_at','current_level')->orderby('referral_count','DESC')->limit(10)->get();
        foreach ($teams as $key => $value) {
          $rank= '';
          $rank= @DB :: table('level_rewards')->where('id',$value->current_level)->first()->level_name;
          $value->rank = !empty($rank) ? $rank :'Volunteer';
        }

        $apiresponse['teams']=$teams;


     // ############## Team  DATA #################

      // ############## Team  DATA #################

        $apiresponse['upcoming_event']= Event::whereRaw("FIND_IN_SET(?, volunteer_id)", [$user_id])->where('event_status','Upcoming')
        ->with('village_info:name,id')
        ->select('id','event_status', 'image','name','village_id','event_date','event_time')->limit(5)->get();
     // ############## Team  DATA #################



     $apiresponse['village_count'] = $profile_detail['village_count'];

     $app_refer_url = !empty($profile_detail->referal_code) ? env('APP_URL').'download/'.$profile_detail->referal_code : env('APP_URL').'/get-apk/KTW'.rand(0,10000);
     $events = $this->getEventsByUserId($user_id);
     $total_events = $this->getTotalEventsByUserId($user_id);
     $apiresponse['event_count'] = $total_events;
     $apiresponse['events'] = $events;
    if($request->build_type=='IOS'){
      $version = @DB::table('androidversion')->where('type_build',1)->first()->ios_version;
    }else{
      $version =@DB::table('androidversion')->where('type_build',0)->first()->android_version;
    }
     $device_version_code = !empty($request->device_version_code) ? $request->device_version_code : 18;
     // dd($device_version_code , $version);
      if($device_version_code < $version){
        $apiresponse["version"]= (int)$version;
        $apiresponse["popup_status"] = true;
        $apiresponse["version_changes"]= 'New Version is : '.($version).' 1.Bug Resolved & UI Enhancement In case if you are facing any issue please download app from website.';
        $apiresponse["app_download_url"]= 'https://ktwing.com';
        // $apiresponse["app_download_url"]= 'https://ktwing.com/get-apk';
      }else{
        $apiresponse["version"]= (int)$version;
        $apiresponse["popup_status"] = false;

      }


      return $this->sendResponse($apiresponse, 'Retrieved successfully.');
      }

}
