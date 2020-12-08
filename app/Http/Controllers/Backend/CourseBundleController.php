<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Bundle;
use App\Models\Course;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CourseBundleController extends Controller
{
    public function index()
    {
        $bundles = Bundle::with([
        	'courses',
        	'orders.user'
        ])->get();

        return view('backend.course-bundles.index', compact('bundles'));
    }

    public function create()
    {
        return view('backend.course-bundles.create');
    }

    public function store(Request $request)
    {
        $bundlesName = $request->names;
        $bundlesPrice = $request->prices;

        $i = 0;
        foreach ($bundlesName as $name) {
            $bundle = new Bundle();
            $bundle->name = $name;
            $bundle->price = $bundlesPrice[$i];
            $bundle->save();

            $i++;
        }

        return redirect()->route('backend.course-bundles.index')->with('success', 'Berhasil membuat ' . count($bundlesName) . ' kategori!');
    }

    public function edit($id)
    {
        $bundle = Bundle::findOrfail($id);

        return view('backend.course-bundles.edit', compact('bundle'));
    }

    public function update(Request $request, $id)
    {
        $bundle = Bundle::findOrfail($id);
        $bundle->name = $request->name;
        $bundle->price = $request->price;
        $bundle->save();

        return redirect()->route('backend.course-bundles.index')->with('success', 'Berhasil memperbarui data kategori!');        
    }

    public function destroy($id)
    {
        $bundle = Bundle::find($id);
        $bundleName = $bundle->name;

        $bundle->delete();

        return redirect()->route('backend.course-bundles.index')->with('success', 'Berhasil menghapus ' . $bundleName . ' kategori!');
    }

    public function editCourse($id)
    {
    	$bundle = Bundle::with('courses')->where('id', $id)->first();
    	$courses = Course::all();

    	return view('backend.course-bundles.edit-course', compact('bundle', 'courses'));
    }

    public function updateCourse(Request $request, $id)
    {
    	$bundle = Bundle::find($id);

    	$bundle->courses()->detach();
		$bundle->courses()->attach($request->courses_id);

        return redirect()->route('backend.course-bundles.index')->with('success', 'Berhasil memperbarui course di bundle ' . $bundle->name . '!');
    }
}
