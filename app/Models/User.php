<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    use HasApiTokens, Notifiable,SoftDeletes;

    protected $fillable = [
      'refer_id', 'name', 'phone', 'email', 'dob', 'gender', 'password', 'fcm_token', 'socialLoginType', 'device_id', 'jwt_token', 'custom_user_token', 'image', 'image_thumbnail', 'status','referal_code','users_refer_id','referral_count','current_level','alloted_level_gift','rejection_reason','ip_address'
    ];

    public function Role(){
        return   $this->belongsTo(Role::class,'usertype');
    }
    public function getImageAttribute() {
        // If the image attribute exists in the database, return its full path
        if (!empty($this->attributes['image'])) {
            return url('uploads/users/' . $this->attributes['image']);
        }

        // Return the default image path if no image is set
        $defaultImage = url('uploads/default/default.jpg');
        return $defaultImage;
    }
    public function Volunteer_info(){
        return   $this->belongsTo(Volunteer::class,'refer_id','id')->select('name', 'id');
    }
    public function user_info(){
        return   $this->belongsTo(self::class,'users_refer_id','id')->select('name','users_refer_id','id');
    }
    public function level_info(){
        return   $this->belongsTo(LevelReward::class,'current_level','id')->select('level_name','id');
    }
}
