<?php
namespace model\v1b0;
use model\v1b0\Curhat;
use \Response;
class CurhatAttachment extends \BaseModel{
	/*
	|--------------------------------------------------------------------------
	| Basic Setups
	|--------------------------------------------------------------------------
	*/
	protected static $table = 'curhat_attachments';
	
	/*
	|--------------------------------------------------------------------------
	| Methods
	|--------------------------------------------------------------------------
	*/
	
	#retrieve
	public static function getCurhatAttachments($curhat_id){
		$db = CurhatAttachment::where('curhat_id', '=', $curhat_id)->get();
		$response = Response::validateQueryResponse($db);
		return $response;
	}
	
	#synch
	public static function synchCurhatAttachments($curhat_id, $image_id){
		Curhat::curhat_attachment()->synch(
			$curhat_id,
			$image_id
		);
	}
}