<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VolunteerController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'volunteer'], function () {
    Route::post('login', [VolunteerController::class, 'login']);
    Route::post('profile', [VolunteerController::class, 'profile']);
    Route::post('update-profile-image', [VolunteerController::class, 'update_profile_image']);

    Route::get('app-string', [VolunteerController::class, 'app_string']);
    Route::get('banner', [VolunteerController::class, 'banner']);
    // Route::get('get-home-actiity', [VolunteerController::class, 'get_home_actiity']);
    Route::post('notification', [VolunteerController::class, 'notification']);
    Route::post('visitor-form', [VolunteerController::class, 'store_visitor']);
    Route::post('all-event', [VolunteerController::class, 'all_events']);
    Route::post('event-detail', [VolunteerController::class, 'event_detail']);
    Route::post('create-event-request', [VolunteerController::class, 'create_event_request']);
    Route::post('event-medias', [VolunteerController::class, 'event_medias']);
    Route::post('refer-user-list', [VolunteerController::class, 'refer_list']);
    Route::post('level-reward', [VolunteerController::class, 'level_reward']);
    Route::post('logout', [VolunteerController::class, 'logout']);
    Route::post('get-volunteer-home-actiity', [VolunteerController::class, 'get_volunteer_home_actiity']);


});

Route::group(['prefix' => 'user'], function () {
    Route::post('register', [UserController::class, 'register']);
      Route::post('login', [UserController::class, 'login']);
    Route::post('profile', [UserController::class, 'profile']);
    // Route::get('get-home-actiity', [VolunteerController::class, 'get_home_actiity']);
    Route::post('update-profile', [UserController::class, 'update_profile']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::post('delete-account', [UserController::class, 'delete_account']);
    Route::post('get-user-exist', [UserController::class, 'get_user_exist']);
    Route::any('get-home-actiity', [UserController::class, 'get_home_actiity']);
    Route::post('users-level-reward', [UserController::class, 'users_level_reward']);
    Route::post('users-refer-list', [UserController::class, 'user_refer_list']);
});
Route::get('privacy-policy', [AuthController::class, 'privacy_policy']);
Route::get('term-condition', [AuthController::class, 'term_condition']);
Route::post('get-refer-code', [UserController::class, 'getReferCode']);

Route::get('about-us', [AuthController::class, 'about_us']);
Route::get('testimonial', [AuthController::class, 'testimonial']);
Route::get('delete-account', [AuthController::class,'delete_account'])
    ->name('delete-account');
