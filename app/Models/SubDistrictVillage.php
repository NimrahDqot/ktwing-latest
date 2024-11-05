<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDistrictVillage extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'sub_district_villages';

    public function SubDistrict() {
        return $this->belongsTo(SubDistrict::class,'sub_district_id','id');
    }
    public function scopeActive($query){
        return $query->where('status',1);
    }
}
