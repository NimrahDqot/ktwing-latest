<?php

// Code within app\Helpers\Helper.php



namespace App\Helpers;

use App\Models\Notification;


use Config;

use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Volunteer;

use Google\Client as Google_Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use DB;

class Helper

{

    public static function getAccessToken(){

        $service_account = storage_path('ktwing.json');
        $client = new \Google_Client();
        $client->setAuthConfig($service_account);
        $client->addScope('https://www.googleapis.com/auth/cloud-platform');
        $token = $client->fetchAccessTokenWithAssertion();
        return $token['access_token'];

      }


    public static function sendPushNotification($deviceToken, $title, $message)
    {
        $fcmToken = $deviceToken; // This should be passed from the frontend
        // Notification data structure
        $notificationData = [
            "message" => [
                "token" => $fcmToken,
                "notification" => [
                    "title" => $title,
                    "body" => $message,
                ],
                "data" => [
                    "icon" => "new",
                    "sound" => "default",
                ],
            ],
        ];

        // Send the HTTP request to FCM
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . self::getAccessToken(),
            'Content-Type' => 'application/json',
        ])->post('https://fcm.googleapis.com/v1/projects/ktwing-f7b8b/messages:send', $notificationData);

        // Check for errors in the response
        if ($response->failed()) {
            // Log the error or handle it as needed
            return [
                'success' => false,
                'error' => $response->json(),
            ];
        }

        return [
            'success' => true,
            'data' => $response->json(),
        ];
    }

    public static function user_member_id($user){
        if($user){
            if(!$user->referal_code){
                $user->referal_code = 'KTW'.strtoupper(Str::random(5));
            }
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
        }
    }

}

