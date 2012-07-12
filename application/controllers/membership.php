<?php

class Membership_Controller extends Base_Controller {
	public $restful = true;

	public function __construct()
	{
		$this->filter('before', 'registered?')
			 ->only(['login', 'register'])
			 ->on('get');
	}

	public function get_login()
	{
		return View::make('login');
	}

	public function post_login()
	{
		$creds = [
			'username' 	 => Input::get('email'),
			'password'   => Input::get('password'),
			'enabled'	 => 1
		];

		if ( Auth::attempt($creds) ) {
			return Redirect::to('dashboard');
		} else {
			Input::flash();

			// Let's see if they have an account, but haven't activated it.
			unset($creds['enabled']);

			if ( User::where_email_and_enabled(Input::get('email'), 0)->first() ) {
				return Redirect::to('login')->with('flash', 'You have not yet activated your account. Please check your email.');
			} else {
				return Redirect::to('login')->with('flash', 'Hmm - are you sure that you entered the correct credentials?');
			}
		}
	}

	public function get_logout()
	{
		Auth::logout();

		return Redirect::to('login');
	}

	public function get_register()
	{
		return View::make('register');
	}

	/**
	 * Create a new account for the user
	 *
	 * @return Redirection
	 */
	public function post_register()
	{
		// Precaution - just in case user has other account
		if ( Auth::check() ) Auth::logout();

		$user = new User;
		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');
		$user->email = Input::get('email');
		$user->password = Input::get('password');
		$user->activation_code = Str::random(32);
		
		if ( $user->save() ) {
			// If successful, send confirmation/welcome email
			( new Email )->send_signup_confirmation($user);
			return Redirect::to('/')->with('flash', 'Your account has successfully been created! We just need you to click the confirmation link in the email we just sent. Do it now!');
		}

		Input::flash();
		return Redirect::to('register')->with_errors($user->errors);		
	}

	/**
	 * Reset the user's password
	 *
	 * @return Redirection
	 */
	public function post_reset()
	{
		$reset = User::reset_password(Input::get('email'));

		if ( $reset ) {
			return Redirect::to('login')->with('flash', 'Please check your email, and return here with your temporary password.');
		} else {
			return Redirect::back()->with('flash', 'Hmm - we cannot find a user with that email address. Please try again.');
		}
	}


	public function get_activate()
	{
		$activation = Input::get('activation');
		$email = Input::get('email');

		if ( $activation && $email ) {
			// try to get the record from the db
			$user = User::where_activation_code_and_email($activation, $email)->first();

			// if found, set enabled to true
			if ( $user ) {
				$user->enabled = 1;
				$user->save();

				return Redirect::to('login')->with('flash', 'You may now login! Your account is active.');
			} else {
				return Redirect::to('/')->with('flash', 'The activation credentials provided do not match what is stored in the database.');
			}
		} 
	}
}