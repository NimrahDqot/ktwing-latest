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
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UserController extends BaseController
{



    //############## Get Referal code from ip address ###################

    public function getReferCode(Request $request) {

        date_default_timezone_set('Asia/Kolkata');
          // $tempip= $request->header('X-Forwarded-For') ?: $request->ip();
          // return $this->sendResponse($tempip,'Shared Refer Code !');
        $IP = !empty($request->ip) ? $request->ip :'';
        // $IP =  '';
        //    if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        //        $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
        //    else if (isset($_SERVER['HTTP_CLIENT_IP']))
        //        $IP = $_SERVER['HTTP_CLIENT_IP'];
        //    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        //        $IP = $_SERVER['HTTP_X_FORWARDED'];
        //    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        //        $IP = $_SERVER['HTTP_FORWARDED_FOR'];
        //    else if(isset($_SERVER['HTTP_FORWARDED']))
        //        $IP = $_SERVER['HTTP_FORWARDED'];
        //    else if(isset($_SERVER['REMOTE_ADDR']))
        //        $IP = $_SERVER['REMOTE_ADDR'];
        //    else
        //        $IP = 'UNKNOWN';


        if (!$IP) {
            return $this->sendError('IP address not found.');
        }
        $refer = DB::table('app_refers')
                  ->where('ip',$IP)
                  ->where('utilize',0)

                 // ->whereDate('created_at','>=',date('Y-m-d',strtotime('-15 minutes')))
                  ->orderBy('id','DESC')
                  ->first();
                  // $refer['refer_ip'] =  $tempip;
                  $refer_code = @$refer->refer_code ? $refer->refer_code : '';

                  return $this->sendResponse(
                    $refer_code,'Shared Refer Code !');
      }

    //############## Get Referal code from ip address ###################


    //############## Download API ###################

    public function download(Request $request ,$referral=null) {

         $IP =  '';
            if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
            else if (isset($_SERVER['HTTP_CLIENT_IP']))
                $IP = $_SERVER['HTTP_CLIENT_IP'];
            else if(isset($_SERVER['HTTP_X_FORWARDED']))
                $IP = $_SERVER['HTTP_X_FORWARDED'];
            else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                $IP = $_SERVER['HTTP_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_FORWARDED']))
                $IP = $_SERVER['HTTP_FORWARDED'];
            else if(isset($_SERVER['REMOTE_ADDR']))
                $IP = $_SERVER['REMOTE_ADDR'];
            else
                $IP = 'UNKNOWN';



        if(isset($referral) && !empty($referral) &&   $IP != 'UNKNOWN'){

          $referal_id= @DB :: table('volunteers')->where('referal_code',$referral)->first()->id;
          if(empty($referal_id)){
            $referal_id= @DB :: table('users')->where('referal_code',$referral)->first()->id;
          }

          $insertData = array();
          $insertData['ip'] = $IP;
          $insertData['refer_code'] = !empty($referral) ? $referral :0;
          $insertData['referal_user_id'] = $referal_id ;
          $insertData['utilize'] = 0;
          DB::table('app_refers')->insert($insertData);
        }

        header("Location:https://ktwing.com/get-apk");
        // header("Location:".env('APP_URL').'/get-apk');
        exit;

      }

    //############## Download API ###################

    public function login(Request $request) {
            // Validation logic
            $validator = Validator::make($request->all(), [
                'mobile' => 'required|min:10|max:10',
                'token' => 'required|string',
                // 'referal_code' => 'required|string',
                // 'fcm_token' => 'required|string',
                // 'device_id' => 'required|string',
                // 'jwt_token' => 'required|string',
            ]);

            // Return validation errors if validation fails
            if ($validator->fails()) {
                return $this->sendError($validator->errors()->first());
            }

            $credentials = $request->mobile;
            // $referal_code = $request->referal_code;
            // $fcm_token = $request->fcm_token;
            // $device_id = $request->device_id;
            // $jwt_token = $request->jwt_token;
            $custom_user_token = $request->token;
            $ip = $request->ip_address;
            if(empty($ip)){
                $ip = $request->ip();
            }
            try {
                // Get user by email or phone
                $user = User::where('phone', $credentials)
                    ->first();
                // $referal_user_id =0;
                $all_header = getallheaders();
                $FcmToken = $all_header['Fcmtoken'] ?? '';
                if(empty($user)){
                  return $this->sendError('Please signup first.');

                }
                if ($user->status !== '1') {
                    return $this->sendError('User account is inactive.');
                }
                // Update user tokens
                // $user->jwt_token = $jwt_token;
                $user->custom_user_token = $custom_user_token;
                $user->fcm_token = $FcmToken;
                // $user->device_id = $request->device_id;
                $user->save();

                $success = [
                    'token' => $user->createToken('MyApp')->plainTextToken,
                    'id' => $user->id,
                ];

                return $this->sendResponse($success, 'User logged in successfully.');
                // $referal_user = Volunteer::where('referal_code', $referal_code)->select('id','referral_count')->first();
                // $Users_referal_users = User::where('referal_code', $referal_code)->select('id','referral_count')->first();
                // if(!empty($referal_user)){
                //     $referal_user_id = $referal_user->id;
                //     $referal_count = $referal_user->referral_count;
                // }else if(!empty($Users_referal_users)){
                //   $referal_user_id = $Users_referal_users->id;
                //   $referal_count = $Users_referal_users->referral_count;
                // }else {
                //     $referal_user_id =0;
                //     $referal_count =0;
                //
                // }



                // if ($user) {
                //     }
                // else {
                //
                //     $user = new User();
                //     if (filter_var($credentials, FILTER_VALIDATE_EMAIL)) {
                //         $user->email = $credentials;
                //     } elseif (preg_match('/^\d+$/', $credentials)) {
                //         $user->phone = $credentials;
                //     } else {
                //         return $this->sendError('Invalid email or phone format.');
                //     }
                //     // Set other user properties
                //
                //     $user->fcm_token = $fcm_token;
                //     $user->device_id = $device_id;
                //     $user->jwt_token = $jwt_token;
                //     $user->custom_user_token = $custom_user_token;
                //     $user->ip_address = !empty($ip) ? $ip : 0; // Set the IP address if available
                //     $user->referal_code = 'KTW'.strtoupper(Str::random(5));
                //     // Handle referral code logic
                //     if (!empty($referal_user)) {
                //         // Update the user with the referral ID after the user has been saved
                //         $user->refer_id = $referal_user_id;
                //         $user->save(); // Save the updated user with referral ID
                //     }
                //     else if(!empty($Users_referal_users)){
                //       $user->users_refer_id = $referal_user_id;
                //       $user->save();
                //     }else{
                //         $user->refer_id = 0;
                //         $user->save();
                //     }
                //
                //     $update_referal=array(
                //         "referral_count"=>$referal_count +1
                //     );
                //     if(!empty($referal_user)){
                //       DB::table('volunteers')->where('id',$referal_user_id)->update($update_referal);
                //     }
                //     if(!empty($Users_referal_users)){
                //       DB::table('users')->where('id',$referal_user_id)->update($update_referal);
                //     }
                //     /* update volunteer referral count  */
                //
                //     DB::table('app_refers')->where('ip',$ip)->update(['user_id' => $user->id,'utilize'=>1]);
                //     $volunteer = Volunteer::find($referal_user_id);
                //     $Users = User::find($referal_user_id);
                //
                //     if (isset($volunteer)){
                //
                //       $level_rewards = LevelReward::active()->select('id', 'min_users_for_level')->get();
                //       $referal_user = Volunteer::where('referal_code', $referal_code)->select('id','referral_count')->first();
                //       if(isset($referal_user->referral_count)){
                //
                //           $current_level = $level_rewards->firstWhere('min_users_for_level', '>=', $referal_user->referral_count);
                //           if (isset($current_level) && $current_level->id) {
                //               $volunteer->update(['current_level' => $current_level->id]);
                //           }
                //       }
                //
                //   }
                //   if (isset($Users)){
                //
                //       $level_rewards = LevelReward::active()->select('id', 'min_users_for_level')->get();
                //       $referal_user = User::where('referal_code', $referal_code)->select('id','referral_count')->first();
                //       if(isset($referal_user->referral_count)){
                //           $current_level = $level_rewards->firstWhere('min_users_for_level', '>=', $referal_user->referral_count);
                //           if (isset($current_level) && $current_level->id) {
                //               $Users->update(['current_level' => $current_level->id]);
                //           }
                //       }
                //   }
                //
                // }
                // return $this->sendResponse($user, 'User registered successfully.');
            } catch (\Exception $e) {
                // Log the exception (you may want to implement logging)
                Log::error('Login error: ' . $e->getMessage());
                return $this->sendError($e->getMessage(),'An error occurred. Please try again later.');
            }
        }
        public function register(Request $request){
           $validator = Validator::make($request->all(), [
               'username' => 'required|string|max:255',
               'mobile' => 'required|max:10|min:10',
               'token' => 'required',
               'referal_code'=> 'nullable',
           ]);

           if ($validator->fails()) {
               return $this->sendError($validator->errors()->first());
           }
           $refer_id =0;
           $referral_type =0;
           $ip = $request->ip_address;
           $referal_code = $request->referal_code;
           $username = $request->username;
           $all_header = getallheaders();
           $FcmToken = $all_header['Fcmtoken'] ?? '';
           if(empty($ip)){
               $ip = $request->ip();
           }

           $userExist = DB:: table('users')->where('phone',$request->mobile)->first();

         if($userExist){
           return $this->sendError('User already exist please login.');
         }

            $referal_user = Volunteer::where('referal_code', $referal_code)->select('id','referral_count')->first();
            $Users_referal_users = User::where('referal_code', $referal_code)->select('id','referral_count')->first();

            if(!empty($referal_user)){

               $referal_user_id = $referal_user->id;
               $referal_count = $referal_user->referral_count;

           }else if(!empty($Users_referal_users)){

             $referal_user_id = $Users_referal_users->id;
             $referal_count = $Users_referal_users->referral_count;

           }else {

               $referal_user_id =0;
               $referal_count =0;

           }
            $user = new User();

            $user->name = $username;
            $user->fcm_token = $FcmToken;
            $user->custom_user_token = $request->token;
            $user->phone = $request->mobile;
            $user->ip_address = !empty($ip) ? $ip : 0; // Set the IP address if available
            $user->referal_code = 'KTW'.strtoupper(Str::random(5));
            // Handle referral code logic
            if (!empty($referal_user)) {
                // Update the user with the referral ID after the user has been saved
                $user->refer_id = $referal_user_id;
                $user->save(); // Save the updated user with referral ID
            }
            else if(!empty($Users_referal_users)){
              $user->users_refer_id = $referal_user_id;
              $user->save();
            }else{
                $user->refer_id = 0;
                $user->save();
            }

            $update_referal=array(
                "referral_count"=>$referal_count +1
            );
            if(!empty($referal_user)){
              DB::table('volunteers')->where('id',$referal_user_id)->update($update_referal);
            }
            if(!empty($Users_referal_users)){
              DB::table('users')->where('id',$referal_user_id)->update($update_referal);
            }
            /* update volunteer referral count  */

            DB::table('app_refers')->where('ip',$ip)->update(['user_id' => $user->id,'utilize'=>1]);
            $volunteer = Volunteer::find($referal_user_id);
            $Users = User::find($referal_user_id);

            if (isset($volunteer)){

              $level_rewards = LevelReward::active()->select('id', 'min_users_for_level')->get();
              $referal_user = Volunteer::where('referal_code', $referal_code)->select('id','referral_count')->first();
              if(isset($referal_user->referral_count)){

                  $current_level = $level_rewards->firstWhere('min_users_for_level', '>=', $referal_user->referral_count);
                  if (isset($current_level) && $current_level->id) {
                      $volunteer->update(['current_level' => $current_level->id]);
                  }
              }

          }
          if (isset($Users)){

              $level_rewards = LevelReward::active()->select('id', 'min_users_for_level')->get();
              $referal_user = User::where('referal_code', $referal_code)->select('id','referral_count')->first();
              if(isset($referal_user->referral_count)){
                  $current_level = $level_rewards->firstWhere('min_users_for_level', '>=', $referal_user->referral_count);
                  if (isset($current_level) && $current_level->id) {
                      $Users->update(['current_level' => $current_level->id]);
                  }
              }
          }

           return $this->sendResponse($user, 'Participates registered successfully.');
       }
      public function register_old(Request $request){
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:255',
                'mobile' => 'required|max:10|min:10',
                'token' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors()->first());
            }
            $refer_id =0;
            $referral_type =0;
            $userExist = DB:: table('users')->where('phone',$request->mobile)->first();

          if(empty($userExist) OR $userExist->is_registered==0){

              $referal_users=array();
              $referal_users = DB:: table('volunteers')->where('referal_code',$request->refer_code)->select('id')->first();
              if(!empty($referal_users)){
                $refer_id = (!empty($referal_users->id) && $referal_users->id >0) ? $referal_users->id : '0';
                $referral_type =0;
              }
              $referal_users = DB:: table('users')->where('referal_code',$request->refer_code)->select('id')->first();
              if(!empty($referal_users)){
                $refer_id = (!empty($referal_users->id) && $referal_users->id >0) ? $referal_users->id : '0';
                $referral_type =1;
              }
            // Create user
            // echo $referral_type; exit;
            $all_header = getallheaders();

            $FcmToken = $all_header['Fcmtoken'] ?? '';
            if($referral_type == 0) {
                $updateORInsert = array(
                  "name"=>$request->username,
                  "phone"=>$request->mobile,
                  "refer_id"=>$refer_id,
                  "custom_user_token"=>$request->token,
                  "is_registered"=>1,
                  "fcm_token"=>$FcmToken
                );
               if(empty($userExist)){
               $data =    DB :: table('users')->insert($updateORInsert);
              $insertedUser = DB::table('users')->where('phone', $request->mobile)->first();
               }else{
              $data =    DB :: table('users')->where('id',$userExist->id)->update($updateORInsert);
              $insertedUser = DB::table('users')->where('id', $userExist->id)->first();
                  // dd($updateORInsert);
               }
               return $this->sendResponse($insertedUser, 'Participates registered successfully.');

            } else {
              $updateORInsert = array(
                "name"=>$request->username,
                "phone"=>$request->phone,
                "users_refer_id"=>$refer_id,
                "custom_user_token"=>$request->token,
                "is_registered"=>1,
                "fcm_token"=>$FcmToken
              );
              if(empty($userExist)){
                DB :: table('users')->insert($updateORInsert);
                $insertedUser = DB::table('users')->where('phone', $request->mobile)->first();

              }else{
                DB :: table('users')->where('id',$userExist->id)->update($updateORInsert);
                $insertedUser = DB::table('users')->where('id', $userExist->id)->first();
             }
                 return $this->sendResponse($insertedUser, 'Participates registered successfully.');
            }
             // Return user data
          }else{

              return $this->sendError('Participates already Exist please try to login.');
          }

        }
        public function get_user_exist(Request $request){
          $validator = Validator::make($request->all(), [
              'mobile' => 'required|max:10|min:10',
              // 'user_type'=>'required',
          ]);
          // Return validation errors if validation fails
          if ($validator->fails()) {
             return $this->sendError($validator->errors()->first());
         }
            $user=array();
            $user_type = 1;
            if($user_type == 0){
              $user = DB::table('volunteers')->where('phone',$request->mobile)->exists();
              $message="Volunteer Already Exist";
            }else{

              $user = DB::table('users')->where('phone',$request->mobile)->exists();
              $message="Participates Already Exist";
            }
            if(!empty($user)){
              return $this->sendResponse(0, $message);
            }else{
              return $this->sendError("Please signup first", 1);
            }
        }
        public function user_refer_list(Request $request){
            $user_id = $request->user_id;
            $type = 1;

            $loginResponse = $this->validateLogin($user_id, $type);

            if ($loginResponse->getStatusCode() !== 200) {
                return $this->sendUnauthorize('Unauthorized', 202);
            }

            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
            ]);

            // Return validation errors if validation fails
            if ($validator->fails()) {

                return $this->sendError($validator->errors()->first());
            }

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


    public function login_old(Request $request) {
        // Validation logic
        $validator = Validator::make($request->only(['email_or_phone','token', 'referal_code','fcm_token','device_id','jwt_token','token']), [
            'email_or_phone' => 'required|string|max:25',
            'token' => 'required|string',
            // 'referal_code' => 'required|string',
            'fcm_token' => 'required|string',
            'device_id' => 'required|string',
            'jwt_token' => 'required|string',
        ]);

        // Return validation errors if validation fails
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        $credentials = $request->email_or_phone;
        $referal_code = $request->referal_code;
        $fcm_token = $request->fcm_token;
        $device_id = $request->device_id;
        $jwt_token = $request->jwt_token;
        $custom_user_token = $request->token;
        $ip = $request->ip_address;
        if(!$ip){
            $ip = $request->ip();
        }
        try {
            // Get user by email or phone
            $user = User::where('email', $credentials)
                ->orWhere('phone', $credentials)
                ->first();

            // Get refer ID if volunteer exists
            $referal_user_id =0;

            $referal_user = Volunteer::where('referal_code', $referal_code)->select('id','referral_count')->first();
            if(!empty($referal_user)){
                $referal_user_id = $referal_user->id;
                $referal_count = $referal_user->referral_count;
            }else{
                $referal_user_id =0;
                $referal_count =0;

            }

            if ($user) {
                if ($user->status !== '1') {
                    return $this->sendError('User account is inactive.');
                }
                // Update user tokens
                $user->jwt_token = $jwt_token;
                $user->custom_user_token = $custom_user_token;
                $user->fcm_token = $request->fcm_token;
                $user->device_id = $request->device_id;

                $user->save();



                // Generate an access token
                $success = [
                    'token' => $user->createToken('MyApp')->plainTextToken,
                    'id' => $user->id,
                ];

                return $this->sendResponse($success, 'User logged in successfully.');
            } else {

                $user = new User();
                if (filter_var($credentials, FILTER_VALIDATE_EMAIL)) {
                    $user->email = $credentials;
                } elseif (preg_match('/^\d+$/', $credentials)) {
                    $user->phone = $credentials;
                } else {
                    return $this->sendError('Invalid email or phone format.');
                }
                // Set other user properties

                $user->fcm_token = $fcm_token;
                $user->device_id = $device_id;
                $user->jwt_token = $jwt_token;
                $user->custom_user_token = $custom_user_token;

                if(!empty($referal_code) && $referal_user_id>0){
                    $user->refer_id = $referal_user_id;
                    $user->ip_address = !empty($ip) ? $ip : 0;

                    $update_referal=array(
                        "referral_count"=>$referal_count +1
                    );
                    $update_user_id=array(
                        "user_id"=>$user->id
                    );
                    DB :: table('volunteers')->where('id',$referal_user_id)->update($update_referal);
                    DB :: table('app_refers')->where('ip',$ip)->update($update_user_id);
                }
                $user->save();
                    $user->token = $custom_user_token;
                return $this->sendResponse($user, 'User registered successfully.');
            }
        } catch (\Exception $e) {
            // Log the exception (you may want to implement logging)
            Log::error('Login error: ' . $e->getMessage());
            return $this->sendError('An error occurred. Please try again later.');
        }
    }

    public function profile(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        // Return validation errors if validation fails
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        try {
          $user_id = $request->user_id;
          $user = User::find($user_id);
          if (!$user) {
              return $this->sendError('User not found.');
          }
          $profile_detail = User::where('id', $user_id)->select('id', 'refer_id', 'name', 'phone', 'email', 'dob', 'gender', 'image','referal_code','referral_count','current_level', 'status','created_at')->first();
          $profile_detail->usertype ="Participant";
          $app_refer_url = !empty($profile_detail->referal_code) ? env('APP_URL').'download/'.$profile_detail->referal_code : env('APP_URL').'/get-apk/KTW'.rand(0,10000);
          $profile_detail->current_level = ($profile_detail->current_level==0) ? 1 : $profile_detail->current_level;
          $level_name = DB ::table('level_rewards')->where('id',$profile_detail->current_level)->first()->level_name;
          $rank = @DB ::table('level_rewards')->where('id',$profile_detail->current_level)->first()->rank;
          $profile_detail->current_level = $rank;

            $profile_detail['user_refer_level']=!empty($level_name) ? $level_name : "No Level";
            $profile_detail['user_refer_share']='Welcome to KT Wing , Please download and installed App using following url :'.$app_refer_url.' for join with us';;
            $profile_detail['total_users_refered']=$profile_detail->referral_count;
            return $this->sendResponse($profile_detail, 'Profile detail retrieved successfully.');

        } catch (\Exception $e) {
            return $this->sendError('An error occurred while retrieving app strings.', $e->getMessage());
        }
    }

    public function validateLogin($user_id, $type){
        // Determine the correct model based on type
        $model = ($type == 0) ? Volunteer::class : User::class;
        $all_header = getallheaders();

        $FcmToken = $all_header['Fcmtoken'] ?? '';
        // dd( $FcmToken,$model,$user_id);
        // Check if the user exists with the given ID and FCM token
        if ($model::where(['id' => $user_id, 'fcm_token' => $FcmToken])->exists()) {
            return response()->json(['message' => 'Login Successfully'], 200);
        }else{
            return response()->json(['error' => 'Unauthorized.'], 202);
        }
    }

    public function users_level_reward(Request $request){

        $user_id = $request->user_id;
        $type = 1;
        $loginResponse = $this->validateLogin($user_id, $type);
        if ($loginResponse->getStatusCode() !== 200) {
            return $this->sendUnauthorize('Unauthorized', 202);
        }
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        // Return validation errors if validation fails
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        try {
            $user_id = $request->user_id;

            $volunteer = User::find($user_id);
            if (!$volunteer) {
                return $this->sendError('Participant not found.');
            }

            $refer_id_count = User::where('users_refer_id', $user_id)->count();
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

            // $response = [
            //     'level' => $level_rewards,
            //     'current_level' => $current_level->level_name,
            //     'current_users' => $refer_id_count,
            //     'next_level' => isset($level_rewards[$level_rewards->search($current_level) + 1]) ? $level_rewards[$level_rewards->search($current_level) + 1]->level_name : null,
            //     'user_needed_for_next_level' => isset($level_rewards[$level_rewards->search($current_level) + 1]) ? $level_rewards[$level_rewards->search($current_level) + 1]->min_users_for_level : null,
            // ];
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

    public function update_profile(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'name' => 'required|max:25',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'phone' => [
            //     'nullable',
            //     'min:10',
            //     'max:10',
            //     Rule::unique('users')->ignore($request->user_id),
            // ],
            // 'email' => [
            //     'nullable',
            //     'email',
            //     'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            //     Rule::unique('users')->ignore($request->user_id), // Use the correct table
            // ],

        ]);

        // Return validation errors if validation fails
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        try {
            $user_id = $request->user_id;
            $user = User::find($user_id);
            if (!$user) {
                return $this->sendError('User not found.');
            }
            if($request->hasFile('image')){
                @unlink(public_path('uploads/users/'.$user->image)); // Unlink old image
                $ext = $request->file('image')->extension();
                $rand_value = md5(mt_rand(11111111,99999999));
                $final_name = $rand_value.'.'.$ext;
                $request->file('image')->move(public_path('uploads/users/'), $final_name);

                $user['image'] = $final_name; // Update with new image name
            }
            $user->name = $request->name;
            // $user->phone = $request->phone;
            $user->dob = $request->dob;
            // $user->email = $request->email;
            $user->gender = $request->gender; //'Male', 'Female', 'Other
            $user->save();
            return $this->sendResponse($user, 'Profile detail retrieved successfully.');

        } catch (\Exception $e) {
            return $this->sendError('An error occurred while retrieving app strings.', $e->getMessage());
        }
    }
    public function logout(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'fcm_token' => 'required',
            'device_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        // Find the user based on the given user_id, fcm_token, and device_id
        $user = User::where([
            ['id', $request->user_id],
            ['fcm_token', $request->fcm_token],
        ])->first();

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

    public function delete_account(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required', // Ensure the user exists
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        $user = User::find($request->user_id); // Retrieve the user

        if ($user) {
            try {
                // Update the user's status to 0 (inactive)
                $user->status = '0'; // Assuming 'status' is a column in the users table
                $user->save(); // Save the changes

                return $this->sendResponse([], 'Account deleted successfully.');

            } catch (\Exception $e) {
                return $this->sendError('Account not deleted: ' . $e->getMessage());
            }
        } else {
            return $this->sendError('User not found.');
        }
    }

    public function get_home_actiity(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        $apiresponse=array();
        $user_id = $request->user_id;
      // ############## PROFILE DATA #################
        $profile_detail = User::where('id', $user_id)->select('id', 'refer_id', 'name', 'phone', 'email', 'dob', 'gender', 'image','referal_code','referral_count','current_level', 'status','created_at')->first();
        if(empty($profile_detail)){
          return $this->sendError('User not found');

        }


        $profile_detail->usertype ="Participant";

        $app_refer_url = !empty($profile_detail->referal_code) ? env('APP_URL').'download/'.$profile_detail->referal_code : env('APP_URL').'/get-apk/KTW'.rand(0,10000);
        $profile_detail->current_level = ($profile_detail->current_level==0) ? 1 : $profile_detail->current_level;
        $level_name = DB ::table('level_rewards')->where('id',$profile_detail->current_level)->first()->level_name;
        $profile_detail['user_refer_level']=!empty($level_name) ? $level_name : "No Level";
        $rank = @DB ::table('level_rewards')->where('id',$profile_detail->current_level)->first()->rank;
        $profile_detail->current_level = $rank;
        $profile_detail['user_refer_share']='Welcome to KT Wing , Please download and installed App using following url :'.$app_refer_url.' for join with us';;
        $profile_detail['total_users_refered']=$profile_detail->referral_count;
        $apiresponse['profile']=$profile_detail;
      // ############## PROFILE DATA #################

      // ############## OFFERS DATA #################
        $apiresponse['offers']=Banner::select('image')->where('type','offer')->orderBy('sort_by', 'asc')->pluck('image')
        ->toArray();
     // ############## OFFERS DATA #################

      // ############## IMPROVE SHARE DATA #################
        $apiresponse['imporve']['refer_code']=User::where('id', $user_id)->first()->referal_code;
        $apiresponse['imporve']['refer_text']="This is Testing";
     // ############## IMPROVE SHARE DATA #################

      // ############## Team  DATA #################
        $teams = User::where('users_refer_id', $user_id)->select('id','name','image','created_at','current_level')->orderby('referral_count','DESC')->limit(10)->get();
        foreach ($teams as $key => $value) {
          $rank= '';
          $rank= @DB :: table('level_rewards')->where('id',$value->current_level)->first()->level_name;
          $value->rank = !empty($rank) ? $rank :'Participates';
        }

        $apiresponse['teams']=$teams;

     // ############## Team  DATA #################

      // ############## Team  DATA #################

        $apiresponse['events']= Event::where('event_status','Upcoming')
        ->with('village_info:name,id')
        ->select('id','event_status', 'image','name','village_id','event_date','event_time')->limit(5)->get();
     // ############## Team  DATA #################

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
