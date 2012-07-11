<?php

class Add_Activation_Info_To_Users {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table) {
			$table->string('activation_code');
			$table->boolean('enabled')->default(0);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($table) {
			$table->drop_column(array('activation_code', 'enabled'));
		});
	}

}