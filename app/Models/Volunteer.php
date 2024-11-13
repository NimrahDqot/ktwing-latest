<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Volunteer extends Model
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    protected $fillable = [
    'name', 'email', 'password', 'role_id', 'status',  'image', 'phone', 'experience','rejection_reason','village_id','fcm_token','device_id','current_level','blood_group','team_category_id','social_link','father_name','address','designation'
    ];


    public function Role(){
        return  $this->belongsTo(Role::class,'role_id')->select('name');
    }
    // protected $hidden = [
    // 'password',
    // ];

    public function getImageAttribute() {
        // If the image attribute exists in the database, return its full path
        if (!empty($this->attributes['image'])) {
            return url('uploads/volunteer/' . $this->attributes['image']);
        }

        // Return the default image path if no image is set
        $defaultImage = url('uploads/default/default.jpg');
        return $defaultImage;
    }
    // public function getImageAttribute() {
    //     // Define the path to the uploads directory
    //     $imagePath = public_path('uploads/volunteer/' . $this->attributes['image']);

    //     // If the image attribute exists and the file exists, return its full path
    //     if (!empty($this->attributes['image']) && file_exists($imagePath)) {
    //         return url('uploads/volunteer/' . $this->attributes['image']);
    //     }

    //     // Return the default image path if no image is set
    //     return url('uploads/default/default.jpg');
    // }


    public function village(){
        return $this->belongsTo(Village::class,'village_id','id');
    }

    public function TeamCategoryInfo(){
        return $this->belongsTo(TeamCategory::class,'team_category_id','id');
    }

    // Volunteer.php
    public function villages()
    {
        // Ensure to handle null or empty case
        if (empty($this->village_id)) {
            return collect(); // Return an empty collection if no villages
        }

        $villageIds = explode(',', $this->village_id);
        return Village::whereIn('id', $villageIds)->get(); // Get villages based on IDs
    }

    public function getVillageCountAttribute() {
        return count(explode(',', $this->village_id));
    }

    public function visitors() {
        return $this->hasMany(Visitor::class, 'volunteer_id','id');
    }

}
