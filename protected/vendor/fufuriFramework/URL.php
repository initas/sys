<?php
class URL{
	public static function baseUrl(){
		$host = "http://".$_SERVER['SERVER_NAME'];
		$paths = explode('/', $_SERVER['REQUEST_URI']);
		if(!preg_match('/(\.com|\.net|\.co\.id)/si', $host)){
			$host .= '/'.$paths[1];
		}
		return $host;
	}
	public static function to($url){
		$to = self::baseUrl().'/'.$url;
		return $to;
	}
	public static function baseDir(){
		$baseDir = $_SERVER['DOCUMENT_ROOT'];
		$host = "http://".$_SERVER['SERVER_NAME'];
		$paths = explode('/', $_SERVER['REQUEST_URI']);
		if(!preg_match('/(\.com|\.net|\.co\.id)/si', $host)){
			$baseDir .= '/'.$paths[1];
		}
		return $baseDir;
	}
}