<?php
class PlaylistsController extends BaseController {

	function _tracks($artistId) {

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
				if ($t->track_number !== 1 && in_array($t->name, $trackNames) === false) {
					$t->release_name = $tl->name;
					$tracks[] = $t;	
					$trackNames[] = $t->name;
				}
			}

		}

		return $tracks;
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

	function export($artistId = false) {
		
		$token = Session::get('user_token');

		if (!$token) {
			Session::put('export_artist_id', $artistId);
			return Redirect::to('/auth/spotify');
		}

		$user = Session::get('user');

		$api = new SpotifyWebAPI\SpotifyWebAPI();
		$api->setAccessToken($token);
		
		$artist = $api->getArtist($artistId);

		// do the playlist create
		$playlistName = "B-sides: ".$artist->name;


		$playlist = $api->createUserPlaylist($user->id, array(
    		'name' => $playlistName
		));	

		$tracks = $this->_tracks($artist->id);
		$trackIds = [];

		foreach ($tracks as $i => $t) {
			$trackIds[] = $t->id;
		}

		$api->addUserPlaylistTracks($user->id, $playlist->id, $trackIds);

		return Redirect::to('/artist/'.$artistId);
	}

}
