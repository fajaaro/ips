<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('courses')->get();

        return view('backend.course-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.course-categories.create');
    }

    public function store(Request $request)
    {
        $categoriesName = $request->names;

        foreach ($categoriesName as $name) {
            $category = new Category();
            $category->name = $name;
            $category->save();
        }

        return redirect()->route('backend.course-categories.index')->with('success', 'Berhasil membuat ' . count($categoriesName) . ' kategori!');
    }

    public function edit($id)
    {
        $category = Category::findOrfail($id);

        return view('backend.course-categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrfail($id);
        $category->name = $request->name;
        $category->save();

        return redirect()->route('backend.course-categories.index')->with('success', 'Berhasil memperbarui data kategori!');        
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $categoryName = $category->name;

        $category->delete();

        return redirect()->route('backend.course-categories.index')->with('success', 'Berhasil menghapus ' . $categoryName . ' kategori!');
    }
}
