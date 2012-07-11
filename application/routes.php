<?php

/*
|--------------------------------------------------------------------------
| Home / Membership
|--------------------------------------------------------------------------
*/

Route::controller('home');
Route::get('faq', 'home@faq');
Route::get('about', 'home@about');

Route::get('login', 'membership@login');
Route::post('login', 'membership@login');
Route::get('logout', 'membership@logout');
Route::get('register', 'membership@register');
Route::post('register', 'membership@register');
Route::post('reset', 'membership@reset');
Route::get('activate', 'membership@activate');



/*
|--------------------------------------------------------------------------
| Reminders
|--------------------------------------------------------------------------
*/

Route::get('dashboard', 'reminder@index');
Route::post('dashboard', 'reminder@create');
Route::get('all', 'reminder@all');
Route::get('(:num)', 'reminder@show');
Route::put('(:num)', 'reminder@update');
Route::get('new', 'reminder@new');
Route::delete('(:num)', 'reminder@destroy');


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::controller('admin');


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/
// Route::get('login', ['before' => 'registered?', function()
// {
// 	return View::make('login');
// }]);

// Route::get('logout', function() {
// 	Auth::logout();
// 	return Redirect::to('login');
// });

// Route::post('login', function() {
// 	$email = Input::get('email');
// 	$password = Input::get('password');

// 	// Otherwise, logging in.
// 	if ( Auth::attempt(['username' => $email, 'password' => $password]) ) {
// 		return Redirect::to('dashboard');
// 	} else {
// 		return Redirect::to('login')->with('login_errors', true);
// 	}
// });


/*
|--------------------------------------------------------------------------
| Registration
|--------------------------------------------------------------------------
*/
// Route::get('register', ['before' => 'registered?', function() {
// 	return View::make('register');
// }]);

// Route::post('register', function() {
// 	// Validate
// 	$validation = Validator::make(Input::all(), User::$rules);

// 	if ( $validation->fails() ) {
// 		Input::flash();
// 		return Redirect::to('register')->with_errors($validation);
// 	}

// 	$user = new User;
// 	$user->first_name = Input::get('first_name');
// 	$user->last_name = Input::get('last_name');
// 	$user->email = Input::get('email');
// 	$user->password = Input::get('password');
	
// 	if ( $user->save() ) {
// 		// If successful, send confirmation/welcome email
// 		// TODO - The user should confirm their signup. Add activation code.
// 		//( new Email )->send_signup_confirmation($user);

// 		return Redirect::to('dashboard')->with('flash', 'Your account has successfully been created! Go ahead and schedule your first reminder.');
// 	} else {
// 		return Redirect::to('register')->with('flash', "I'm sorry; I wasn't able to create your account at this time. Please try again later.");
// 	}
// });



// Route::group(['before' => 'auth'], function() {
	/*
	|--------------------------------------------------------------------------
	| Dashboard
	|--------------------------------------------------------------------------
	*/
	// Route::get('dashboard', function() {
	// 	$data = [];

	// 	$data['reminders'] = 
	// 		User::find(Auth::user()->id)
	// 			->reminders()
	// 			->order_by('send_date', 'asc')
	// 			->take(5)
	// 			->get();

	// 	return View::make('reminders.index', $data);
	// });



	/*
	|--------------------------------------------------------------------------
	| All Reminders
	|--------------------------------------------------------------------------
	*/
	// Route::get('all', function() {
	// 	$data = [];
	// 	$data['reminders'] = 
	// 		User::find(Auth::user()->id)
	// 			->reminders()
	// 			->order_by('send_date', 'asc')
	// 			->get();

	// 	return View::make('reminders.all', $data);
	// });



	/*
	|--------------------------------------------------------------------------
	| Create Reminders
	|--------------------------------------------------------------------------
	*/
	// Route::get('new', function() {
	// 	return View::make('reminders.new');
	// });

	// Route::post('dashboard', function() {
	// 	// Validate
	// 	$validation = Validator::make(Input::all(), Reminder::$rules);

	// 	if ( $validation->fails() ) {
	// 		Input::flash();
	// 		return Redirect::to('dashboard')->with_errors($validation);
	// 	}

	// 	// Insert into DB
	// 	$reminder = new Reminder;
	// 	$reminder->title = Input::get('title');
	// 	$reminder->user_id = Auth::user()->id;
	// 	$reminder->message = Input::get('message');
	// 	$reminder->send_date = Input::get('send-date');
	// 	$reminder->save();

	// 	return Redirect::to('dashboard')->with('flash', 'Your reminder has been scheduled!');
	// });


	/*
	|--------------------------------------------------------------------------
	| Show Single Reminder
	|--------------------------------------------------------------------------
	*/
	// Route::get('(:num)', function($reminder_id) {
	// 	$reminder = Reminder::find((int)$reminder_id);

	// 	if ( !$reminder || $reminder->user_id !== Auth::user()->id ) {
	// 		return Redirect::to('dashboard');
	// 	}
		
	// 	return View::make('reminders.show')->with('reminder', $reminder);
	// });


	/*
	|--------------------------------------------------------------------------
	| Update Reminder
	|--------------------------------------------------------------------------
	*/
	// Route::put('(:num)', function($reminder_id) {
	// 	$reminder = Reminder::find($reminder_id);
	// 	$reminder->title = Input::get('title');
	// 	$reminder->message = Input::get('message');
	// 	$reminder->send_date = Input::get('send-date');

	// 	// TODO - Re-validate this?
	// 	$reminder->save();

	// 	return Redirect::to('dashboard')->with('flash', 'Your reminder has been updated!');
	// });


	/*
	|--------------------------------------------------------------------------
	| Delete Reminder
	|--------------------------------------------------------------------------
	*/
	// Route::delete('(:num)', function($reminder_id) {
	// 	Reminder::find($reminder_id)->delete();
	// 	return Redirect::to('dashboard');
	// });

// })


/*
|--------------------------------------------------------------------------
| CRON - Filter through today's messages, and send them out
|--------------------------------------------------------------------------
*/
Route::get('cron/send', function() {
	$reminders = Reminder::find_todays_reminders();
	return Reminder::notify($reminders);
});


/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Router::register('GET /', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('/');
});

Route::filter('registered?', function() {
	if ( Auth::user() ) return Redirect::to('dashboard');
});

Route::filter('has_permission', function($reminder) {
	if ( !is_object($reminder) || $reminder->user_id !== Auth::user()->id ) {
		return Redirect::to('dashboard');
	}
});