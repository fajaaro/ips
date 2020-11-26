<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
    	$user = Auth::user();

    	return view('frontend.profiles.index', compact('user'));
    }

    public function edit()
    {
    	$user = Auth::user();

    	return view('frontend.profiles.edit', compact('user'));
    }

    public function update(Request $request, UserService $userService)
    {
    	$user = Auth::user();

        $updatedUser = $userService->update($request, $user->id);

        return redirect()->route('frontend.profiles.index')->with('success', 'Profil berhasil diperbarui!');
    }

    public function changePassword(Request $request, UserService $userService)
    {
    	$user = Auth::user();

    	if ($userService->validateChangePassword($request, $user)) {
	    	$userService->changePassword($request, $user);

	        return redirect()->route('frontend.profiles.index')->with('success', 'Password berhasil diperbarui!');    		
    	} else {
	        return redirect()->route('frontend.profiles.index')->with('failed', 'Password gagal diperbarui!');    		    		
    	}
    }
}
