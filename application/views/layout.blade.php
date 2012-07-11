<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>RemindMe</title>
	{{ HTML::style('http://fonts.googleapis.com/css?family=Swanky+and+Moo+Moo') }}
	{{ HTML::style('css/style.css') }}
	{{ HTML::style('css/ui-lightness/jquery-ui-1.8.21.custom.css') }}
</head>
<body>

	@if ( Session::has('flash') )
		<div class="flash hide">{{ Session::get('flash') }}</div>
	@endif

	<div class="header-wrap">
		<header class="container">
			<h1 class="cf"> {{ HTML::link('dashboard', 'Remindme', ['class' => 'ir logo']) }} </h1>
			<h2>Email Reminders in Seconds</h2>

			{{ render('_login_button') }}
		</header>
	</div>

	@yield('banner')

	<div class="container">
		@yield('content')
	</div>

	<footer>
		<div class="inner">
			<ul class="horiz">
				<li> {{ HTML::link('login', 'Login') }}</li>
				<li> {{ HTML::link('about', 'About') }} </li>
				<li> {{ HTML::link('faq', 'FAQ') }} </li>
				<li class="right author">Created By <a href="http://jeffrey-way.com">Jeffrey Way</a></li>
			</ul>
			<a href="/">{{ HTML::image('img/logo.png', 'RemindMe', ['class' => 'right footer-logo']) }}</a>
		</div>
	</footer>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	{{ HTML::script('js/jquery-ui-custom.js') }}

	<script>
	function hidePanel(elem, interval) {
		interval || ( interval = 300 );
		if ( elem[0] ) {
			setTimeout(function() {
				elem.slideUp(interval);
			}, 2500);
		}
	}

	(function() {
		// Flash Messages
		var success = $('div.flash').slideDown(300);
		hidePanel(success);

		

		// Date Pickers
		function supports_input(name) {
			var elem = document.createElement('input');
			elem.setAttribute('type', name);

			return elem.type === name;
		}

		if ( !supports_input('date') ) {

			$('input[type=date]').datepicker({
				dateFormat: 'yy-m-d',
				minDate: +1
			});
		}
	})();
	</script>

</body>
</html>