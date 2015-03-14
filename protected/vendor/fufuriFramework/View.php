<?php
class View{
	protected static $content;
	protected static $vars = array();
	protected static $compile = false;
	
	
	protected static $contents = array();
	
	public static function compile($url){
		$content = file_get_contents('protected/app/views/'.$url);
		$content = self::reCompile($content);
		self::$content = $content;
		return new static;
	}
	
	public static function reCompile($content){
		#extend
		$regexp= '/@extends\(\'(.*?)\'\)/si';
		$content = preg_replace_callback(
			$regexp,
			function($matches){
				$subContent = file_get_contents('protected/app/views/'.$matches[1]);
				//$subContent = preg_replace('!\s+!', ' ', $subContent);
				//$subContent = self::reCompile($subContent);
				return $subContent;
			},
			$content
		);
		
		#include
		$regexp= '/@include\(\'(.*?)\'\)/si';
		$content = preg_replace_callback(
			$regexp,
			function($matches){
				$subContent = file_get_contents('protected/app/views/'.$matches[1]);
				//$subContent = preg_replace('!\s+!', ' ', $subContent);
				//$subContent = self::reCompile($subContent);
				return $subContent;
			},
			$content
		);
		
		
		#html
		//style
		$regexp= '/@style\((.*?)\)/si';
		$replacement= '<?php echo HTML::style($1) ?>';
		$content = preg_replace($regexp, $replacement, $content);
		
		//script
		$regexp= '/@script\((.*?)\)/si';
		$replacement= '<?php HTML::script($1) ?>';
		$content = preg_replace($regexp, $replacement, $content);
		
		#iteration
		//foreach
		$regexp= '/@foreach\((.*?)\)/si';
		$replacement= '<?php echo foreach($1){ ?>';
		$content = preg_replace($regexp, $replacement, $content);
		
		//if
		$regexp= '/@if\((.*?)\)/si';
		$replacement= '<?php if($1){ ?>';
		$content = preg_replace($regexp, $replacement, $content);
		
		$regexp= '/@elseif\((.*?)\)/si';
		$replacement= '<?php }elseif($1){ ?>';
		
		$content = preg_replace($regexp, $replacement, $content);
		$regexp= '/@else/si';
		$replacement= '<?php }else{ ?>';
		$content = preg_replace($regexp, $replacement, $content);
		
		//end
		$regexp= '/@endforeach|@endif/si';
		$replacement= '<?php } ?>';
		$content = preg_replace($regexp, $replacement, $content);
		
		#moving
		
		//show
		$regexp= '/@section\(\'(.*?)\'\)(.*?)@show/si';
		$replacement= '
			[+$1+]$2[+/$1+]
		';
		$content = preg_replace($regexp, $replacement, $content);
		
		//section
		$regexp= '/\[\+(.*?)\+\](.*?)\[\+\/(.*?)\+\]/si';
		$content = preg_replace_callback(
			$regexp,
			function($matches) use($content){
				$regexp= '/@section\(\''.$matches[1].'\'\)(.*?)@stop/si';
				preg_match_all($regexp, $content, $matcheses);
				$content = preg_replace($regexp, '', $content);
				if(isset($matcheses[1][0])){
					return $matcheses[1][0];
				}
			},
			$content
		);
		
		//remove
		$regexp= '/@section(.*?)@stop/si';
		preg_match_all($regexp, $content, $matcheses);
		$content = preg_replace($regexp, '', $content);
		
		
			
		return $content;
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
	
	
	public static function container($var){
		echo $var;
	}
	public static function content($var){
		echo $var;
	}
}