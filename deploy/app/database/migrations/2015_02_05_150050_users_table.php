<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('users', function($table) {

			$table->increments('id');

			$table->string('spotify_id');
			$table->string('spotify_display_name');
			$table->string('spotify_profile_image');
			$table->string('spotify_country');
			$table->string('spotify_product');
			$table->text('spotify_access_token');

			$table->timestamps();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('users');

	}

}
