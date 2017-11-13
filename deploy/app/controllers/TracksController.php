<?php
class TracksController extends BaseController {

    function view($trackId = false) {

        $api = $this->_api();

        $track = $api->getTrack($trackId);

//        return Response::json($track);
        return View::make('tracks.view', [
            'track' => $track
        ]);

    }

}
