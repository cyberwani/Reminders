{{ Form::open('dashboard', 'POST', ['class' => 'form-box'] ) }}

	<ul>
		<li>
			{{ Form::label('title', 'Title: ') }}
			{{ Form::text('title', Input::old('title')) }}
			{{ $errors->first('title', '<span class="error">:message</span>') }}
		</li>

		<li>
			{{ Form::label('message', 'Your Reminder: ')}}
			{{ Form::textarea('message', Input::old('message')) }}
			{{ $errors->first('message', '<span class="error">:message</span>') }}
		</li>

		<li>
			{{ Form::label('send-date', 'When Shall We Send It?') }}
			{{ Form::date('send-date') }}
			{{ $errors->first('send-date', '<span class="error">:message</span>') }}			
		</li>

		<li>
			{{ Form::submit('Create Reminder', ['class'=> 'button']) }}
			{{ HTML::link('dashboard', 'or cancel') }}
		</li>
	</ul>
{{ Form::close() }}
