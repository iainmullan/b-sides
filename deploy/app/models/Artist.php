<?php
class Artist extends Eloquent
{

    var $fillable = [
        'spotify_id',
        'name',
        'default_tracks'
    ];

}