<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function bundles()
    {
        return $this->belongsToMany('App\Models\Bundle');
    }

	public function category()
	{
		return $this->belongsTo('App\Models\Category');
	}

	public function courseVideo()
	{
		return $this->hasOne('App\Models\CourseVideo');
	}

    public function image()
    {
        return $this->morphOne('App\Models\Image', 'imageable');
    }

    public function users()
    {
    	return $this->belongsToMany('App\Models\User');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
