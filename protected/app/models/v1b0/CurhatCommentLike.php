<?php
namespace model\v1b0;
use \Response;
class CurhatCommentLike extends \BaseModel{
	/*
	|--------------------------------------------------------------------------
	| Basic Setups
	|--------------------------------------------------------------------------
	*/
	protected static $table = 'curhat_comment_likes';
	
	/*
	|--------------------------------------------------------------------------
	| Methods
	|--------------------------------------------------------------------------
	*/
	
	#retrieve
	public static function isLiked($curhat_comment_id, $user_id){
		$db = CurhatCommentLike::where('curhat_comment_id', '=', $curhat_comment_id)
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
	public static function getCurhatCommentLikes($curhat_comment_id){
		$db = User::curhat_comment_likes()->where('curhat_comment_id', '=', $curhat_comment_id)->paginate();
		$response = Response::validateQueryResponse($db);
		return $response;
	}
	
	#synch
	public static function like($curhat_comment_id, $user_id){
		self::unlike($curhat_comment_id, $user_id);
		CurhatComment::curhat_comment_likes()->attach(
			$curhat_comment_id,
			$user_id
		);
	}
	public static function unlike($curhat_comment_id, $user_id){
		CurhatComment::curhat_comment_likes()->detach(
			$curhat_comment_id,
			$user_id
		);
	}
}