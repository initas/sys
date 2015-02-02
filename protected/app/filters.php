<?php
	Route::filter('requireExistingUsername.api', function($username)
	{
		$user = model\securhat\v1b0\User::getUser($username);
		if($user['status']!=SUCCESS){
			$response['status'] = INVALID_USER;
			return Response::json($response);
		}
	});
	Route::filter('requireLogin.api', function()
	{
		$user = model\securhat\v1b0\User::getUser(getHeader('username'));
		if($user['status']!=SUCCESS){
			$response['status'] = INVALID_CREDENTIAL;
			return Response::json($response);
		}
	});