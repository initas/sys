<?php
namespace securhat\api\v1b0;
use \Auth;
use \Response;
class LogController extends \BaseController{
	/*--- Additional Controller ---*/
	public function logIn(){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$response = Auth::logIn($username, $password);
		return Response::json($response);
	}
	public function logOut(){
		$response = Auth::logOut();
		return Response::json($response);
	}
}