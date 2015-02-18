<?php
use model\securhat\v1b0\Curhat;

Route::group(array('prefix' => '/test'), function()
{
	Route::get('/', function(){
		echo 'test';
	});
});
#root
Route::get('/', function(){
	echo 'root';
});
	
Route::group(array('prefix' => '/api/v1b0'), function()
{
	#curhat
	Route::group(array('prefix' => '/curhat'), function()
	{
		Route::get('/', 'securhat\api\v1b0\CurhatController@index');
		Route::group(array('before' => 'requireLogin.api'), function()
		{
			Route::get('/create', 'securhat\api\v1b0\CurhatController@create');
			Route::post('/', 'securhat\api\v1b0\CurhatController@save');
		});
		Route::group(array('prefix' => '/{curhat_id}'), function()
		{
			Route::get('/', 'securhat\api\v1b0\CurhatController@show');
			Route::group(array('before' => 'requireLogin.api'), function()
			{
				Route::get('/like', 'securhat\api\v1b0\CurhatController@like');
				Route::get('/unlike', 'securhat\api\v1b0\CurhatController@unlike');
				Route::get('/pin', 'securhat\api\v1b0\CurhatController@pin');
				Route::get('/unpin', 'securhat\api\v1b0\CurhatController@unpin');
				Route::get('/edit', 'securhat\api\v1b0\CurhatController@edit'); 
				Route::post('/update', 'securhat\api\v1b0\CurhatController@update');
			});
		});
	});
	Route::group(array('prefix' => '/user/{username}/curhat', 'before' => 'requireExistingUsername.api'), function()
	{
		Route::get('/', 'securhat\api\v1b0\CurhatController@getUserCurhats');
		Route::get('/mention', 'securhat\api\v1b0\CurhatController@getFromUserCurhats');
		Route::get('/mentioned', 'securhat\api\v1b0\CurhatController@getToUserCurhats');
		Route::group(array('before' => 'requireLogin.api'), function()
		{
			Route::get('/stream', 'securhat\api\v1b0\CurhatController@getUserCurhatStreams');
		});
	});
	
	#img
	Route::group(array('prefix' => '/img'), function()
	{
		Route::get('/curhat/{size}/{file_name}', 'securhat\api\v1b0\ImageController@getCurhatImage');
		Route::post('/', 'securhat\api\v1b0\ImageController@uploadImage');
	});
	
	#log
	Route::group(array('prefix' => '/log'), function()
	{
		Route::get('/out', 'securhat\api\v1b0\LogController@logOut');
		Route::post('/in', 'securhat\api\v1b0\LogController@logIn');
		Route::group(array('prefix' => '/user/{username}', 'before' => 'requireExistingUsername.api'), function()
		{
			Route::get('/', 'securhat\api\v1b0\UserController@show');
		});
	});
	
	#user
	Route::group(array('prefix' => '/user'), function()
	{
		Route::get('/', 'securhat\api\v1b0\UserController@index');
		Route::get('/search', 'securhat\api\v1b0\UserController@searchUser');
		Route::get('/suggestion', 'securhat\api\v1b0\UserController@getUserSuggestion');
		Route::group(array('prefix' => '/{username}', 'before' => 'requireExistingUsername.api'), function()
		{
			Route::get('/', 'securhat\api\v1b0\UserController@show');
			Route::get('/pin', 'securhat\api\v1b0\UserController@getUserPin');
			Route::group(array('before' => 'requireLogin.api|identicalUsernameSession.api'), function()
			{
				Route::get('/edit', 'securhat\api\v1b0\CurhatController@edit');
				Route::get('/edit/password', 'securhat\api\v1b0\CurhatController@editPassword');
				Route::get('/edit/profile-picture', 'securhat\api\v1b0\CurhatController@editRelationship');
				Route::get('/edit/relationship', 'securhat\api\v1b0\CurhatController@editRelationship');
				Route::put('/', 'securhat\api\v1b0\CurhatController@update');
				Route::put('/password', 'securhat\api\v1b0\CurhatController@updatePassword');
				Route::put('/profile-picture', 'securhat\api\v1b0\CurhatController@updateRelationship');
				Route::put('/relationship', 'securhat\api\v1b0\CurhatController@updateRelationship');
			});
		});
	});
	
	#etc
	Route::get('/help', function(){
		echo 'help';
	});
	Route::get('/home', function(){
		echo 'home';
	});
	Route::get('/curhat/{time}/{id}/{page}/{preset}/{member}/{date}/{ads}', function(){
		echo 'test';
	});
});
