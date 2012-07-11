@layout('layout')

@section('content')
	<h2 class="heading">Config <span class="note">{{ HTML::link('admin/cancel', 'Want to Cancel?') }}</span></h2>

	{{ Form::open('admin/config', 'POST', ['class' => 'form-box short-form']) }}
		<ul>
			<li>
				{{ Form::label('first_name', 'First Name') }}
				{{ Form::text('first_name', $user->first_name) }}
				{{ $errors->first('first_name', '<span class="error">:message</span>') }}
			</li>

			<li>
				{{ Form::label('last_name', 'Last Name') }}
				{{ Form::text('last_name', $user->last_name) }}
				{{ $errors->first('last_name', '<span class="error">:message</span>') }}
			</li>

			<li>
				{{ Form::label('email', 'Email Address') }}
				{{ Form::text('email', $user->email) }}
				{{ $errors->first('email', '<span class="error">:message</span>') }}
			</li>

			<li>
				{{ Form::label('password', 'Change Password') }}
				{{ Form::password('password') }}
				{{ $errors->first('password', '<span class="error">:message</span>') }}
			</li>

		<!-- 	<li>
				{{ Form::label('password_confirmation', 'Confirm Password') }}
				{{ Form::password('password_confirmation') }}
			</li> -->

			<li>
				{{ Form::submit('Update Profile', ['class' => 'button']) }}
				{{ HTML::link('dashboard', 'Go back') }}
			</li>
		</ul>
	{{ Form::close() }}

@endsection