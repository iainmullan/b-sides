<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>B-sides</title>

	<meta property="fb:admins" content="714655333" />
	<meta property="og:title" content="B-sides | by Iain Mullan" />

	<meta property="og:url" content="http://bsides.iainmullan.com/" />
	<meta property="og:description" content="Generate a Spotify playlist of just an artist's B-sides" />
	<meta property="og:type" content="website" />

	<link rel="stylesheet" href="/css/reset.css" type="text/css" />
	<link rel="stylesheet" href="/css/style.css" type="text/css" />

</head>
<body>

	<header>
		<h1><a href="/">B-Sides</a></h1>
        <div class="current-user">

            @if (Auth::user())
                <span class="username">{{ Auth::user()->spotify_display_name }}</span>
                <span class="prof-pic" style="background-image: url({{ Auth::user()->spotify_profile_image }});">
                </span>
                <a href="/auth/logout">Logout</a>
            @else
                <a href="/auth/spotify">
                    <img src="/img/log_in-desktop-medium.png" />
                </a>
            @endif

        </div>
		@if ($artistName)
			@include('elements.search', array('value' => @$artistName))
		@endif
	</header>

	<main>
		@yield('content')
	</main>

	<footer>
		by <a href="http://iainmullan.com">Iain Mullan</a>
		with the help of <a href="https://developer.spotify.com/" target="_blank">the Spotify API</a>
		<br/>
		<a class="twitter-follow-button"
          href="https://twitter.com/iainmullan"
          data-size="small"
          data-width="178"
          data-show-count="false"
          data-lang="en">Follow @iainmullan</a>

	</footer>

	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="/js/bsides.min.js"></script>

    <script type="text/javascript">
    window.twttr = (function (d, s, id) {
      var t, js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src= "https://platform.twitter.com/widgets.js";
      fjs.parentNode.insertBefore(js, fjs);
      return window.twttr || (t = { _e: [], ready: function (f) { t._e.push(f) } });
    }(document, "script", "twitter-wjs"));
    </script>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-323014-42', 'auto');
	  ga('send', 'pageview');
	</script>
</body>
</html>
