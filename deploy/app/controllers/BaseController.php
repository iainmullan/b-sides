<?php

class BaseController extends Controller {

	var $api;

	function _session() {
		return new SpotifyWebAPI\Session(
			Config::get('bsides.spotify.client_id'),
			Config::get('bsides.spotify.client_secret'),
			url('/auth/spotify/callback')
		);
	}

	function _api()
	{
		if ($this->api)
		{
			return $this->api;
		}

		$api = new SpotifyWebAPI\SpotifyWebAPI();

		if ($user = Auth::user())
		{
			$token = $this->_refreshedToken($user);
		} else {
			$token = $this->_refreshedToken(User::find(1));
		}

		$api->setAccessToken($token);

		$this->api = $api;

		return $this->api;
	}

	function _refreshedToken($user) {

		$now = time();
		$exp = strtotime($user->spotify_access_token_expires);

		if ($exp < $now) {
			$session = $this->_session();
			$session->refreshAccessToken($user->spotify_refresh_token);

			$user->spotify_access_token = $session->getAccessToken();
			$user->spotify_access_token_expires = date('Y-m-d H:i:s', $session->getTokenExpiration());
			$user->spotify_refresh_token = $session->getRefreshToken();

			$user->save();
		}

		return $user->spotify_access_token;
	}


	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
