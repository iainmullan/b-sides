<?php

class HomeController extends BaseController {

	public function home() {

		$api = new SpotifyWebAPI\SpotifyWebAPI();

		$artistName = Input::get('artist', false);

		if (!$artistName) {
			return View::make('home');
		}

		/*
		GET https://api.spotify.com/v1/search?type=artist&q={$artistName}
		*/
		$results = $api->search($artistName, 'artist');

		$artist = $results->artists->items[0];

		return Redirect::to('/artist/'.$artist->id);
	}

}
