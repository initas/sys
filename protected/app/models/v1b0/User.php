<?php
namespace model\v1b0;
use \Response;
class User extends \BaseModel{
	/*
	|--------------------------------------------------------------------------
	| Basic Setups
	|--------------------------------------------------------------------------
	*/
	protected static $table = 'users';
	
	/*
	|--------------------------------------------------------------------------
	| Validation Setups
	|--------------------------------------------------------------------------
	*/
	
	public static function setRules() 
    {
    	$rules = array();
    	$messages = array();

    	$rules['entah'] = 'required|integer';
    	$rules['entah'] = 'required|integer';
		
        self::$rules = $rules;
        self::$customMessages = $messages;
    } 
	
	/*
	|--------------------------------------------------------------------------
	| Methods
	|--------------------------------------------------------------------------
	*/
	
	#retrieve
	public static function getUsers(){
		$db = User::paginate();
		$response = Response::validateQueryResponse($db);
		return $response;
	}
	public static function getUser($username){
		$db = User::where('username', '=', $username)->first();
		$response = Response::validateQueryResponse($db);
		return $response;
	}
	
	#create
	public static function getUserOptions(){
	}
	
	#edit
	public static function editUser($user_id){
		$db = User::find($user_id);
		$response = Response::validateQueryResponse($db);
		return $response;
	}
	
	#save
	public static function saveUser(){
		$result = User::save();
	}
	
	#update
	public static function updateUser($user_id){
		$result = User::update();
	}
	
	#delete
	public static function deleteUser($user_id){
		$result = User::delete();
	}
	
}