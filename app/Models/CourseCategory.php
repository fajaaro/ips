<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function courses()
    {
    	return $this->belongsToMany('App\Models\Course');
    }

    public function scopeIsBundle(Builder $query, $flag) {
	 	return $query->where('is_bundle', $flag);
	}
}
