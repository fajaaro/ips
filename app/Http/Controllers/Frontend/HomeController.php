<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
    	$user = Auth::user();

    	return view('frontend.index', compact('user'));
    }

    public function debug()
    {
    	// $courses = Course::all();

    	// foreach ($courses as $course) {
    		// $imageName = $course->id . '_' . strtolower(str_replace(' ', '_', $course->name)) . '.jpeg'; 
	        // $imageUrl = 'course-images/' . $imageName;

	     //    if (Storage::exists($imageUrl)) {
		        // $imageUrl = str_replace('+', '%2B', $imageUrl);
		        // $course->image()->save(
		        // 	Image::make(['url' => $imageUrl])
		        // );	        	
	     //    }
    	// }

  //   	$course = Course::find(61);

		// $imageName = $course->id . '_' . strtolower(str_replace(' ', '_', $course->name)) . '.jpeg'; 
  //       $imageUrl = 'course-images/' . $imageName;
  //       $imageUrl = str_replace('+', '%2B', $imageUrl);
  //       $course->image()->save(
  //       	Image::make(['url' => $imageUrl])
  //       );	        	

  //   	dd($course->image, $course);
    }
}
