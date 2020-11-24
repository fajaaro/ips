<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Services\InstructorService;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index()
    {
        $instructors = Instructor::all();

        return view('backend.instructors.index', compact('instructors'));
    }

    public function create()
    {
        return view('backend.instructors.create');
    }

    public function store(Request $request, InstructorService $instructorService)
    {
        $instructor = $instructorService->create($request);

        if ($instructor) {
            return redirect()->route('backend.instructors.index')->with('success', 'Berhasil mendaftarkan ' . $instructor->name . ' sebagai instruktor!');
        } else {
            return redirect()->route('backend.instructors.index')->with('failed', 'Gagal mendaftarkan ' . $instructor->name . ' sebagai instruktor!');            
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $instructor = Instructor::find($id);

        return view('backend.instructors.edit', compact('instructor'));
    }

    public function update(Request $request, $id, InstructorService $instructorService)
    {
        $updatedInstructor = $instructorService->update($request, $id);

        return redirect()->route('backend.instructors.index')->with('success', 'Berhasil memperbarui data dari ' . $updatedInstructor->name . '!');            
    }

    public function destroy($id, InstructorService $instructorService)
    {
        $deletedInstructor = Instructor::find($id);    

        if ($instructorService->destroy($id)) {
            return redirect()->route('backend.instructors.index')->with('success', 'Berhasil menghapus ' . $deletedInstructor->name . '!');            
        } else {
            return redirect()->route('backend.instructors.index')->with('failed', 'Gagal menghapus ' . $deletedInstructor->name . '!');                        
        }
    }
}
