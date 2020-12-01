<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bundle;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
    	if ($request->category && $request->type != 'bundle') {
    		$category = Category::with('courses.image')->where('name', slugToStr($request->category))->first();

    		if ($category) $courses = $category->courses;
    		else return redirect()->route('frontend.courses.index');
    	} else {
	    	$courses = Course::with('image')->get();
    	}

        $categories = Category::all();
        $getRequests = '?category=';
      
        if ($request->type == 'bundle') {
            $categories = Bundle::all(); 
            $getRequests = '?type=bundle&category=';

            if ($request->category) {
                $courses = Bundle::where('name', slugToStr($request->category))->first()->courses;
            }
        }

        return view('frontend.courses.index', compact('courses', 'categories', 'getRequests'));
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
