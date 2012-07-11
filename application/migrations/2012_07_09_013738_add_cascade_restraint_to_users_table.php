<?php

class Add_Cascade_Restraint_To_Users_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('reminders', function($table) {
			$table->foreign('user_id')->references('id')->on('users')->on_delete('cascade');
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
			$table->drop_foreign('reminders_user_id_foreign');
		});
	}

}