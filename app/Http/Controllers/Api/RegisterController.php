<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Subdistrict;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function getSubdistrict($id)
    {
    	$subdistrict = Subdistrict::find($id);
    	
    	return response()->json([
    		$subdistrict
    	]);
    }

    public function getProvince($code)
    {
    	$province = Province::where('code', $code)->first();

    	return response()->json([
    		$province
    	]);
    }
}
