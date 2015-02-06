@extends('layouts.default')

@section('content')

<div id="artist-select">

    <p class="tip">Multiple artists found, select one below...</p>

    <ul class="artists">
        @foreach($artists as $a)
            <li>
                <span class="prof-pic" style="background-image: url({{ @array_pop($a->images)->url }});"></span>
                <a href="/artist/{{ $a->id }}">{{ $a->name }}</a>
            </li>
        @endforeach
    </ul>

</div>

@endsection
