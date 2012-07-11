<?php

class Admin_Controller extends Base_Controller {
	public $restful = true;

	public function __construct()
	{
		$this->filter('before', 'auth');
	}

	public function get_index()
	{
		// TODO
		return 'User Config';
	}

	public function get_config()
	{
		return View::make('admin.config')->with('user', Auth::user());
	}

	public function post_config()
	{
		$user = User::find(Auth::user()->id);
		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');
		$user->email = Input::get('email');
		$user->password = Input::get('password');

		if ( !$user->save() ) {
			return Redirect::to('admin/config')->with_errors($user->errors);
		}
		
		return Redirect::to('admin/config')->with('flash', 'Your configuration options have been updated.');
	}

	public function get_cancel()
	{
		return View::make('admin.cancel');
	}

	public function post_cancel()
	{
		// delete user from db - along with all their reminders
		User::find(Auth::user()->id)->delete();

		// logout
		Auth::logout();

		// direct to home page
		return Redirect::to('/')->with('flash', 'Your account has been successfully deleted.');
	}
}