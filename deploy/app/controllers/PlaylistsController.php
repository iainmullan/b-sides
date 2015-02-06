<?php
class PlaylistsController extends BaseController {

	function artists() {

	}

	function view($artistId = false) {

		$api = new SpotifyWebAPI\SpotifyWebAPI();

		$artist = $api->getArtist($artistId);


		$tracks = $this->_tracks($artist->id);

		return View::make('playlists.view', [
			'artist' => $artist,
			'artistName' => $artist->name,
			'tracks' => $tracks
		]);

	}

	function export_tracks() {

		$input = Input::only('artist_id', 'track_id');

		$token = Session::get('user_token');
		if (!$token) {
			Session::put('input', $input);
			return Redirect::to('/auth/spotify');
		}

		$artistId = $input['artist_id'];
		$trackIds = $input['track_id'];

		$this->_create($artistId, $trackIds);

		return Redirect::to('/artist/'.$artistId);
	}

	function export_postlogin() {

		$input = Session::pull('input');

		$artistId = $input['artist_id'];
		$trackIds = $input['track_id'];

		$this->_create($artistId, $trackIds);

		return Redirect::to('/artist/'.$artistId);
	}

	function _create($artistId, $trackIds) {

		$user = Auth::user();
		$token = $user->spotify_access_token;

		$api = new SpotifyWebAPI\SpotifyWebAPI();
		$api->setAccessToken($token);

		$artist = $api->getArtist($artistId);

		$playlistName = "B-sides: ".$artist->name;

		// do the playlist create
		$playlist = $api->createUserPlaylist($user->spotify_id, array(
    		'name' => $playlistName
		));

		$api->addUserPlaylistTracks($user->spotify_id, $playlist->id, $trackIds);

	}

	function _tracks($artistId, $idsOnly = false) {

		$api = new SpotifyWebAPI\SpotifyWebAPI();

		/*

		GET https://api.spotify.com/v1/artists/{$artistId}/albums?album_type=single

		*/

		$next = true;
		$singles = [];
		$limit = 50;
		$offset = 0;
		while ($next !== null) {

			$singlesPage = $api->getArtistAlbums($artistId, [
				'market' => 'GB',
				'album_type' => array('single'),
				'limit' => $limit,
				'offset' => $offset
			]);

			Log::debug('Total of '.$singlesPage->total);

			$singles = array_merge($singles, $singlesPage->items);

			$next = $singlesPage->next;
			$offset += $limit;
		}

		/*
		get full tracklistings for each single
		GET https://api.spotify.com/v1/albums?ids={ids}
		*/

		// multi-album call accepts max 20
		$chunks = array_chunk($singles, 20);

		$tracklists = [];

		foreach($chunks as $c) {

			$ids = [];
			foreach($c as $s) {
				$ids[] = $s->id;
				Log::debug($s->id.' = '.$s->name);
			}

			$response = $api->getAlbums($ids);

			$tracklists = array_merge($tracklists, $response->albums);
		}

		/*
		TODO

		Loop the albums, remove Track 1

		Bonus:: Detect a AA-side!

		*/
		$tracks = [];

		$trackNames = [];

		foreach($tracklists as $tl) {

			foreach($tl->tracks->items as $i => $t) {

				if (in_array($t->name, $trackNames) === false) {

					if ($t->track_number == 1) {
						$t->checked = false;
					} else {
						$t->checked = true;
					}

					$t->release_name = $tl->name;
					$tracks[] = $t;
					$trackNames[] = $t->name;

				}


			}

		}

		if ($idsOnly) {
			$trackIds = [];

			foreach ($tracks as $i => $t) {
				$trackIds[] = $t->id;
			}

			return $trackIds;
		}

		return $tracks;
	}

}
