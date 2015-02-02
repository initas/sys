<?php

class BaseController{
	public function checkStatuses($statuses){
		$response = true;
		$statuses = array_unique($statuses);
		foreach($statuses as $val){
			if($val!=SUCCESS && $val!=null){
				$response = false;
			}
		}
		return $response;
	}
}
