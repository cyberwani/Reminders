@layout('layout')

@section('content')
<h2 class="heading"> Your Reminder List</h2>
			<ol>
			@foreach ($reminders as $r)
				<li>
					<span class="date"> {{ date('m-d', strtotime($r->send_date)) }} </span>
					<span class="body"> {{ HTML::link("{$r->id}", $r->title) }} </span>
					{{ Form::open("$r->id", "DELETE", ['class' => 'verb']) }}
						{{ Form::submit('D') }}
					{{ Form::close() }}
				</li>
			@endforeach
			</ol>
@endsection