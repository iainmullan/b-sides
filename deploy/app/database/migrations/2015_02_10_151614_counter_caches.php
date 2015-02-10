<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CounterCaches extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('artists', function($table) {
			$table->integer('playlist_count')->after('name')->default(0);
		});
		Schema::table('users', function($table) {
			$table->integer('playlist_count')->after('id')->default(0);
		});

		DB::statement('UPDATE artists SET playlist_count=(select count(id) from playlists where artist_id=artists.id);');
		DB::statement('UPDATE users SET playlist_count=(select count(id) from playlists where user_id=users.id);');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::table('artists', function($table) {
			$table->dropColumn('playlist_count');
		});
		Schema::table('users', function($table) {
			$table->dropColumn('playlist_count');
		});
	}

}
