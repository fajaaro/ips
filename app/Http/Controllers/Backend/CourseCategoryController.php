<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use Illuminate\Http\Request;

class CourseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courseCategories = CourseCategory::with('courses')->isBundle(false)->get();
        $bundleCourseCategories = CourseCategory::with('courses')->isBundle(true)->get();

        return view('backend.course-categories.index', compact('courseCategories', 'bundleCourseCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.course-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoriesName = $request->names;

        foreach ($categoriesName as $name) {
            $courseCategory = new CourseCategory();
            $courseCategory->name = $name;
            $courseCategory->save();
        }

        return redirect()->route('backend.courseCategories.index')->with('success', 'Berhasil membuat ' . count($categoriesName) . ' kategori!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $courseCategory = CourseCategory::find($id);
        $courseCategoryName = $courseCategory->name;

        if ($courseCategory) {
            $courseCategory->delete();

            return redirect()->route('backend.courseCategories.index')->with('success', 'Berhasil menghapus ' . $courseCategoryName . ' kategori!');
        } 

        return redirect()->route('backend.courseCategories.index')->with('failed', 'Gagal menghapus kategori!');
    }
}
