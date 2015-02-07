<?php
use model\v1b0\User;
class Auth{
	#authorization
	public static function logIn($username, $password){
		unset($_SESSION["id"]);
		$db = User::where('username', '=', $username, function($query) use($username){
				$query->orWhere('email', '=', $username);
			})
			->where('password', '=', $password)
			->first();
		
		if($db->data!=null){
			$_SESSION["id"]=$db->data['id'];
		}
		
		return self::getUserLoginData();
	}
	public static function logOut(){
		unset($_SESSION["id"]);
	}
	public static function getUserLoginData(){
		if(isset($_SESSION["id"])){
			$db = User::find($_SESSION["id"]);
		}else{
			$username = getHeader('username');
			$email = getHeader('email');
			$db = User::where('username', '=', $username)->orWhere('email', '=', $email)->first();
		}
		$response = Response::validateQueryResponse($db);
		return $response;
	}
}