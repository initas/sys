<?php
class Response{
	public static function json($response){
		if(isset($_GET['callback'])){
			header('Content-type: application/json', true, 200);
			echo $_GET['callback'].'(' .json_encode($response).');';
		}else if(isset($_GET['reuse'])){
			return $response;
		}else{
			header('Content-type: application/json', true, 200);
			echo json_encode($response);
		}
		exit();
	}
	public static function stop($response){
		echo $response;
		exit();
	}
	public static function validateQueryResponse($db){
		$response['status'] = UNKNOWN_ERROR;
		if($db->data!=null){
			$response['status'] = SUCCESS;
			if(isset($db->data[0])){
				$response['results']['total'] = $db->total;
				if($db->paginate!=null){
					$response['results']['per_page'] = $db->paginate['perPage'];
					$response['results']['current_page'] = $db->paginate['currentPage'];
					$response['results']['last_page'] = $db->paginate['lastPage'];
					$response['results']['from'] = $db->paginate['from'];
					$response['results']['to'] = $db->paginate['to'];
				}
				$response['results']['data'] = $db->data;
			}else{
				$response['result'] = $db->data;
			}
		}elseif($db->error!=null){
			$response['status'] = VALIDATION_FAIL;
			$response['error'] = $db->error;
		}
		return $response;
	}
}