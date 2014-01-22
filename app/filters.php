<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
		return Redirect::to('/')->with('error', 'Anda harus login terlebih dahulu.');
});

Route::filter('admin_center', function(){
	$user = Auth::user()->user;
	if($user->role_id != "4")
		App::abort(404, 'Page Not Found.');
});

Route::filter('admin_region', function(){
	$user = Auth::user()->user;
	if($user->role_id != "3" && $user->role_id != "4")
		App::abort(404, 'Page Not Found.');
});

Route::filter('user', function() {
	$user = Auth::user()->user;
	if($user->role_id != "2") {
		App::abort(404, 'Page Not Found.');
	}
});


Route::filter('auth.basic', function()
{
	//return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

//Route::filter('guest', function()
//{
//	if (Auth::check()) {
//		$user = Auth::user()->user;
//		switch ($user->role_id) {
//			case 2:
//				return Redirect::to('/edit');
//				break;
//			case 3:
//				return Redirect::to('/admreg/Verifikasi');
//				break;
//			case 4:
//				return Redirect::to('/admin/account');
//				break;
//			default:
//				return Redirect::to('/edit');
//				break;
//		}
//
//	};
//});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});