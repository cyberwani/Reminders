@if ( Auth::guest() )
	{{ HTML::link('login', 'Login', ['class' => 'button login']) }}
@else
	{{ HTML::link('logout', 'Logout', ['class' => 'button login']) }}
@endif