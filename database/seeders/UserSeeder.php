<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
    	$root = new User();
    	$root->role_id = 1;
    	$root->name = 'Root';
    	$root->email = 'root@ips.com';
    	$root->email_verified_at = now();
    	$root->phone_number = '111111111111';
    	$root->password = Hash::make('rootips2020');
    	$root->api_token = Str::random(80);
    	$root->save();

    	$admin = new User();
    	$admin->role_id = 2;
    	$admin->name = 'Admin';
    	$admin->email = 'admin@ips.com';
    	$admin->email_verified_at = now();
    	$admin->phone_number = '222222222222';
    	$admin->password = Hash::make('adminips2020');
    	$admin->api_token = Str::random(80);
    	$admin->save();

    	$member = new User();
    	$member->role_id = 3;
    	$member->name = 'Member';
    	$member->email = 'member@ips.com';
    	$member->email_verified_at = now();
    	$member->phone_number = '333333333333';
    	$member->password = Hash::make('memberips2020');
    	$member->api_token = Str::random(80);
    	$member->save();
    }
}
