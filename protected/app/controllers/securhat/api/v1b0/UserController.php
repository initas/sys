<?php
namespace securhat\api\v1b0;
use model\v1b0\User;
use \Response;
class UserController extends \BaseController{
	
	/*--- Implemented Controller ---*/
	public function index(){
		$response = User::getUsers();
		return Response::json($response);
	}
	public function show($username){
		$response = User::getUser($username);
		return Response::json($response);
	}
	public function create(){
		$response = User::getUserOptions();
		return Response::json($response);
	}
	public function edit($user_id){
		$response = User::getUser($user_id);
		if($response['status']==SUCCESS){
			$userOptions = User::getUserOptions();
			$response = array_merge_recursive($response, $reviewOptions);
		}
			
		return Response::json($response);
	}
	public function store(){
		
	}
}