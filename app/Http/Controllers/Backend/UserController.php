<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Subdistrict;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $query = User::with('courses')
                    ->join('roles', 'users.role_id', '=', 'roles.id')
                    ->select('users.*', 'roles.name as role_name');
        
        if ($user->inRole('admin')) {
            $query->where('users.role_id', '>', '2');
        }

        $users = $query->get();

        return view('backend.users.index', compact('users'));
    }

    public function create()
    {
        $subdistricts = Subdistrict::all();

        return view('backend.users.create', compact('subdistricts'));
    }

    public function store(Request $request, UserService $userService)
    {
        $user = $userService->create($request);

        if ($user) {
            return redirect()->route('backend.users.index')->with('success', 'Berhasil mendaftarkan ' . $user->name . ' sebagai member!');
        } else {
            return redirect()->route('backend.users.index')->with('failed', 'Gagal mendaftarkan ' . $user->name . ' sebagai member!');            
        }
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
        $user = User::with('userAddress.subdistrict')->where('id', $id)->first();
        $roles = Role::all();
        $subdistricts = Subdistrict::all();

        return view('backend.users.edit', compact('user', 'roles', 'subdistricts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, UserService $userService)
    {
        $updatedUser = $userService->update($request, $id);

        return redirect()->route('backend.users.index')->with('success', 'Berhasil memperbarui data dari ' . $updatedUser->name . '!');            
    }

    public function destroy($id, UserService $userService)
    {
        $deletedUser = User::find($id);    

        if ($userService->destroy($id)) {
            return redirect()->route('backend.users.index')->with('success', 'Berhasil menghapus ' . $deletedUser->name . '!');            
        } else {
            return redirect()->route('backend.users.index')->with('failed', 'Gagal menghapus ' . $deletedUser->name . '!');                        
        }
    }
}
