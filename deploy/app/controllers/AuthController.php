<?php
class AuthController extends BaseController {

	function logout() {
		Session::flush();
		return Redirect::to('/');
	}

	function spotify_login() {

		$session = $this->_session();

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

		$session = $this->_session();

		$api = new SpotifyWebAPI\SpotifyWebAPI();

		// Request a access token using the code from Spotify
		$session->requestAccessToken($_GET['code']);
		$accessToken = $session->getAccessToken();

		// Set the access token on the API wrapper
		$api->setAccessToken($accessToken);

		$me = $api->me();

		$user = User::firstOrCreate(['spotify_id' => $me->id]);

		$img = '';
		if (!empty($me->images)) {
			$img = $me->images[0]->url;
		}

		$user->fill([
			'spotify_display_name' => $me->display_name,
			'spotify_profile_image' => $img,
			'spotify_country' => $me->country,
			'spotify_product' => $me->product,
			'spotify_access_token' => $accessToken,
			'spotify_access_token_expires' => date('Y-m-d H:i:s', $session->getTokenExpiration()),
			'spotify_refresh_token' => $session->getRefreshToken(),
		]);
		$user->save();

		Auth::login($user);

		if ($input = Session::get('input')) {
			return Redirect::to('/playlists/export');
		}

		return Redirect::to('/');
	}

}
