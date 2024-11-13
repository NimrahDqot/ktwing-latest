<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $table='enquiry';
    protected $fillable = [
    'name','email','phone', 'image','subject','description','query_type','comment',
    ];

}
