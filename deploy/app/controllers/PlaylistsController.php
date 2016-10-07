<?php
class PlaylistsController extends BaseController {

	function view($artistId = false) {

		$api = new SpotifyWebAPI\SpotifyWebAPI();

		$artist = $api->getArtist($artistId);

		$localArtist = Artist::where('spotify_id', $artistId)->first();

		if (!$localArtist) {
			$localArtist = Artist::create([
				'spotify_id' => $artistId,
				'name' => $artist->name
			]);
		}

		$tracks = $this->_tracks($artist);

		$existingPlaylist = false;
		if (Auth::user()) {
			$existingPlaylist = Playlist::where('user_id', Auth::user()->id)
				->where('artist_id', $localArtist->id)
				->first();
		}

		return View::make('playlists.view', [
			'artist' => $artist,
			'artistName' => $artist->name,
			'existingPlaylist' => $existingPlaylist,
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
		$spotifyPlaylist = $api->createUserPlaylist($user->spotify_id, array(
    		'name' => $playlistName
		));

		$api->addUserPlaylistTracks($user->spotify_id, $spotifyPlaylist->id, $trackIds);

		$localArtist = Artist::where('spotify_id', $artistId)->first();
		$localPlaylist = Playlist::where('user_id', $user->id)->where('artist_id', $localArtist->id)->first();

		if (!$localPlaylist) {
			$localPlaylist = Playlist::create([
				'name' => $playlistName,
				'track_ids' => json_encode($trackIds),
				'spotify_id' => $spotifyPlaylist->id,
				'user_id' => $user->id,
				'artist_id' => $localArtist->id
			]);
		}

	}

	function _tracks($artistId, $idsOnly = false) {

		$tracks = $this->_remoteTracks($artistId);

		if ($idsOnly) {
			$trackIds = [];

			foreach ($tracks as $i => $t) {
				$trackIds[] = $t->id;
			}

			return $trackIds;
		}

		return $tracks;
	}

	function _remoteTracks($artist) {

		$artistId = $artist->id;

		if ($tracks = Cache::get($artistId)) {
			Log::debug("Reading ".$artist->name." from the cache");
			return json_decode($tracks);
		}

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
			}

			$response = $api->getAlbums($ids);

			$tracklists = array_merge($tracklists, $response->albums);
		}

		/*
		Loop the albums, filter unique tracks

		TODO
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

		Log::debug("Writing ".$artist->name." to the cache");
		Cache::put($artistId, json_encode($tracks), 24 * 60);

		return $tracks;
	}

}
