<?php 

namespace App\Services;

use App\Models\BundleCourse;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseVideo;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class CourseService
{
	public function create($request)
	{
		$course = new Course();
		$course->category_id = $request->category_id;
		$course->name = $request->name;
		$course->price = $request->price;
		$course->overview = $request->overview;
		$course->tools = $request->tools;
		$course->recipes = $request->recipes;
		$course->steps = $request->steps;
		$course->notes = $request->notes;
		$course->save();

		$course->bundles()->attach($request->bundles_id);

		$courseVideo = new CourseVideo();
		$courseVideo->course_id = $course->id;
		$courseVideo->url = $request->course_video_url;
		$courseVideo->save();

		$courseImage = $request->file('image');
		if ($courseImage) {
	        $this->storeCourseImage($courseImage, $course);
		}

        return $course;
	}

	public function update($request, $courseID)
	{
		$course = Course::find($courseID);
		$course->category_id = $request->category_id;
		$course->name = $request->name;
		$course->price = $request->price;
		$course->overview = $request->overview;
		$course->tools = $request->tools;
		$course->recipes = $request->recipes;
		$course->steps = $request->steps;
		$course->notes = $request->notes;
		$course->save();

		$course->bundles()->detach();
		$course->bundles()->attach($request->bundles_id);

		$courseVideo = $course->courseVideo;
		$courseVideo->url = $request->course_video_url;
		$courseVideo->save();
	
		$courseImage = $request->file('image');
		if ($courseImage) {
			if ($course->image) {
				Storage::delete($course->image->url);
					
				$course->image()->delete();				
			}

	        $this->storeCourseImage($courseImage, $course);
		}

        return $course;		
	}

	private function storeCourseImage($courseImage, $course)
	{
		$imageExtension = $courseImage->guessExtension();
        $imageName = $course->id . '_' . strtolower(str_replace(' ', '_', $course->name)) . '.' . $imageExtension; 
        $imageUrl = Storage::putFileAs('course-images', $courseImage, $imageName);

        $imageUrl = str_replace('+', '%2B', $imageUrl);
        $course->image()->save(
        	Image::make(['url' => $imageUrl])
        );

        return $course->image;
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