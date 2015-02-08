<?php
namespace model\v1b0;
use \Response;
class Curhat extends \BaseModel{
	/*
	|--------------------------------------------------------------------------
	| Basic Setups
	|--------------------------------------------------------------------------
	*/
	protected static $table = 'curhats';
	
	/*
	|--------------------------------------------------------------------------
	| Validation Setups
	|--------------------------------------------------------------------------
	*/
	
	public static function setRules() 
    {
    	$rules = array();
    	$messages = array();

    	$rules['card_id'] = 'required|integer';
    	$rules['overall_rating'] = 'required|integer';
		
        self::$rules = $rules;
        self::$customMessages = $messages;
    } 
	
	/*
	|--------------------------------------------------------------------------
	| Methods
	|--------------------------------------------------------------------------
	*/
	
	#retrieve
	public static function getCurhats(){
		$db = Curhat::paginate();
		$response = Response::validateQueryResponse($db);
		return $response;
		// user curhat only
	}
	public static function getUserCurhats($user_id){
		$db = Curhat::where('user_id', '=', $user_id)->paginate();
		$response = Response::validateQueryResponse($db);
		return $response;
		// user curhat only
	}
	public static function getUserCurhatStreams($user_id){
		$db = Curhat::raw('
				select *
				from curhats
				where( 
					user_id in(
						SELECT a.to_user_id
						FROM friend_requests a, friend_requests b
						WHERE a.user_id = b.to_user_id
						AND b.user_id = a.to_user_id
						AND a.user_id = '.$user_id.'
					) or user_id = '.$user_id.'
					or to_user_id = '.$user_id.'
				)
			')
			->paginate();
		$response = Response::validateQueryResponse($db);
		return $response;
		/*
		| user curhat
		| user friend curhats
		| curhat mentioned user
		*/
	}
	public static function getUserPublicCurhats($user_id){
		$db = Curhat::where('id_fms_sm_member', '=', $user_id)
			->orwhere('id_to_member', '=', $user_id)
			->paginate();
		$response = Response::validateQueryResponse($db);
		return $response;
		/*
		| user curhat
		| curhat mentioned user
		*/
	}
	public static function getFromUserCurhats($user_id){
		$db = Curhat::
			where('user_id', '=', $user_id)
			->where('to_user_id', '>', 0)
			->paginate();
		$response = Response::validateQueryResponse($db);
		return $response;
		// curhat mentioned user
	}
	public static function getToUserCurhats($user_id){
		$db = Curhat::where('to_user_id', '=', $user_id)->paginate();
		$response = Response::validateQueryResponse($db);
		return $response;
		// curhat mentioned user
	}
	public static function getCurhat($curhat_id){
		$db = Curhat::find($curhat_id);
		$response = Response::validateQueryResponse($db);
		return $response;
		// curhat by id
	}
	
	#create
	public static function getCurhatOptions(){
	}
	
	#edit
	public static function editCurhat($curhat_id){
		$db = Curhat::find($curhat_id);
		$response = Response::validateQueryResponse($db);
		return $response;
	}
	
	#save
	public static function saveCurhat($user_id){
		$response['status'] = UNKNOWN_ERROR;
		
		$curhat = new Curhat;
		$curhat->user_id = $user_id;
		
		$curhat->fillable = array(
			'to_user_id',
			'description'
		);
		
		if($curhat->save()) {
			$response['status'] = SUCCESS;
			$response['result'] = $curhat->data;
		}else{
			$response['status'] = VALIDATION_ERROR;
			$response['errors'] = $curhat->errors;
		}
		
		return $response;
	}
	
	#update
	public static function updateCurhat($curhat_id){
		$result = Curhat::update();
	}
	
	#delete
	public static function deleteCurhat($curhat_id){
		$result = Curhat::delete();
	}
	
	#file
	public static function uploadCurhatImage($file){
		//Your Image
		$imgSrc = $file['tmp_name'];
		
		//getting the image dimensions
		list($width, $height) = getimagesize($imgSrc);
		
		//saving the image into memory (for manipulation with GD Library)
		$myImage = imagecreatefromjpeg($imgSrc);
		
		// calculating the part of the image to use for thumbnail
		if ($width > $height) {
		  $y = 0;
		  $x = ($width - $height) / 2;
		  $smallestSide = $height;
		} else {
		  $x = 0;
		  $y = ($height - $width) / 2;
		  $smallestSide = $width;
		}
		
		// copying the part into thumbnail
		$thumbSize = 100;
		$thumb = imagecreatetruecolor($thumbSize, $thumbSize);
		imagecopyresampled($thumb, $myImage, 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);
		
		//final output
		header('Content-type: image/jpeg');
		imagejpeg($thumb);
	}
	
}