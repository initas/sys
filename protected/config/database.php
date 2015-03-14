<?php
class Config{
	public static function database($index){
		$host = "http://".$_SERVER['SERVER_NAME'];
		if(!preg_match('/(\.com|\.net|\.co\.id)/si', $host)){
			$config = array(
				'driver' => 'mysql',
				'host' => '127.0.0.1',
				'database' => 'system',
				'username' => 'root',
				'password' => ''
			);
		}else{
			$config = array(
				'driver' => 'mysql',
				'host' => '127.0.0.1',
				'database' => 'pphrsyrr_sys',
				'username' => 'pphrsyrr_icodea',
				'password' => 'ICODEA!@#'
			);
		}
		return $config[$index];
	}
}