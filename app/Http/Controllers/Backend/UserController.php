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
            return redirect()->route('backend.users.index')->with('success', 'Berhasil mendaftarkan ' . $user->first_name . ' ' . $user->last_name . ' sebagai member!');
        } else {
            return redirect()->route('backend.users.index')->with('failed', 'Gagal mendaftarkan ' . $user->first_name . ' ' . $user->last_name . ' sebagai member!');            
        }
    }

    public function show($id)
    {
        $user = User::with([
            'image', 
            'role', 
            'userAddress', 
            'courses',
            'orders'
        ])->where('id', $id)->first();

        return view('backend.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::with('userAddress.subdistrict')->where('id', $id)->first();
        $roles = Role::all();
        $subdistricts = Subdistrict::all();

        return view('backend.users.edit', compact('user', 'roles', 'subdistricts'));
    }

    public function update(Request $request, $id, UserService $userService)
    {
        $updatedUser = $userService->update($request, $id);

        return redirect()->route('backend.users.index')->with('success', 'Berhasil memperbarui data dari ' . $updatedUser->first_name . ' ' . $updatedUser->last_name . '!');            
    }

    public function destroy($id, UserService $userService)
    {
        $deletedUser = User::find($id);    

        if ($userService->destroy($id)) {
            return redirect()->route('backend.users.index')->with('success', 'Berhasil menghapus ' . $deletedUser->first_name . ' ' . $deletedUser->last_name . '!');            
        } else {
            return redirect()->route('backend.users.index')->with('failed', 'Gagal menghapus ' . $deletedUser->first_name . ' ' . $deletedUser->last_name . '!');                        
        }
    }
}
