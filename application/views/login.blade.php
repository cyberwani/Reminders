@layout('layout')

@section('content')

	@if ( !Input::get('action') )
		
		<!-- LOGIN -->
		<h2 class="heading">Login <span class="note"><a href="?action=forgot">Forgot your password?</a></span></h2>

		{{ Form::open('login', 'POST', ['class' => 'form-box' ]) }}
			<ul>
				<li>
					{{ Form::label('email', 'Email Address: ') }}
					{{ Form::text('email', Input::old('email')) }}
				</li>

				<li>
					{{ Form::label('password', 'Password: ') }}
					{{ Form::password('password') }}
				</li>
				<li>
					{{ Form::submit('Login', ['class' => 'button' ]) }}
					{{ HTML::link('register', 'or Register') }}
				</li>
			</ul>
		{{ Form::close() }}

	@else

		<!-- FORGOT PASSWORD -->
		<h2 class="heading">Reset Password <span class="note"><a href="/login">Or Login</a></span></h2>

		{{ Form::open('reset', 'POST', ['class' => 'form-box' ]) }}
			<p>Enter your email address, and we'll send you a temporary password.</p>
			<ul>
				<li>
					{{ Form::text('email', Input::old('email')) }}
				</li>
				<li>
					{{ Form::submit('Reset Password', ['class' => 'button' ]) }}
				</li>
			</ul>
		{{ Form::close() }}

	@endif
	
@endsection