<?php
Route::filter('requireExistingUsername.api', function($username)
{
	$user = model\v1b0\User::getUser($username);
	if($user['status']!=SUCCESS){
		$response['status'] = INVALID_USER;
		return Response::json($response);
	}
});
Route::filter('requireLogin.api', function()
{
	$user = Auth::getUserLoginData();
	if($user['status']!=SUCCESS){
		$response['status'] = INVALID_CREDENTIAL;
		return Response::json($response);
	}
});