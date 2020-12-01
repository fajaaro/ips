<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function courses()
    {
    	return $this->belongsToMany('App\Models\Course');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
