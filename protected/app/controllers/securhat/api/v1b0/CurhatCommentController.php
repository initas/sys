<?php
namespace securhat\api\v1b0;
use model\v1b0\CurhatComment;
use model\v1b0\CurhatCommentLike;
use \Auth;
use \DB;
use \Response;
class CurhatCommentController extends \BaseController{
	/*--- Implemented Controller ---*/
	public function index(){
		$response = CurhatComment::getAllCurhatComments();
		return Response::json($response);
	}
	public function save($curhat_id){
		DB::beginTransaction();
		$statuses = array();
		
		$userLoginData = Auth::getUserLoginData();
		$user_id = $userLoginData['result']['id'];
		
		$saveCurhatComment = CurhatComment::saveCurhatComment($curhat_id, $user_id);
		$statuses[] = $saveCurhatComment['status'];
		if($saveCurhatComment['status']==SUCCESS){
			$response['data'] = $saveCurhatComment['result'];
		}else{
			$response['errors'] = $saveCurhatComment['errors'];
		}
		
		if($this->checkStatuses($statuses)){
			DB::commit();
			$response['status'] = SUCCESS;
		}elseIf(isset($response['errors'])){
			$response['status'] = VALIDATION_FAIL;
			$response['statuses'] = $statuses;
		}else{
			$response['status'] = TRANSACTION_FAILED;
			$response['statuses'] = $statuses;
		}
		
		return Response::json($response);
	}
	
	/*--- Additional Controller ---*/
	public function getCurhatComments($curhat_id){
		$response = CurhatComment::getCurhatComments($curhat_id);
		return Response::json($response);
	}
	public function like($curhat_comment_id){
		$userLoginData = Auth::getUserLoginData();
		$user_id = $userLoginData['result']['id'];
		$response = CurhatCommentLike::like($curhat_comment_id, $user_id);
		return Response::json($response);
	}
	public function unlike($curhat_comment_id){
		$userLoginData = Auth::getUserLoginData();
		$user_id = $userLoginData['result']['id'];
		$response = CurhatCommentLike::unlike($curhat_comment_id, $user_id);
		return Response::json($response);
	}
}