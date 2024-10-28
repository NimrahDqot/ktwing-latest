<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $fillable = [
        'state_id',
        'district_id',
        'sub_district_id',
        'sub_district_village_id',
        'population',
        'language',
        'contact',
        'status',
    ];
   

    public function events()
    {
        return $this->hasMany(Event::class)->select('village_id'); // Assuming your event model uses a foreign key village_id
    }

    public function scopeActive($query){
        return $query->where('status',1);
    }
    public function SubDistrictVillage() {
        return $this->belongsTo(SubDistrictVillage::class,'sub_district_village_id','id');
    }
    public function District() {
        return $this->belongsTo(District::class,'district_id','id');
    }
    public function SubDistrict() {
        return $this->belongsTo(SubDistrict::class,'sub_district_id','id');
    }
    public function StateInfo() {
        return $this->belongsTo(State::class,'state_id','id');
    }
}
