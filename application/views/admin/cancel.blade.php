@layout('layout')

@section('content')
	<h2>Are You Sure?</h2>
	<p>Please note that, if you delete your account, all of your reminders will be deleted as well. There is no going back.</p>
	{{ Form::open('admin/cancel', 'POST') }}
		{{ Form::submit('Yes, Cancel My Account', ['class' => 'button']) }}
	{{ Form::close() }}
@endsection