<?php
class File{
	public static function uploadImage($file, $path, $targetName = null){
		$fileName = $file['name']; //md5($imgName.time().rand());
		$fileType = $file['type'];
		$fileSize = $file['size'];
		$fileSrc = $file['tmp_name'];
		$fileError = $file['error'];
		
		if($fileType == "image/pjpeg" || $fileType == "image/jpeg"){	
			$extension = '.jpg';
		}elseif($fileType == "image/x-png" || $fileType == "image/png"){	
			$extension = '.png';
		}elseif($fileType == "image/gif"){
			$extension = '.gif';
		}
		
		if($targetName==null){
			$targetName = md5($fileType.$fileSize.$fileName.$fileSrc.time().rand()).$extension;
		}
		
		$path = trim($path, '/');
		$destination = $path.'/'.$targetName;
		if(move_uploaded_file($fileSrc, $destination)){
			$response['status'] = true;
			$response['file_name'] = $fileName;
			$response['size'] = $fileSize;
			$response['mime'] = $fileType;
			$response['url'] = $targetName;
		}else{
			$response = false;
			$response['errors'] = $fileError;
		};
		
		return $response;
	}
	public static function getImageThumb($path, $size){
		list($width, $height) = getimagesize($path);
		$myImage = imagecreatefromjpeg($path);
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
		$thumbSize = $size;
		$thumb = imagecreatetruecolor($thumbSize, $thumbSize);
		imagecopyresampled($thumb, $myImage, 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);
		
		//final output
		header('Content-type: image/jpeg');
		imagejpeg($thumb);
	}
}