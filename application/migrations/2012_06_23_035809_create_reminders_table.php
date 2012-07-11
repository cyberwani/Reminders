<?php

class Create_Reminders_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reminders', function($table) {
			$table->increments('id');
			$table->string('user_id');

			$table->string('title');
			$table->text('message');
			$table->timestamps();
			$table->date('send_date');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reminders');
	}

}