<?php
class AuthController extends BaseController {

	function logout() {
		Session::flush();
	}

	function spotify_login() {

		$session = new SpotifyWebAPI\Session(
			Config::get('bsides.spotify.client_id'),
			Config::get('bsides.spotify.client_secret'),
			url('/auth/spotify/callback')
		);

		$scopes = array(
		    'user-read-private',
		    'playlist-modify-public',
		    'playlist-read-private',
		    'playlist-modify-private'
		);

		$authorizeUrl = $session->getAuthorizeUrl(array(
		    'scope' => $scopes
		));

		return Redirect::to($authorizeUrl);
	}

	function spotify_callback() {

		$session = new SpotifyWebAPI\Session(
			Config::get('bsides.spotify.client_id'),
			Config::get('bsides.spotify.client_secret'),
			url('/auth/spotify/callback')
		);

		$api = new SpotifyWebAPI\SpotifyWebAPI();

		// Request a access token using the code from Spotify
		$session->requestToken($_GET['code']);
		$accessToken = $session->getAccessToken();

		// Set the access token on the API wrapper
		$api->setAccessToken($accessToken);

		$me = $api->me();

		Session::put('user_token', $accessToken);
		Session::put('user', $me);

		if ($artistId = Session::get('export_artist_id')) {
			return Redirect::to('/playlists/export/'.$artistId);
		}

		print_r($me);

	}

}
