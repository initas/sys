<?php
namespace model\v1b0;
use \Response;
class CurhatAttachment extends \BaseModel{
	/*
	|--------------------------------------------------------------------------
	| Basic Setups
	|--------------------------------------------------------------------------
	*/
	protected static $table = 'curhat_attachments';
	
	#retrieve
	public static function getCurhatAttachments($curhat_id){
		$db = CurhatAttachment::where('curhat_id', '=', $curhat_id)->paginate();
		$response = Response::validateQueryResponse($db);
		return $response;
	}
}