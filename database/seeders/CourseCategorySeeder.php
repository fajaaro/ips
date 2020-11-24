<?php

namespace Database\Seeders;

use App\Models\CourseCategory;
use Illuminate\Database\Seeder;

class CourseCategorySeeder extends Seeder
{
    public function run()
    {
        $courseCategories = ['Basic', 'Intermediate', 'Superior', 'Entrepreneur'];
        $bundleCourseCategories = ['Short Course', 'Long Course'];

        foreach ($courseCategories as $category) {
        	CourseCategory::create([
        		'name' => $category, 
        		'is_bundle' => false
        	]);
        }

        foreach ($bundleCourseCategories as $category) {
        	CourseCategory::create([
        		'name' => $category, 
        		'is_bundle' => true
        	]);
        }
    }
}
