<?php 

namespace App\Services;

use App\Models\Course;
use App\Models\CourseCourseCategory;
use App\Models\CourseVideo;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class CourseService
{
	public function create($request)
	{
		$course = new Course();
		$course->name = $request->name;
		$course->price = $request->price;
		$course->overview = $request->overview;
		$course->tools = $request->tools;
		$course->recipes = $request->recipes;
		$course->steps = $request->steps;
		$course->notes = $request->notes;
		$course->save();

		$courseCategories = $request->course_categories_id;
		foreach ($courseCategories as $category) {
			$courseCategoryCourse = new CourseCourseCategory();
			$courseCategoryCourse->course_category_id = $category;
			$courseCategoryCourse->course_id = $course->id;
			$courseCategoryCourse->save();			
		}

		$courseVideo = new CourseVideo();
		$courseVideo->course_id = $course->id;
		$courseVideo->url = $request->course_video_url;
		$courseVideo->save();

		$courseImage = $request->file('image');
        $imageExtension = $courseImage->guessExtension();
        $imageName = $course->id . '_' . strtolower(str_replace(' ', '_', $course->name)) . '.' . $imageExtension; 
        $imageUrl = Storage::putFileAs('course-images', $courseImage, $imageName);

        $course->image()->save(
        	Image::make(['url' => $imageUrl])
        );

        return $course;
	}

	public function update($request, $courseID)
	{
		$course = Course::find($courseID);
		$course->name = $request->name;
		$course->price = $request->price;
		$course->overview = $request->overview;
		$course->tools = $request->tools;
		$course->recipes = $request->recipes;
		$course->steps = $request->steps;
		$course->notes = $request->notes;
		$course->save();

		CourseCourseCategory::where('course_id', $course->id)->delete();

		$courseCategories = $request->course_categories_id;
		foreach ($courseCategories as $category) {
			$courseCategoryCourse = new CourseCourseCategory();
			$courseCategoryCourse->course_category_id = $category;
			$courseCategoryCourse->course_id = $course->id;
			$courseCategoryCourse->save();			
		}

		$courseVideo = $course->courseVideo;
		$courseVideo->url = $request->course_video_url;
		$courseVideo->save();
	
		$courseImage = $request->file('image');
		if ($courseImage) {
			if ($course->image) {
				Storage::delete($course->image->url);
					
				$course->image()->delete();				
			}

	        $imageExtension = $courseImage->guessExtension();
	        $imageName = $course->id . '_' . strtolower(str_replace(' ', '_', $course->name)) . '.' . $imageExtension; 
	        $imageUrl = Storage::putFileAs('course-images', $courseImage, $imageName);

	        $course->image()->save(
	        	Image::make(['url' => $imageUrl])
	        );			
		}

        return $course;		
	}

	public function destroy($id)
	{
		$course = Course::find($id);

		if ($course) {
			if ($course->image) {
				Storage::delete($course->image->url);
				
				$course->image()->delete();
			}
	
			$course->delete();

			return true;
		} 

		return false;
	}
}