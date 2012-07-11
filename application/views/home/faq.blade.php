@layout('layout')

@section('content')
	<h2 class="styled-heading">Frequently Asked Questions</h2>

	<dl>
		<dt>Is Remindme free?</dt>
		<dd>Of course it is!</dd>

		<dt>What sort of reminders should I set?</dt>
		<dd>
			All sorts of things. Maybe you told a client that you would check in with them
			again in two weeks. Set a reminder for that date, and forget about it! Or maybe
			you need to set a reminder to buy your wife flowers a few days before your anniversary.
			 Think of this site as your personal digital secretary. "In two weeks, remind me to...".
		</dd>

		<dt>Why not use a simple todo app?</dt>
		<dd>You certainly can, and I do! However, for irregular events, I've found that
			email reminders work better. I don't always open my todo list, but email is always open.</dd>

		<dt>Can you see my email reminders?</dt>
		<dd>All reminder messages are encrypted within the database. Only you can see them.</dd>

		<dt>I didn't receive my reminder?</dt>
		<dd>Have you checked your spam folder? It's possible that they might have been sent there.</dd>

		<dt>Who are you?</dt>
		<dd>RemindMe was created by me: <a href="http://jeffrey-way.com">Jeffrey Way</a>, as part of a special course that 
			teaches folks how to create a web application from scratch. </dd>

		<dt>What technologies were used to build this app?</dt>
		<dd>PHP, Laravel, MySQL, Sass, and PHPFog.</dd>
	</dl>
@endsection