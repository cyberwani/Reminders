<?php

class Reminder_Controller extends Base_Controller {
	public $reminder;

	public function __construct()
	{
		$this->filter('before', 'auth');

		if ( URI::segment(1) ) {
			$reminder = Reminder::find(URI::segment(1));
			$this->filter('before', 'has_permission', ['reminder' => $reminder])->only(['show'])->on(['GET', 'PUT', 'DELETE']);
			$this->reminder = $reminder;
		}
	}

	public function action_index()
	{
		$data = [];

		$data['reminders'] = 
			User::find(Auth::user()->id)
				->reminders()
				->order_by('send_date', 'asc')
				->take(5)
				->get();

		return View::make('reminders.index', $data);
	}

	public function action_new()
	{
		return View::make('reminders.new');
	}	

	public function action_create()
	{
		$reminder = new Reminder;
		$reminder->title = Input::get('title');
		$reminder->user_id = Auth::user()->id;
		$reminder->message = Input::get('message');
		$reminder->send_date = Input::get('send-date');
		
		if ( !$reminder->save() ) {
			Input::flash();
			return Redirect::back()->with('flash', 'Please fill in all of the fields.');
		}

		return Redirect::to('dashboard')
				->with('flash', 'Your reminder has been scheduled, and will be emailed to you on ' . $reminder->pretty_send_date . '!');
	}

	public function action_all()
	{
		$data = [];
		$data['reminders'] = 
			User::find(Auth::user()->id)
				->reminders()
				->order_by('send_date', 'asc')
				->get();

		return View::make('reminders.all', $data);
	}

	public function action_show($reminder_id)
	{
		return View::make('reminders.show')->with('reminder', $this->reminder);
	}

	public function action_update($reminder_id)
	{
		$this->reminder->title = Input::get('title');
		$this->reminder->message = Input::get('message');
		$this->reminder->send_date = Input::get('send-date');
		
		if ( !$this->reminder->save() ) {
			return Redirect::back()->with('flash', 'Please fill in all of the fields.');
		}

		return Redirect::to('dashboard')->with('flash', 'Your reminder has been updated!');
	}

	public function action_destroy($reminder_id)
	{
		$this->reminder->delete();
		return Redirect::to('dashboard');
	}
}