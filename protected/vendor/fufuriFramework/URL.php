<?php
class URL{
	public static function base(){
		$host = "http://".$_SERVER['SERVER_NAME'];
		$paths = explode('/', $_SERVER['REQUEST_URI']);
		if(!preg_match('/(\.com|\.net|\.co\.id)/si', $host)){
			$host .= '/'.$paths[1];
		}
		return $host;
	}
	public static function to($url){
		$to = self::base().'/'.$url;
		return $to;
	}
}