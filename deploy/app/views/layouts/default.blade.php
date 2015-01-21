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
		}

		h1 a {
			text-decoration:none;
		}

		h2 {
			font-size: 32px;
			line-height: 40px;
		}

		#playlist header {
			border-top: 1px solid #eee;
		}

		#playlist header * {
			display: inline-block;
		}
		#playlist header .export {
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

	  ga('create', 'UA-323014-42', 'auto');
	  ga('send', 'pageview');
	</script>
</body>
</html>
