<?php
namespace model\v1b0;
use \File;
use \Response;
class Image extends \BaseModel{
	/*
	|--------------------------------------------------------------------------
	| Basic Setups
	|--------------------------------------------------------------------------
	*/
	protected static $table = 'images';
	public static $relationsData = array(
		'curhat_attachments' => array(self::BELONGS_TO_MANY, 'model\v1b0\Curhat', 'curhat_attachments'),
	);
	
	/*
	|--------------------------------------------------------------------------
	| Methods
	|--------------------------------------------------------------------------
	*/
	
	#save
	public static function saveImage($user_id){
		$response['status'] = UNKNOWN_ERROR;
		
		$image = new Image;
		$image->user_id = $user_id;
		
		$image->fillable = array(
			'title',
			'file_name',
			'url',
			'size',
			'mime'
		);
		
		if($image->save()) {
			$response['status'] = SUCCESS;
			$response['result'] = $image->data;
		}else{
			$response['status'] = VALIDATION_ERROR;
			$response['errors'] = $image->errors;
		}
		
		return $response;
	}
	
	#file
	public static function uploadImage($file){
		$response['status'] = FILE_NOT_FOUND;
		if($file!=null){
			$url = $_POST['baseUrl'];
			$destination = $url.'/img/image/';
			$uploadImage = File::uploadImage($file, $destination);
			if($uploadImage['status']==true){
				$response['status'] = SUCCESS;
				$response['result'] = $uploadImage;
			}else{
				$response['status'] = VALIDATION_ERROR;
				$response['errors'] = $uploadImage['errors'];
			}
		}else{
			$response['errors'] = 'file not selected';
		}
		return $response;
	}
	
	#append
	public static function append_log_on_user($result){
		$image_id = $result['id'];
		$response['test'] = $image_id;
		return $response;
	}
}