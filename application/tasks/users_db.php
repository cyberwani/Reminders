<?php

class Users_Db_Task {
	public function seed()
	{
		//DB::query('truncate table users');

		User::create([
			'first_name' => 'Jeffrey',
			'last_name'  => 'Way',
			'email'		 => 'jeffrey@envato.com',
			'password'   => '1234',
			'activation_code' => User::generate_activation(),
			'enabled'    => 1

		]);

		User::create([
			'first_name' => 'Allison',
			'last_name'  => 'Peterson',
			'email'		 => 'wayallie@gmail.com',
			'password'   => '1234',
			'activation_code' => User::generate_activation(),
			'enabled'    => 1
		]);
	}
}