<?php
	function dd($var = null){
		var_dump($var);
	}
	function ss($var = null){
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