<?php
namespace securhat\api\v1b0;
use model\v1b0\Image;
use \File;
use \Input;
use \Response;
use \Auth;
use \URL;
class ImageController extends \BaseController{
	public static function getCurhatImage($size, $file_name){
		$url = URL::baseDir();
		$path = $url.'/img/curhat/'.$file_name;
		File::getImageThumb($path, $size);
	}
	public static function uploadImage(){
		$url = URL::baseDir();
		$destination = $url.'/img/curhat/';
		File::uploadImage($_FILES['image'], $destination);
	}
	
	public function save(){
		$file = Input::files("image");
		$response = Image::uploadImage($file);
		if($response['status']==SUCCESS){
			Input::post(array(
				'file_name' => $response['result']['file_name'],
				'url' => $response['result']['url'],
				'size' => $response['result']['size'],
				'mime' => $response['result']['mime']
			));
			
			$userLoginData = Auth::getUserLoginData();
			$user_id = $userLoginData['result']['id'];
		
			$response = Image::saveImage($user_id);
		}
		
		return Response::json($response);
	}
}