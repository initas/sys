<?php
namespace securhat\api\v1b0;
use model\v1b0\Curhat;
use model\v1b0\User;
use \DB;
use \Response;
class CurhatController extends \BaseController{
	
	/*--- Implemented Controller ---*/
	public function index(){
		$response = Curhat::getCurhats();
		return Response::json($response);
	}
	public function show($curhat_id){
		$response = Curhat::getCurhat($curhat_id);
		return Response::json($response);
	}
	public function create(){
		$response = Curhat::getCurhatOptions();
		return Response::json($response);
	}
	public function edit($curhat_id){
		$response = Curhat::getCurhat($curhat_id);
		if($response['status']==SUCCESS){
			$curhatOptions = Curhat::getCurhatOptions();
			$response = array_merge_recursive($response, $reviewOptions);
		}
		return Response::json($response);
	}
	public function save(){
		DB::beginTransaction();
		$statuses = array();
		
		$userLoginData = User::getUserLoginData();
		$user_id = $userLoginData['result']['id'];
		
		$storeCurhat = Curhat::saveCurhat($user_id);
		$statuses[] = $storeCurhat['status'];
		if($storeCurhat['status']==SUCCESS){
			$response['data'] = $storeCurhat['result'];
			/*$uploadCurhatImage = Curhat::uploadCurhatImage();
			$statuses[] = $uploadCurhatImage['status'];
			if($storeCurhat['status']!=SUCCESS){
				$response['errors'] = $uploadCurhatImage['errors'];
			}*/
		}else{
			$response['errors'] = $storeCurhat['errors'];
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
	public function getUserCurhats($username){
		$user = User::getUser($username);
		$userId = $user['result']['id'];
		$response = Curhat::getUserCurhats($userId);
		return Response::json($response);
	}
	public function getUserCurhatStreams($username){
		$user = User::getUser($username);
		$userId = $user['result']['id'];
		$response = Curhat::getUserCurhatStreams($userId);
		return Response::json($response);
	}
	public function getUserPublicCurhats($username){
		$user = User::getUser($username);
		$userId = $user['result']['id'];
		$response = Curhat::getUserPublicCurhats($userId);
		return Response::json($response);
	}
	public function getFromUserCurhats($username){
		$user = User::getUser($username);
		$userId = $user['result']['id'];
		$response = Curhat::getFromUserCurhats($userId);
		return Response::json($response);
	}
	public function getToUserCurhats($username){
		$user = User::getUser($username);
		$userId = $user['result']['id'];
		$response = Curhat::getToUserCurhats($userId);
		return Response::json($response);
	}
}