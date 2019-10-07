<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	var $fillable = [
		'playlist_count',
		'spotify_id',
		'spotify_display_name',
		'spotify_profile_image',
		'spotify_country',
		'spotify_product',
		'spotify_access_token',
		'spotify_access_token_expires',
		'spotify_refresh_token'
	];

	public function playlists()
	{
		return $this->hasMany('Playlist');
	}

    function updatePlaylistCount()
    {
        $this->playlist_count = $this->playlists->count();
        $this->save();
    }

}
