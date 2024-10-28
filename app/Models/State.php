<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'states';

    public function cities() {
        return $this->hasMany(City::class);
    }


}
