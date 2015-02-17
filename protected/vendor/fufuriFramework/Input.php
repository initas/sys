<?php
class Input{
	public static function post($vars, $default = null){
		if(is_array($vars)){
			foreach($vars as $id=>$value){
				$_POST[$id] = $value;
			}
		}else{
			if(isset($_POST[$vars])){
				return $_POST[$vars];
			}else{
				return $default;
			}
		}
	}
	public static function get($vars, $default = null){
		if(is_array($vars)){
			foreach($vars as $id=>$value){
				$_GET[$id] = $value;
			}
		}else{
			if(isset($_GET[$vars])){
				return $_GET[$vars];
			}else{
				return $default;
			}
		}
	}
	public static function files($vars, $default = null){
		if(isset($_FILES[$vars])){
			return $_FILES[$vars];
		}else{
			return $default;
		}
	}
}