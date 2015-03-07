<?php
function __autoload($class_path) {
    $class_paths = explode('\\', $class_path);
    $class_name = end($class_paths);
	
	#fufuri-framework
	$file = 'protected/vendor/fufuriFramework/'.$class_name.'.php';
	if(file_exists($file)) {
		require_once $file;
	} 
	
	#models
	$file = 'protected/app/models/v1b0/'.$class_name.'.php';
	if(file_exists($file)) {
		require_once $file;
	} 
	
	#controllers
	$file = 'protected/app/controllers/securhat/api/v1b0/'.$class_name.'.php';
	if(file_exists($file)) {
		require_once $file;
	}
	$file = 'protected/app/controllers/securhat/web/v1b0/'.$class_name.'.php';
	if(file_exists($file)) {
		require_once $file;
	}
}