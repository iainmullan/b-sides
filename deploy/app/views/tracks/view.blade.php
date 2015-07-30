@extends('layouts.default')

@section('content')

<div class="view track">

    <div class="artwork">
        <img src="{{ $track->album->images[1]->url }}" />
    </div>

    <div class="details">
        <h2>{{ $track->name }}</h2>
        <h3>{{ link_to('/artist/'.$track->artists[0]->id, $track->artists[0]->name) }}</h3>
        <h4><span>from</span> {{ $track->album->name }}</h4>
    </div>

</div>

@endsection
