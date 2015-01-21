@extends('layouts.default')

@section('content')

<section id="playlist">

	<div class="header">
		<h2>{{ $artist->name }}</h2>
		<a class="export" href="/playlists/export/{{ $artist->id }}">
			<img src="/img/create-playlist-green.png" alt="Create Playlist" height="40px" />
		</a>
	</div>

	<table class="playlist">

		<thead>
			<tr>
				<th>#</th>
				<th>Track name</th>
				<th>Single</th>
			</tr>
		</thead>

			@foreach($tracks as $i => $t)
				@if ($t->track_number !== 1)
					<tr data-track-id="{{ $t->id }}">
						<td class="number">{{ $t->track_number }}</td>
						<td class="track">{{ $t->name }}</td>
						<td class="single">{{ $t->release_name }}</td>
					</tr>
				@endif
			@endforeach


	</table>

@endsection

