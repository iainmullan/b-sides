<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArtistTracks extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		//
		Schema::table('artists', function($table) {
			$table->longtext('default_tracks')->nullable()->after('name');
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
		Schema::table('artists', function($table) {
			$table->dropColumn('default_tracks');
		});

	}

}
