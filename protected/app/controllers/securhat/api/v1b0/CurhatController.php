<?php
namespace securhat\api\v1b0;
use model\v1b0\Curhat;
use model\v1b0\Image;
use model\v1b0\User;
use \DB;
use \Input;
use \Response;
use \Auth;
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
		
		$userLoginData = Auth::getUserLoginData();
		$user_id = $userLoginData['result']['id'];
		
		$saveCurhat = Curhat::saveCurhat($user_id);
		$statuses[] = $saveCurhat['status'];
		if($saveCurhat['status']==SUCCESS){
			$response['data'] = $saveCurhat['result'];
			
			$file = Input::files("image");
			$uploadImage = Image::uploadImage($file);
			$statuses[] = $uploadImage['status'];
			
			if($uploadImage['status']==SUCCESS){
				Input::post(array(
					'title' => Input::post('image_title', null),
					'file_name' => $uploadImage['result']['file_name'],
					'url' => $uploadImage['result']['url'],
					'size' => $uploadImage['result']['size'],
					'mime' => $uploadImage['result']['mime']
				));
				
				$saveImage = Image::saveImage($user_id);
				$statuses[] = $saveImage['status'];
				
				if($saveImage['status']==SUCCESS){
					Curhat::curhat_attachment()->synch(
						$saveCurhat['result']['id'],
						$saveImage['result']['id']
					);
				}else{
					$response['errors'] = $saveImage['errors'];
				}
			}else{
				$response['errors'] = $uploadImage['errors'];
			}
			
		}else{
			$response['errors'] = $saveCurhat['errors'];
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