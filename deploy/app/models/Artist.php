<?php
class Artist extends Eloquent
{

    var $fillable = [
        'spotify_id',
        'name',
        'default_tracks',
        'playlist_count',
    ];

    function playlists() {
        return $this->hasMany('Playlist');
    }

    function updatePlaylistCount()
    {
        $this->playlist_count = $this->playlists->count();
        $this->save();
    }

}
