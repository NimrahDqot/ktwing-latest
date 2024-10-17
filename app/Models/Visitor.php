<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visitor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'phone', 'dob', 'role', 'bio', 'grade', 'review', 'audio', 'image','volunteer_id'
    ];


    public function volunteers(){
        return $this->belongsTo(Volunteer::class,'volunteer_id','id');
    }

    public function getImageAttribute() {
        // If the image attribute exists in the database, return its full path
        if (!empty($this->attributes['image'])) {
            return url('uploads/visitor/' . $this->attributes['image']);
        }

        // Return the default image path if no image is set
        $defaultImage = url('uploads/default/default.jpg');
        return $defaultImage;
    }
}
