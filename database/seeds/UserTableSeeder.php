<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UserTableSeeder extends Seeder
{

	public function run()
	{
	    DB::table('users')->delete();

	    // Create an admin
	    User::create(array(
	        'role'     => 'admin',
	        'email'    => 'admin@admin.no',
	        'password' => Hash::make('admin'),
	    ));

	    // Create a normal user
	    User::create(array(
	        'role'     => 'user',
	        'email'    => 'user@user.no',
	        'password' => Hash::make('user'),
	    ));
	}

}