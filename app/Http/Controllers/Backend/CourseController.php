<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Services\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('users')->get();

        return view('backend.courses.index', compact('courses'));
    }

    public function create()
    {
        $courseCategories = CourseCategory::all();

        return view('backend.courses.create', compact('courseCategories'));
    }

    public function store(Request $request, CourseService $courseService)
    {
        $course = $courseService->create($request);

        return redirect()->route('backend.courses.index')->with('success', 'Berhasil membuat course baru bernama ' . $course->name . '!');
    }

    public function show($id)
    {
        $course = Course::with([
            'courseCategories', 
            'courseVideo', 
            'image',
            'users'
        ])->where('id', $id)->first();

        return view('backend.courses.show', compact('course'));
    }

    public function edit($id)
    {
        $course = Course::find($id);
        $courseCategories = CourseCategory::all();

        return view('backend.courses.edit', compact('course', 'courseCategories'));
    }

    public function update(Request $request, $id, CourseService $courseService)
    {
        $updatedCourse = $courseService->update($request, $id);

        return redirect()->route('backend.courses.index')->with('success', 'Berhasil memperbarui course ' . $updatedCourse->name . '!');                    
    }

    public function destroy($id, CourseService $courseService)
    {
        $deletedCourse = Course::find($id);    

        if ($courseService->destroy($id)) {
            return redirect()->route('backend.courses.index')->with('success', 'Berhasil menghapus course ' . $deletedCourse->name . '!');            
        } else {
            return redirect()->route('backend.courses.index')->with('failed', 'Gagal menghapus course ' . $deletedCourse->name . '!');                        
        }
    }
}
