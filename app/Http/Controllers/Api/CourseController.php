<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function getCourse($id)
    {
        $course = Course::with([
            'courseCategories', 
            'courseVideo', 
            'image'
        ])->where('id', $id)->first();

        return response()->json($course);
    }

    public function getBundleCourses($id)
    {
    	$courses = CourseCategory::find($id)->courses;

    	return response()->json($courses);
    }
}
