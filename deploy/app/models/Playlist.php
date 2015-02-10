<?php
class Playlist extends Eloquent
{

    var $fillable = [
        'spotify_id',
        'user_id',
        'artist_id',
        'name',
        'track_ids'
    ];

    function artist() {
        return $this->belongsTo('Artist');
    }

    function user() {
        return $this->belongsTo('User');
    }

}

Playlist::saved(function($playlist) {
    $playlist->artist->updatePlaylistCount();
    $playlist->user->updatePlaylistCount();
});

Playlist::deleted(function($artist) {
    $playlist->artist->updatePlaylistCount();
    $playlist->user->updatePlaylistCount();
});
