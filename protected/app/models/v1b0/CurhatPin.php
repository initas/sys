<?php
namespace model\v1b0;
use \Response;
class CurhatPin extends \BaseModel{
	/*
	|--------------------------------------------------------------------------
	| Basic Setups
	|--------------------------------------------------------------------------
	*/
	protected static $table = 'curhat_pins';
	
	/*
	|--------------------------------------------------------------------------
	| Methods
	|--------------------------------------------------------------------------
	*/
	
	#retrieve
	public static function isPind($curhat_id, $user_id){
		$db = CurhatPin::where('curhat_id', '=', $curhat_id)
			->where('user_id', '=', $user_id)
			->first();
		$response = Response::validateQueryResponse($db);
		if($response['status']==SUCCESS){
			$response = true;
		}else{
			$response = false;
		}
		return $response;
	}
	public static function getCurhatPins($curhat_id){
		$db = User::curhat_pins()->where('curhat_id', '=', $curhat_id)->get();
		$response = Response::validateQueryResponse($db);
		return $response;
	}
	
	#synch
	public static function pin($curhat_id, $user_id){
		self::unpin($curhat_id, $user_id);
		Curhat::curhat_pins()->attach(
			$curhat_id,
			$user_id
		);
	}
	public static function unpin($curhat_id, $user_id){
		Curhat::curhat_pins()->detach(
			$curhat_id,
			$user_id
		);
	}
}