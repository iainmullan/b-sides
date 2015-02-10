@extends('layouts.default')

@section('content')

<div id="home">

	<p class="tagline">Generate a Spotify playlist of just an artist's <a href="http://en.wikipedia.org/wiki/A-side_and_B-side">B-sides</a>.</p>

	@include('elements.search')

    <div id="popular">
        <ul class="playlists">
            @foreach($popular as $p)
                <li><a href="/artist/{{ $p->spotify_id }}/">{{ $p->name }}</a></li>
            @endforeach
        </ul>
    </div>

</div>

@endsection
