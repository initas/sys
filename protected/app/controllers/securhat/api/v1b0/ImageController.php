<?php
namespace securhat\api\v1b0;
use \File;
use \Response;
class ImageController extends \BaseController{
	public static function getCurhatImage($size, $file_name){
		$url = $_POST['baseUrl'];
		$path = $url.'/img/curhat/'.$file_name;
		File::getImageThumb($path, $size);
	}
	public static function uploadImage(){
		$url = $_POST['baseUrl'];
		$destination = $url.'/img/curhat/';
		File::uploadImage($_FILES['image'], $destination);
	}
}