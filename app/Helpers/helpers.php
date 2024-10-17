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


}

