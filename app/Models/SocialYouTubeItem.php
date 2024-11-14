<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialYouTubeItem extends Model
{

    protected $table='social_youtube_items';
    protected $fillable = [
        'video_url',
        'thumbnail_url',
        'title'
    ];
    public function getImageAttribute() {
        // If the image attribute exists in the database, return its full path
        if (!empty($this->attributes['thumbnail_url'])) {
            return url('uploads/you_tube/' . $this->attributes['thumbnail_url']);
        }

        // Return the default image path if no image is set
        $defaultImage = url('uploads/default/default.jpg');
        return $defaultImage;
    }
}
