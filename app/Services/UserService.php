<?php 

namespace App\Services;

use App\Models\Image;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
	public function create($request)
	{
		$user = new User();
		$user->role_id = $request->role_id;
		$user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->email = $request->email;
		$user->phone_number = $request->phone_number;
		$user->password = Hash::make($request->password);
		$user->save();

		$this->updateOrCreateUserAddress($request, $user->id);	

		return $user;
	}

	public function update($request, $userId)
	{
		$user = User::find($userId);
		if ($request->role_id) $user->role_id = $request->role_id;
		$user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		if ($request->phone_number) $user->phone_number = $request->phone_number;
		if ($request->password) $this->changePassword($request, $user);
		$user->save();

		if ($request->address && $request->subdistrict_id) $this->updateOrCreateUserAddress($request, $user->id);

		if ($request->hasFile('avatar')) $this->updateOrCreateAvatar($request, $user);

		return $user;
	}

	public function destroy($id)
	{
		$user = User::find($id);

		if ($user) {
			$user->delete();

			return true;
		} 

		return false;
	}

	public function changePassword($request, $user)
	{
		$user->password = Hash::make($request->password);
		$user->save();
	}

	public function validateChangePassword($request, $user)
	{
		if (Hash::check($request->current_password, $user->password)) {
    		if ($request->password == $request->confirm_password) {
    			return true;
    		} else {
    			return false;
    		}
    	}
    	else {
    		return false;	
    	}
	}

	private function updateOrCreateAvatar($request, $user)
	{
        $avatar = $request->file('avatar');
		if ($user->image) {
			Storage::delete($user->image->url);
				
			$user->image()->delete();				
		}

        $imageExtension = $avatar->guessExtension();
        $imageName = $user->id . '-' . $user->first_name . '.' . $imageExtension; 
        $imageUrl = Storage::putFileAs('user-avatars', $avatar, $imageName);

        $user->image()->save(
        	Image::make(['url' => $imageUrl])
        );
	}

	private function updateOrCreateUserAddress($request, $userId)
	{
		$user = User::find($userId);

		$userAddress = UserAddress::updateOrCreate(
			['user_id' => $user->id],
			['address' => $request->address, 'subdistrict_id' => $request->subdistrict_id]
		);

		return $userAddress;
	}
}