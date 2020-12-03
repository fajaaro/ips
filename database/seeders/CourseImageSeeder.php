<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CourseImageSeeder extends Seeder
{
    public function run()
    {
        $courses = Course::all();

        foreach ($courses as $course) {
        	$imageName = $course->id . '_' . strtolower(str_replace(' ', '_', $course->name)) . '.jpeg'; 
	        $imageUrl = 'course-images/' . $imageName;

	        if (Storage::exists($imageUrl)) {
		        $imageUrl = str_replace('+', '%2B', $imageUrl);
		        $course->image()->save(
		        	Image::make(['url' => $imageUrl])
		        );	        	
	        }
        }
    }
}
