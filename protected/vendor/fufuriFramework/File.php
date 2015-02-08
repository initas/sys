<?php
class File{
	public static function uploadImage($file, $path, $targetName = null){
		$fileSrc = $_FILES['image']['tmp_name'];
		$fileName = $_FILES['image']['name']; //md5($imgName.time().rand());
		$fileType = $_FILES['image']['type'];
		
		if($fileType == "image/pjpeg" || $fileType == "image/jpeg"){	
			$extension = '.jpg';
		}elseif($fileType == "image/x-png" || $fileType == "image/png"){	
			$extension = '.png';
		}elseif($fileType == "image/gif"){
			$extension = '.gif';
		}
		
		if($targetName==null){
			$targetName = md5(rand().time().'_'.$fileName).$extension;
		}
		
		$path = trim($path, '/');
		$destination = $path.'/'.$targetName;
		move_uploaded_file($fileSrc, $destination);
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