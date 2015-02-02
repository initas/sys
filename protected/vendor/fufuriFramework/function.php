<?php
	function dd($var){
		var_dump($var);
	}
	function ss($var){
		dd($var);
		exit();
	}
	function getHeader($headerName){
		$headers = $_SERVER;
		$headerName = strtoupper(str_ireplace('-', '_', 'HTTP_'.$headerName));
		$header = (isset($headers[$headerName]) ? $headers[$headerName] : null);
		return $header;
	}
?>