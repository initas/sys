<?php
namespace model\v1b0;
use \Response;
class Log extends \BaseModel{
	/*
	|--------------------------------------------------------------------------
	| Basic Setups
	|--------------------------------------------------------------------------
	*/
	protected static $table = 'logs';
	
	/*
	|--------------------------------------------------------------------------
	| Methods
	|--------------------------------------------------------------------------
	*/
	
	#save
	public static function saveLog($log_type_id, $user_id, $table_id = null){
		$response['status'] = UNKNOWN_ERROR;
		
		$log = new Log;
		$log->log_type_id = $log_type_id;
		$log->user_id = $user_id;
		$log->table_id = $table_id;
		
		if($log->save()) {
			$response['status'] = SUCCESS;
			$response['result'] = $log->data;
		}else{
			$response['status'] = VALIDATION_ERROR;
			$response['errors'] = $log->errors;
		}
		
		return $response;
	}
}