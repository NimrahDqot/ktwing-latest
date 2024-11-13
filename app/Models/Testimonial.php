<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'description',
        'email',
        'phone',
        'image',
        'designation'

    ];
    public function getImageAttribute() {
        // If the image attribute exists in the database, return its full path
        if (!empty($this->attributes['image'])) {
            return url('uploads/testimonial/' . $this->attributes['image']);
        }

        // Return the default image path if no image is set
        $defaultImage = url('uploads/default/default.jpg');
        return $defaultImage;
    }
}
