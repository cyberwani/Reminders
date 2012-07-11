<?php

class User extends Aware {
	public static $timestamps = true;

	public static $rules = [
		'first_name' 	  => 'required',
		'last_name' 	  => 'required',
		'email'      	  => 'required|email',
		'password'   	  => 'required|min:4', // |confirmed
		'activation_code' => 'required',
		'enabled'		  => 'required|integer'
	];

	public function reminders()
	{
		return $this->has_many('Reminder');
	}

	public function set_password($pwd)
	{
		$this->set_attribute('password', Hash::make($pwd));
	}

	public function get_full_name()
	{
		return $this->get_attribute('first_name') . ' ' . $this->get_attribute('last_name');
	}

	public static function generate_activation()
	{
		return Str::random(32);
	}

	/**
	 * Resets the password for the supplied email address
	 *
	 * @param string $email
	 * @return Redirection
	 */
	public static function reset_password($email)
	{
		// generate random password
		$temp_password = Str::random(32); // TODO - call method instead

		// update user's password with randomly generated one
		$user = self::where_email($email)->first();
		
		if ( $user ) {
			$user->password = $temp_password;
			$user->save();

			// send email with temp password
			( new Email )->send_creds_reset($user, $temp_password);
			return true;
		}
		
		return false;
	}
}