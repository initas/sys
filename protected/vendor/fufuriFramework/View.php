<?php
class View{
	protected static $content;
	protected static $vars = array();
	protected static $compile = false;
	
	public static function compile($url){
		$content = file_get_contents('protected/app/views/'.$url);
		
		//echo
		$regexp= '/{{(.*?)}}/si';
		$replacement= '<?= $1 ?>';
		$content = preg_replace($regexp, $replacement, $content);
		
		//foreach
		$regexp= '/@foreach\((.*?)\)/si';
		$replacement= '<?php foreach($1){ ?>';
		$content = preg_replace($regexp, $replacement, $content);
		
		//if
		$regexp= '/@if\((.*?)\)/si';
		$replacement= '<?php if($1){ ?>';
		$content = preg_replace($regexp, $replacement, $content);
		
		//end
		$regexp= '/@endforeach|@endif/si';
		$replacement= '<?php } ?>';
		$content = preg_replace($regexp, $replacement, $content);
		
		//ss($content);
		
		self::$content = $content;
		return new static;
	}
	public static function set($varName, $value){
		self::$vars[$varName] = $value;
		return new static;
	}
	public static function make(){
		foreach(self::$vars as $id => $var){
			$$id = $var;
		}
		$content = self::$content;
		eval(' ?>'.$content.'<?php ');;
	}
}