@layout('layout')

@section('content')
	
	<h2 class="heading">Reminder: {{ $reminder->title }} </h2>

	{{ Form::open($reminder->id, 'DELETE', ['class' => 'verb']) }}
		{{ Form::submit('X', ['class' => 'delete hover-btn']) }}
	{{ Form::close() }}

	{{ Form::open("$reminder->id", 'PUT', ['class' => 'form-box' ])}}
		<ul>
			<li>
				{{ Form::label('title', 'Subject') }}
				{{ Form::text('title', $reminder->title) }}
			</li>
			<li>
				{{ Form::label('message', 'Email Body') }}
				{{ Form::textarea('message', $reminder->message) }}
			</li>
		    <li> 
		    	{{ Form::label('send-date', 'This reminder will be emailed to you on:') }}
		    	{{ Form::date('send-date', date('Y-m-d', strtotime($reminder->send_date))) }}
		    </li> 
		    <li>
		    	{{ Form::submit('Update', ['class' => 'button']) }}
		    	{{ HTML::link('dashboard', 'Cancel', ['class' => 'button']) }}
		    </li>
	    </ul>
	{{ Form::close() }}
@endsection