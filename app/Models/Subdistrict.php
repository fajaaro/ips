<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function province()
    {
    	return $this->belongsTo('App\Models\Province', 'province_code', 'code');
    }

    public function userAddresses()
    {
    	return $this->hasMany('App\Models\UserAddress');
    }
}
