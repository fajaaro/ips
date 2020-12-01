<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('courses')->get();

        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    public function store(Request $request)
    {
        $categoriesName = $request->names;

        foreach ($categoriesName as $name) {
            $category = new Category();
            $category->name = $name;
            $category->save();
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
        $category = Category::find($id);
        $categoryName = $category->name;

        if ($category) {
            $category->delete();

            return redirect()->route('backend.courseCategories.index')->with('success', 'Berhasil menghapus ' . $categoryName . ' kategori!');
        } 

        return redirect()->route('backend.courseCategories.index')->with('failed', 'Gagal menghapus kategori!');
    }
}
