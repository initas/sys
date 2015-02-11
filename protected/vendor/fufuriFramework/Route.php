<?php
class Route{
	public static $prefix;
	public static $before;
	public static $befores;
	public static $variables;
	
	#pre-function
	public static function group(){
		$arguments = func_get_args();
		if(isset($arguments[0])){
			$argument = $arguments[0];
			if(array_key_exists('prefix', $argument)){
				$previousPrefix = null;
				if(self::$prefix==null){
					self::$prefix = $argument['prefix'];
				}else{
					$previousPrefix  = self::$prefix;
					self::$prefix .= $argument['prefix'];
				}
			}
			if(array_key_exists('before', $argument)){
				$previousBefore = null;
				if(self::$before==null){
					self::$before = $argument['before'];
				}else{
					$previousBefore  = self::$before;
					self::$before .= '|'.$argument['before'];
				}
			}
		}
		
		$callBack = self::getCallBack($arguments);
		$callBack();
		
		if(isset($arguments[0])){
			$argument = $arguments[0];
			if(array_key_exists('prefix', $argument)){
				self::$prefix=null;
				if(isset($previousPrefix)){
					self::$prefix=$previousPrefix;
				}
			}
			if(array_key_exists('before', $argument)){
				self::$before=null;
				if(isset($previousBefore)){
					self::$before=$previousBefore;
				}
			}
		}
		
		
	}
	
	#http-request
	public static function get(){
		if($_SERVER['REQUEST_METHOD']=='GET'){
			$arguments = func_get_args();
			self::findMatchUrl($arguments);
		}
	}
	public static function post(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$arguments = func_get_args();
			self::findMatchUrl($arguments);
		}
		
	}
	public static function put(){
		if($_SERVER['REQUEST_METHOD']=='PUT'){
			$arguments = func_get_args();
			self::findMatchUrl($arguments);
		}
	}
	public static function delete(){
		if($_SERVER['REQUEST_METHOD']=='DELETE'){
			$arguments = func_get_args();
			self::findMatchUrl($arguments);
		}
	}
	
	#find-match-url
	public static function findMatchUrl($arguments){
		
		$url = trim($_GET['url'], '/').'/';
		$expectedUrl = trim($arguments[0], '/').'/';;
		if(self::$prefix!=null){
			$expectedUrl = trim((self::$prefix).$arguments[0], '/').'/';
		}
		
		$urlRegex = self::generateUrlRegex($expectedUrl);
		$matchInUrl = self::getMatchInUrl($urlRegex, $url);
		
		$check = $expectedUrl;
		if(isset($matchInUrl[0])){
			$check = $matchInUrl[0];
		}
		//dd(self::$before);
		if($check == $url){
			//echo '<div><strong>'.$urlRegex.' == '.$url.'</strong></div>';
			self::$variables = self::getMatchVariablesInUrl($matchInUrl, $expectedUrl);
			if(self::$before!=null){
				self::$befores = explode('|', self::$before);
				require_once 'protected/app/filters.php';
			}
			return Response::stop(self::execute($arguments));
		}else{
			//echo '<div>'.$urlRegex.' == '.$url.'</div>';
		}
	}
	public static function generateUrlRegex($expectedUrl){
		$regexp= '/{(.*?)}/si';
		$replacement= '(.*?)';
		$urlRegex = (str_ireplace('/', '\/', preg_replace($regexp, $replacement, $expectedUrl)));
		return $urlRegex;
	}
	public static function getMatchInUrl($urlRegex, $url){
		preg_match("/$urlRegex/si", $url, $matchInUrl);
		return $matchInUrl;
	}
	public static function getMatchVariablesInUrl($matchInUrl, $expectedUrl){
		$matchVariablesInUrl = array();
		if(count($matchInUrl)>1){
			$regexp= '{(.*?)}\/';
			preg_match_all("/$regexp/si", $expectedUrl, $vars);
			foreach($vars[1] as $id=>$var){
				$matchVariablesInUrl[$var] = $matchInUrl[$id+1];
			}
		}
		return $matchVariablesInUrl;
	}
	public static function execute($arguments){
		$callBack = self::getCallBack($arguments);
		if(is_callable($callBack)){
			call_user_func_array($callBack, self::$variables);
		}else{
			$callBacks = explode('@', $callBack);
			if(count($callBacks)==2){
				$class = new $callBacks[0];
				$function = $callBacks[1];
				call_user_func_array(array($class, $function), self::$variables);
			}
		}
	}
	public static function getCallBack($arguments){
		$callBack = $arguments[1];
		for ($i = 0; $i < count($arguments); $i++) {
			if(is_callable($arguments[$i])){
				$callBack = $arguments[$i];
			}
		}
		return $callBack;
	}
	
	#filter
	public static function filter($name, $callBack){
		if(in_array($name, self::$befores)){
			call_user_func_array($callBack, self::$variables);
		}
	}
}
?>