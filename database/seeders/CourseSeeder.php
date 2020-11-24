<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseVideo;
use App\Models\Image;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $courseCategories = CourseCategory::where('is_bundle', false)->get();
        $bundleCourseCategories = CourseCategory::where('is_bundle', true)->get();

        $totalCourseCategories = $courseCategories->count();
        $totalBundleCourseCategories = $bundleCourseCategories->count();

        $courseNames = [
        	'Almond Sour Cream Pound Cake', 
        	'Apple Crumble Tart',
        	'Banana Bread',
        	'Brownies Cheese Cake',
        	'Castangel'
        ];

        $coursePrices = [
        	1000000,
        	1250000,
        	750000,
        	2500000,
        	12500000
        ];

        $totalCourse = count($courseNames);

        for ($i = 0; $i < $totalCourse; $i++) {
            $num = $i + 1;

        	$course = new Course();
        	$course->name = $courseNames[$i];
        	$course->price = $coursePrices[$i];
        	$course->overview = '<p>Overview Course ' . $num . '</p>';
            $course->tools = '<h6>Tools Course ' . $num . '</h6>';
        	$course->recipes = '<h6>Recipes Course ' . $num . '</h6>';
        	$course->steps = '<h6>Steps Course ' . $num . '</h6>';
        	$course->notes = '<h6>Notes Course ' . $num . '</h6>';
        	$course->save();

        	$selectedCategory = [];
        	for ($j = 0; $j < $totalCourseCategories; $j++) {
        		$selectStatus = rand(0, 1);

        		if ($selectStatus) array_push($selectedCategory, $courseCategories[$j]->id);
        	}
        	if (count($selectedCategory) == 0) array_push($selectedCategory, 2);

        	array_push($selectedCategory, $bundleCourseCategories->random()->id);

        	$course->courseCategories()->attach($selectedCategory);

            $courseVideo = new CourseVideo();
            $courseVideo->course_id = $course->id;
            $courseVideo->url = 'https://www.youtube.com/embed/bS9eXS6VucU';
            $courseVideo->save();

            $imageUrl = 'course-images/' . $course->id . '_' . strtolower(str_replace(' ', '_', $course->name)) . '.jpg';

            $course->image()->save(
                Image::make(['url' => $imageUrl])
            );
        }
    }
}
