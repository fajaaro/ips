<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
    	if ($request->category) {
    		$courseCategory = CourseCategory::with('courses.image')->where('name', slugToStr($request->category))->first();

    		if ($courseCategory) $courses = $courseCategory->courses;
    		else return redirect()->route('frontend.courses.index');
    	} else {
	    	$courses = Course::with('image')->get();
    	}

        $courseCategories = CourseCategory::with('courses')->isBundle(false)->get();
        $getRequests = '?category=';
      
        if ($request->type && $request->type == 'bundle') {
            $courseCategories = CourseCategory::with('courses')->isBundle(true)->get();                
            $getRequests = '?type=bundle&category=';
        }

        return view('frontend.courses.index', compact('courses', 'courseCategories', 'getRequests'));
    }

    public function show($id)
    {
    	$course = Course::findOrFail($id);

    	return view('frontend.courses.show', compact('course'));
    }

    public function watch($id)
    {
        $course = Course::with('courseVideo')->where('id', $id)->first();

        return view('frontend.courses.watch', compact('course'));        
    }
}
