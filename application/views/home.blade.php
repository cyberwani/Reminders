@layout('layout')

@section('banner')
	<div class="banner">
		<div class="inner">
			<p class="slogan">
				An easy way to schedule reminders, which will 
				automatically be emailed to you on the dates that you specify. 
				{{ HTML::link('register', 'Signup!') }}
			</p>
		</div>
	</div>
@endsection

@section('content')

	

	

	<div class="how-it-works cf">
		<div class="steps">
			<h3>{{ HTML::link('register', 'Register') }}</h3>
			<p>Don't worry; it only takes a few seconds.</p>
		</div>

		<div class="steps">
			<h3>Create</h3>
			<p>Begin creating reminders, like for your mother's birthday, 
				or when you need to contact that important client again.</p>
		</div>

		<div class="steps">
			<h3>Forget</h3>
			<p>We'll remember for you, and will send you a reminder the day of.</p>
		</div>
	</div>

@endsection