<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlaylistsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('playlists', function($table) {

			$table->increments('id');

			$table->string('spotify_id');
			$table->string('user_id');
			$table->string('artist_id');
			$table->string('name');

			$table->text('track_ids');

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
		Schema::drop('playlists');
	}

}
