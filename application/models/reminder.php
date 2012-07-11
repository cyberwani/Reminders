<?php

class Reminder extends Aware {
	public static $timestamps = true;

	public static $rules = [
		'title' 	=> 'required',
		'message' 	=> 'required',
		'send_date'	=> 'required',
		'user_id'   => 'required'
	];

	public function user()
	{
		return $this->belongs_to('User');
	}

	public function get_send_date($style = 'M d')
	{
		return date("$style", strtotime($this->get_attribute('send_date')));
	}

	public function get_pretty_send_date()
	{
		return $this->get_send_date('F jS');
	}

	public function set_message($message)
	{
		$this->set_attribute('message', Crypter::encrypt($message));
	}

	public function get_message()
	{
		return Crypter::decrypt($this->get_attribute('message'));
	}


	/**
	 * Fetch all reminders that are scheduled to be sent today.
	 *
	 * @return array
	 */		
	public static function find_todays_reminders()
	{
		// Get all of today's reminders
		// TODO - Use Eloquent
		return DB::query('SELECT reminders.id, title, message, email, users.first_name, users.last_name  
						  FROM reminders 
						  INNER JOIN users
						  ON reminders.user_id = users.id 
						  WHERE DATE(send_date) = CURRENT_DATE()');
	}


	/**
	 * Filter through a set of reminders, and send notifications.
	 *
	 * @param array $reminders
	 * @return string
	 */	
	public static function notify($reminders)
	{
		if ( !empty($reminders) ) {
			$email = new Email;
			foreach($reminders as $reminder) {
				$email->send_reminder($reminder);
				Reminder::find($reminder->id)->delete();
			}
			return 'Messages have been sent.';
		}
		return 'No reminders today.';
	}
}