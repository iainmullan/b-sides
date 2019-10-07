<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefreshTokens extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('users', function($table) {
            $table->text('spotify_access_token_expires')->after('spotify_access_token')->nullable();
        });

        Schema::table('users', function($table) {
            $table->datetime('spotify_refresh_token')->after('spotify_access_token_expires')->nullable();
        });

    }

    public function down() {
        Schema::table('users', function($table) {
            $table->dropColumn('spotify_refresh_token');
            $table->dropColumn('spotify_access_token_expires');
        });
    }

}

