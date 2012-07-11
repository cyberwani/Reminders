@layout('layout')

@section('content')
	<h2 class="heading">Register <span class="note">Don't worry; it's fast!</span></h2>

	{{ Form::open('register', 'POST', ['class' => 'form-box short-form']) }}
		<ul>
			<li>
				{{ Form::text('first_name', Input::old('first_name'), ['placeholder' => 'First Name']) }}
				{{ $errors->first('first_name', '<span class="error">:message</span>') }}
			</li>
			<li>
				{{ Form::text('last_name', Input::old('last_name'), ['placeholder' => 'Last Name']) }}
				{{ $errors->first('last_name', '<span class="error">:message</span>') }}
			</li>
			<li>
				{{ Form::text('email', Input::old('email'), ['placeholder' => 'Email Address']) }}
				{{ $errors->first('email', '<span class="error">:message</span>') }}				
			</li>
			<li>
				{{ Form::password('password', ['placeholder' => 'Password']) }}
				{{ $errors->first('password', '<span class="error">:message</span>') }}
			</li>
<!-- 			<li>
				{{ Form::password('password_confirmation', ['placeholder' => 'Confirm Password']) }}
				{{ $errors->first('password_confirmation', '<span class="error">:message</span>') }}
			</li> -->

			<li> 
				{{ Form::submit('Register', ['class' => 'button']) }}
				{{ HTML::link('login', 'or Login') }}
		</ul>
	{{ Form::close() }}
@endsection