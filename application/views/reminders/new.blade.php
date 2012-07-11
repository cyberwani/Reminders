@layout('layout')

@section('content')
	<h2 class="heading">Create Reminder</h2>
	{{ render('reminders._create_form'); }}
@endsection