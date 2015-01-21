<?php

class HomeController extends BaseController {

	public function home() {

		$api = new SpotifyWebAPI\SpotifyWebAPI();

		$artistName = Input::get('artist', "Metallica");

		/*
		GET https://api.spotify.com/v1/search?type=artist&q={$artistName}
		*/
		$results = $api->search($artistName, 'artist');

		$artist = $results->artists->items[0];

		/*

		GET https://api.spotify.com/v1/artists/{$artistId}/albums?album_type=single

		*/
		$singles = $api->getArtistAlbums($artist->id, array('album_type' => array('single')));

		/*
		get full tracklistings for each single
		GET https://api.spotify.com/v1/albums?ids={ids}
		*/
		$ids = [];
		foreach($singles->items as $s) {
			$ids[] = $s->id;
		}

		$tracklists = $api->getAlbums($ids);

		/*
		TODO

		Loop the albums, remove Track 1

		Bonus:: Detect a AA-side!

		*/


		return View::make('playlists/view', [
			'tracklists' => $tracklists->albums
		]);

	}

}
