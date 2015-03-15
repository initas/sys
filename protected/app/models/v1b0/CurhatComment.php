<?php
namespace model\v1b0;
use \Auth;
use \Response;
class CurhatComment extends \BaseModel{
	/*
	|--------------------------------------------------------------------------
	| Basic Setups
	|--------------------------------------------------------------------------
	*/
	protected static $table = 'curhat_comments';
	protected static $append = array(
		'detail',
		'log_on_user'
	);
	
	public static $relationsData = array(
		'user'						=> array(self::BELONGS_TO, 'model\v1b0\User'),
		'curhat_comment_likes'		=> array(self::BELONGS_TO_MANY, 'model\v1b0\User', 'curhat_comment_likes')
	);
	
	/*
	|--------------------------------------------------------------------------
	| Methods
	|--------------------------------------------------------------------------
	*/
	
	#retrieve
	public static function getAllCurhatComments(){
		$db = CurhatComment::paginate();
		$response = Response::validateQueryResponse($db);
		return $response;
	}
	public static function getCurhatComments($curhat_id){
		$db = CurhatComment::where('curhat_id', '=', $curhat_id)->paginate();
		$response = Response::validateQueryResponse($db);
		return $response;
	}
	public static function getCurhatComment($curhat_id){
		$db = CurhatComment::where('curhat_id', '=', $curhat_id)->paginate();
		$response = Response::validateQueryResponse($db);
		return $response;
	}
	
	#save
	public static function saveCurhatComment($curhat_id, $user_id){
		$response['status'] = UNKNOWN_ERROR;
		
		$curhatComment = new CurhatComment;
		$curhatComment->curhat_id = $curhat_id;
		$curhatComment->user_id = $user_id;
		
		$curhatComment->fillable = array(
			'description'
		);
		
		if($curhatComment->save()) {
			$response['status'] = SUCCESS;
			$response['result'] = $curhatComment->data;
			//Log::saveLog(SAVE_CURHAT, $user_id, $curhat->data['id']);
		}else{
			$response['status'] = VALIDATION_ERROR;
			$response['errors'] = $curhat->errors;
		}
		
		return $response;
	}
	
	#append
	public static function append_log_on_user($result){
		$curhat_id = $result['id'];
		$userLoginData = Auth::getUserLoginData();
		$user_id = $userLoginData['result']['id'];
		$response['is_liked'] = CurhatCommentLike::isLiked($curhat_id, $user_id);
		return $response;
	}
	public static function append_detail($result){
		$curhat_comment_id = $result['id'];
		
		$response['likes'] = null;
		$getCurhatCommentLikes = CurhatCommentLike::getCurhatCommentLikes($curhat_comment_id);
		if($getCurhatCommentLikes['status'] == SUCCESS){
			$response['likes'] = $getCurhatCommentLikes['results'];
		}
		
		return $response;
	}
}