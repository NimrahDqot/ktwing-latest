<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Volunteer;
class UserAuthFirebase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Volunteer::where(['fcm_token'=>$request->fcm_token,'device_id'=>$request->device_id])->exists()){
            return $next($request);

        }else{
            $response = ['success' => false, 'message' => 'Unauthorized.','data'=>[]];
            return response()->json($response, 201);
        }
    }
}
