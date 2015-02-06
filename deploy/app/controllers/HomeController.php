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

		$artists = $results->artists->items;

		if (count($artists) > 1) {

//			return Response::json($artists);

			return View::make('artists.select', ['artists' => $artists]);
		}

		return Redirect::to('/artist/'.$artists[0]->id);
	}

}
