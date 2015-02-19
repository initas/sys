<?php
namespace securhat\api\v1b0;
use model\v1b0\Friend;
use model\v1b0\User;
use \Auth;
use \Response;
class FriendController extends \BaseController{
	
	/*--- Implemented Controller ---*/
	public static function index($username){
		$user = User::getUser($username);
		$user_id = $user['result']['id'];
		$response = Friend::getFriends($user_id);
		return Response::json($response);
	}
	public static function save($username){
		$userLoginData = Auth::getUserLoginData();
		$user_id = $userLoginData['result']['id'];
		$user = User::getUser($username);
		$to_user_id = $user['result']['id'];
		$response = Friend::friend($user_id, $to_user_id);
		return Response::json($response);
	}
	public static function delete($username){
		$userLoginData = Auth::getUserLoginData();
		$user_id = $userLoginData['result']['id'];
		$user = User::getUser($username);
		$to_user_id = $user['result']['id'];
		$response = Friend::unfriend($user_id, $to_user_id);
		return Response::json($response);
	}
	
	/*--- Additional Controller ---*/
	public static function getIncomingFriendRequest($username){
		$user = User::getUser($username);
		$user_id = $user['result']['id'];
		$response = Friend::getIncomingFriendRequest($user_id);
		return Response::json($response);
	}
	public static function getSentFriendRequest($username){
		$user = User::getUser($username);
		$user_id = $user['result']['id'];
		$response = Friend::getSentFriendRequest($user_id);
		return Response::json($response);
	}
}