@layout('layout')


@section('content')
	<nav class="paper">
		<ul>
			<li class="dashboard">{{ HTML::link('/dashboard', 'Dashboard') }} </li>
			@if ( $reminders )
				<li class="your-reminders">{{ HTML::link('/all', 'All Reminders') }} </li>
			@endif
			<li class="create-reminder">{{ HTML::link('new', 'Create Reminder') }} </li>
			<li class="user-config">{{ HTML::link('admin/config', 'User Settings') }} </li>
		</ul>
	</nav>

	<div class="primary">
		@if ($reminders )
			<div class="paper reminders">
				<h2 class="heading">Upcoming Reminders</h2>
				<ol>
				@foreach ($reminders as $r)
					<li>
						<span class="date"> {{ $r->send_date }} </span>
						<span class="body"> {{ HTML::link("{$r->id}", $r->title) }} </span>
						{{ Form::open("$r->id", "DELETE", ['class' => 'verb']) }}
							{{ Form::submit('D') }}
						{{ Form::close() }}
					</li>
				@endforeach
				</ol>
			</div>
		@endif
	
		<div class="create">
			<h2 class="heading"> New Reminder </h2>

			{{ render('reminders._create_form') }}
		</div>
	</div>
@endsection