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

}