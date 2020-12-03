<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Bundle;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function getCourse($id)
    {
        $course = Course::with([
            'category', 
            'bundles',
            'courseVideo', 
            'image'
        ])->where('id', $id)->first();

        return response()->json($course);
    }

    public function getBundleCourses($id)
    {
    	$bundle = Bundle::with('courses')->where('id', $id)->first();

    	return response()->json($bundle);
    }
}
