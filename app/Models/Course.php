<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

	public function courseCategories()
	{
		return $this->belongsToMany('App\Models\CourseCategory');
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
}
