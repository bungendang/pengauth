<?php
Route::group(array('before' => 'guest'), function(){

Route::get('register',function(){
		return View::make('pages.register', array('title'=>'Default Register Page'));
	});

Route::get('login', function()
{
	return View::make('pages.login',array('title'=>'Default Login Page'));
});





Route::get('/activate/{code}', array(
		'as' => 'user-activate',
		'uses'=>'AuthController@Activate'
		));

/*
	CSRF protection group
	*/
	Route::group(array('before' => 'csrf'),function(){
	
	//post register
	Route::post('register', 'AuthController@postRegister');

	Route::post('login', array(
	'as' => 'user-login-post',
	'uses' => 'AuthController@postLogin'
	));
	Route::post('forgot-password',array(
	'as' => 'user-forgot-post',
	'uses' => 'Auth@postForgotPassword'
	));
	});

});

Route::get('logout', function()
{
	Auth::logout();
	//Auth.Basic::logout(); // log the user out of our application
	return Redirect::to('/'); // redirect the user to the login screen});
});