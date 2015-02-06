@extends('layouts.default')

@section('content')

<section id="playlist">

	<form action="/playlists/export" method="POST">

		<input type="hidden" name="artist_id" value="{{ $artist->id }}" />

		<div class="header">
			<h2>
                <span class="prof-pic" style="background-image: url({{ @array_pop($artist->images)->url }});"></span>

				{{ $artist->name }}</h2>
			<input class="export" type="image" src="/img/create-playlist-green.png" alt="Create Playlist" height="40px" />
		</div>

		<p class="tip">
			Customise the track selection below, then click Create Playlist to save in Spotify
		</p>

		<table class="playlist">

			<thead>
				<tr>
					<th></th>
					<th>#</th>
					<th>Track name</th>
					<th>Single</th>
				</tr>
			</thead>

			@foreach($tracks as $i => $t)

				<?php $checked = ""; ?>
				@if ($t->checked)
					<?php $checked = "checked='checked'"; ?>
				@endif

				<tr data-track-id="{{ $t->id }}" class="{{ $t->checked ?: 'unchecked' }}">
					<td class="check"><input type="checkbox" name="track_id[]" value="{{ $t->id }}" {{ $checked }} /></td>
					<td class="number">{{ $t->track_number }}</td>
					<td class="track">{{ $t->name }}</td>
					<td class="single">{{ $t->release_name }}</td>
				</tr>

			@endforeach

		</table>

		<input class="export" type="image" src="/img/create-playlist-green.png" alt="Create Playlist" height="40px" />
	</form>

@endsection

