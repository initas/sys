<?php
namespace model\v1b0;
use \Response;
class CurhatLike extends \BaseModel{
	/*
	|--------------------------------------------------------------------------
	| Basic Setups
	|--------------------------------------------------------------------------
	*/
	protected static $table = 'curhat_likes';
	
	/*
	|--------------------------------------------------------------------------
	| Methods
	|--------------------------------------------------------------------------
	*/
	
	#retrieve
	public static function isLiked($curhat_id, $user_id){
		$db = CurhatLike::where('curhat_id', '=', $curhat_id)
			->where('user_id', '=', $user_id)
			->first();
		$response = Response::validateQueryResponse($db);
		if($response['status']==SUCCESS){
			$response = true;
		}else{
			$response = false;
		}
		return $response;
	}
	public static function getCurhatLikes($curhat_id){
		$db = User::curhat_likes()->where('curhat_id', '=', $curhat_id)->get();
		$response = Response::validateQueryResponse($db);
		return $response;
	}
	
	#synch
	public static function like($curhat_id, $user_id){
		self::unlike($curhat_id, $user_id);
		Curhat::curhat_likes()->attach(
			$curhat_id,
			$user_id
		);
	}
	public static function unlike($curhat_id, $user_id){
		Curhat::curhat_likes()->detach(
			$curhat_id,
			$user_id
		);
	}
}