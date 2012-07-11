@layout('layout')

@section('content')
	<h1 class="styled-heading">Are You Sure?</h1>
	<p>Please note that, if you delete your account, all of your reminders will be deleted as well. There is no going back.</p>
	{{ Form::open('admin/cancel', 'POST') }}
		{{ Form::submit('Yes, Cancel My Account', ['class' => 'button']) }}
	{{ Form::close() }}
@endsection