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

	<style>
		@import url(//fonts.googleapis.com/css?family=Lato:400,700,300,300italic);
		@import url(//fonts.googleapis.com/css?family=Open+Sans:400,700,300,300italic);

		body {
			margin:0;
			color: #444;
			font-family: 'Open Sans';
		}

		a, a:visited {
			color: inherit;
		}
		header {
			font-family:'Lato', sans-serif;	
		}
		h1 {
			font-size: 60px;
			margin: 10px 0 0 0;
			font-weight: 400;
			letter-spacing: 0.04em;
			display: inline-block;
		}

		h1 a {
			text-decoration:none;
		}

		h2 {
			font-size: 32px;
			line-height: 40px;
		}

		header {
			border-bottom: 1px solid #eee;
		}

		#playlist .header {
			padding: 20px 0;
		}

		#playlist .header * {
			display: inline-block;
		}
		#playlist .header .export {
			float:right;
		}

		header, main, footer {
			max-width: 960px;
			margin: 0 auto;
			padding: 20px 0;
		}

		#search, footer {
			text-align: center;
		}
		footer {
			margin-top: 100px;
		}

		p.tagline {
			text-align:center;
			margin: 30px 0;
		}

		header #search {
			float:right;
			margin-top: 35px;
		}

		#home #search {
			text-align: center;
		}

		#search input {
			padding: 5px 10px;
			height: 20px;
			display: inline-block;
			vertical-align: top;
			font-size: 16px;
		}

		#search input[type=text] {
			border: 1px solid #ccc;
			width: 300px;
			color: #777;
		}
		#search input[type=submit] {
			border: none;
			background: #eee;
			height: 32px;
		}

		.twitter-follow-button {
			display: block;
			width: 158px;
			margin: 20px auto;
		}

		table.playlist {
			width: 100%;
			font-weight: 300;
			border-collapse: separate;
			border-spacing: 2px;
		}

		table.playlist th,
		table.playlist td {
			padding: 5px 10px;
		}
		table.playlist td {
			background: #efe;
		}
		table.playlist th {
			text-align: left;
			background: #ded;
		}
		table.playlist td.single {
			font-style: italic;
		}

	</style>
</head>
<body>

	<header>
		<h1><a href="/">B-Sides</a></h1>
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
