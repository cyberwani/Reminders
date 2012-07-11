<?php

class Change_Reminders_Table_User_Id_Column_Type {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('reminders', function($table) {
			$table->drop_column('user_id');
		});

		Schema::table('reminders', function($table) {
			$table->integer('user_id');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('reminders', function($table) {
			$table->drop_column('user_id');
		});

		Schema::table('reminders', function($table) {
			$table->string('user_id');
		});
	}

}