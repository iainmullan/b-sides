<?php

class HomeController extends BaseController {

	public function home() {

		$api = new SpotifyWebAPI\SpotifyWebAPI();

		$artistName = Input::get('artist', false);

		if ($artistName) {
			/*
			GET https://api.spotify.com/v1/search?type=artist&q={$artistName}
			*/
			$results = $api->search($artistName, 'artist');

			$artists = $results->artists->items;

			if (count($artists) > 1) {
				return View::make('artists.select', ['artists' => $artists]);
			} else if (count($artists) > 0) {
				return Redirect::to('/artist/'.$artists[0]->id);
			}
		}

		$popular = Artist::orderBy('playlist_count', 'DESC')->limit(5)->get();

		return View::make('home', [
			'popular' => $popular
		]);

	}

}
