<?php
class PlaylistsController extends BaseController {

	function _tracks($artistId) {

		$api = new SpotifyWebAPI\SpotifyWebAPI();

		/*

		GET https://api.spotify.com/v1/artists/{$artistId}/albums?album_type=single

		*/
		$singles = $api->getArtistAlbums($artistId, array('album_type' => array('single')));

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
		$tracks = [];

		foreach($tracklists->albums as $tl) {

			foreach($tl->tracks->items as $i => $t) {
				if ($t->track_number !== 1) {
					$t->release_name = $tl->name;
					$tracks[] = $t;	
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
