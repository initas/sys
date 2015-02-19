<?php
namespace model\v1b0;
use \Response;
class Friend extends \BaseModel{
	/*
	|--------------------------------------------------------------------------
	| Basic Setups
	|--------------------------------------------------------------------------
	*/
	protected static $table = 'friends';
	
	/*
	|--------------------------------------------------------------------------
	| Methods
	|--------------------------------------------------------------------------
	*/
	
	#retrieve
	public static function isFriend($user_id, $to_user_id){
		$db = Friend::where('user_id', '=', $user_id)
			->where('to_user_id', '=', $to_user_id)
			->first();
		$response = Response::validateQueryResponse($db);
		if($response['status']==SUCCESS){
			$response = true;
		}else{
			$response = false;
		}
		return $response;
	}
	public static function getFriends($user_id){
		$db = User::raw('
				SELECT *
				FROM `users`
				WHERE( 
					`id` IN(
						SELECT a.to_user_id
						FROM friends a, friends b
						WHERE a.user_id = b.to_user_id
						AND b.user_id = a.to_user_id
						AND a.user_id = '.$user_id.'
					)
				)
			')
			->get();
		$response = Response::validateQueryResponse($db);
		return $response;
	}
	public static function getIncomingFriendRequest($user_id){
		$db = User::raw('
				SELECT *
				FROM `users`
				WHERE( 
					`id` IN(
						SELECT `user_id`
						FROM friends
						WHERE( 
							user_id NOT IN(
								SELECT a.user_id
								FROM friends a, friends b
								WHERE a.user_id = b.to_user_id
								AND b.user_id = a.to_user_id
							)
						)
						AND `to_user_id` = '.$user_id.'
					)
				)
			')
			->get();
		$response = Response::validateQueryResponse($db);
		return $response;
	}
	public static function getSentFriendRequest($user_id){
		$db = User::raw('
				SELECT *
				FROM users
				WHERE( 
					`id` IN(
						SELECT `to_user_id`
						FROM friends
						WHERE( 
							to_user_id NOT IN(
								SELECT a.to_user_id
								FROM friends a, friends b
								WHERE a.user_id = b.to_user_id
								AND b.user_id = a.to_user_id
							)
						)
						AND `user_id` = '.$user_id.'
					)
				)
			')
			->get();
		$response = Response::validateQueryResponse($db);
		return $response;
	}
	
	#synch
	public static function friend($user_id, $to_user_id){
		self::unfriend($user_id, $to_user_id);
		$db = User::friends()->attach(
			$user_id,
			$to_user_id
		);
	}
	public static function unfriend($user_id, $to_user_id){
		User::friends()->detach(
			$user_id,
			$to_user_id
		);
	}
}