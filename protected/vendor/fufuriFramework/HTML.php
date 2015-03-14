<?php
class HTML{
	
	public static function style($url){
		$style = '<link href="'.URL::to($url).'" rel="stylesheet">';
		return $style;
	}
	public static function script($url){
		$script = '<script src="'.URL::to($url).'"></script>';
		return $script;
	}
	
}