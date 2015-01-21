<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>B-sides</title>

	<meta property="fb:admins" content="714655333" />
	<meta property="og:title" content="B-sides | by Iain Mullan" />

	<meta property="og:url" content="http://bsides.iainmullan.com/" />
	<meta property="og:type" content="website" />

	<style>
		@import url(//fonts.googleapis.com/css?family=Lato:400,700,300,300italic);

		body {
			margin:0;
			font-family:'Lato', sans-serif;
			color: #444;
		}

		a, a:visited {
			color: inherit;
		}

		h1 {
			text-align:center;
			font-size: 32px;
			margin: 16px 0 0 0;
			font-weight: 700;
		}

		h1 a {
			text-decoration:none;
		}

		header, main, footer {
			max-width: 960px;
			margin: 0 auto;
			padding: 20px;
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

		#search input {
			padding: 5px 10px;
			height: 40px;
			margin: 10px 0;
		}

		#search input[type=text] {
			font-size: 2em;
			border: 1px solid #ccc;
			width: 75%;
			min-width: 300px;
			max-width: 600px;
		}
		#search input[type=submit] {
			border: none;
			font-size: 1em;
			background: #eee;
		}

		.twitter-follow-button {
			display: block;
			width: 158px;
			margin: 20px auto;
		}

		table.playlist {
			width: 100%;
			font-weight: 300;

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

	  ga('create', 'UA-323014-41', 'auto');
	  ga('send', 'pageview');
	</script>
</body>
</html>
