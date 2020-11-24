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
		$user->name = $request->name;
		$user->email = $request->email;
		$user->phone_number = $request->phone_number;
		$user->password = Hash::make($request->password);
		$user->save();

		$this->storeOrUpdateUserAddress($request, $user->id);	

		return $user;
	}

	public function update($request, $userId)
	{
		$user = User::find($userId);
		$user->role_id = $request->role_id;
		$user->name = $request->name;
		$user->phone_number = $request->phone_number;
		$user->password = Hash::make($request->password);
		$user->save();

		$this->storeOrUpdateUserAddress($request, $user->id);

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

	public function uploadAvatar($request)
	{
        $user = User::find($request->user_id);

		$avatar = $request->file('avatar');
        $imageExtension = $avatar->guessExtension();
        $imageName = $user->id . '-' . $user->name . '.' . $imageExtension; 
        $imagePath = Storage::putFileAs('user-avatars', $avatar, $imageName);
        $imageUrl = Storage::url($imagePath);

        $user->image()->save(
        	Image::make(['url' => $imageUrl])
        );
	}

	private function storeOrUpdateUserAddress($request, $userId)
	{
		$user = User::find($userId);

		if (!$user->userAddress) {
			$userAddress = new UserAddress();
			$userAddress->user_id = $user->id;
			$userAddress->address = $request->address;
			$userAddress->subdistrict_id = $request->subdistrict_id;
			$userAddress->save();

			return $userAddress;			
		} else {
			$userAddress = UserAddress::find($user->userAddress->id);
			$userAddress->address = $request->address;
			$userAddress->subdistrict_id = $request->subdistrict_id;
			$userAddress->save();

			return $userAddress;			
		}
	}
}