<?php

class Reminders_Db_Task {
	public function seed()
	{
		DB::query('truncate table reminders');

		Reminder::create([
			'user_id'   => 1,
			'title'     => 'Say Happy B-Day To Joe',
			'message'   => 'Do not forget to buy him a present.',
			'send_date' => '2012/06/30'
		]);

		Reminder::create([
			'user_id'   => 2,
			'title'     => 'Go to store',
			'message'   => 'We need groceries',
			'send_date' => '2012/06/28'
		]);

		Reminder::create([
			'user_id'   => 1,
			'title'     => 'Date night',
			'message'   => 'Buy important present for her.',
			'send_date' => '2012/06/30'
		]);				
	}
}