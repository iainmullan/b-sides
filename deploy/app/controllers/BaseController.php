<?php

class BaseController extends Controller {

	var $api;

	function _api()
	{
		if ($this->api)
		{
			return $this->api;
		}
		$api = new SpotifyWebAPI\SpotifyWebAPI();

		if ($user = Auth::user())
		{
			$token = $user->spotify_access_token;
		} else {
			$token = User::find(1)->spotify_access_token;
		}

		$api->setAccessToken($token);

		$this->api = $api;

		return $this->api;
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
