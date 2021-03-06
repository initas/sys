<?php
namespace model\v1b0;
use \Auth;
use \Response;
class Curhat extends \BaseModel{
	/*
	|--------------------------------------------------------------------------
	| Basic Setups
	|--------------------------------------------------------------------------
	*/
	protected static $table = 'curhats';
	protected static $append = array(
		'detail',
		'log_on_user'
	);
	
	public static $relationsData = array(
		'user'				=> array(self::BELONGS_TO, 'model\v1b0\User'),
		'to_user'			=> array(self::BELONGS_TO, 'model\v1b0\User'),
		'curhat_attachment' => array(self::BELONGS_TO_MANY, 'model\v1b0\Image', 'curhat_attachments'),
		'curhat_likes'		=> array(self::BELONGS_TO_MANY, 'model\v1b0\User', 'curhat_likes'),
		'curhat_pins'		=> array(self::BELONGS_TO_MANY, 'model\v1b0\User', 'curhat_pins'),
	);
	
	
	/*
	|--------------------------------------------------------------------------
	| Validation Setups
	|--------------------------------------------------------------------------
	*/
	
	public static function setRules() 
    {
    	$rules = array();
    	$messages = array();

    	$rules['card_id'] = 'required|integer';
    	$rules['overall_rating'] = 'required|integer';
		
        self::$rules = $rules;
        self::$customMessages = $messages;
    } 
	
	/*
	|--------------------------------------------------------------------------
	| Methods
	|--------------------------------------------------------------------------
	*/
	
	#retrieve
	public static function getCurhats(){
		$db = Curhat::paginate();
		//$db = self::append($db, array('detail', 'log_on_user'));
		$response = Response::validateQueryResponse($db);
		return $response;
		// user curhat only
	}
	public static function getUserCurhats($user_id){
		$db = Curhat::where('user_id', '=', $user_id)->paginate();
		$response = Response::validateQueryResponse($db);
		return $response;
		// user curhat only
	}
	public static function getUserCurhatStreams($user_id){
		$db = Curhat::raw('
				select *
				from curhats
				where( 
					user_id in(
						SELECT a.to_user_id
						FROM friends a, friends b
						WHERE a.user_id = b.to_user_id
						AND b.user_id = a.to_user_id
						AND a.user_id = '.$user_id.'
					) or user_id = '.$user_id.'
					or to_user_id = '.$user_id.'
				)
			')
			->paginate();
		$response = Response::validateQueryResponse($db);
		return $response;
		/*
		| user curhat
		| user friend curhats
		| curhat mentioned user
		*/
	}
	public static function getUserPublicCurhats($user_id){
		$db = Curhat::where('id_fms_sm_member', '=', $user_id)
			->orwhere('id_to_member', '=', $user_id)
			->paginate();
		$response = Response::validateQueryResponse($db);
		return $response;
		/*
		| user curhat
		| curhat mentioned user
		*/
	}
	public static function getFromUserCurhats($user_id){
		$db = Curhat::
			where('user_id', '=', $user_id)
			->where('to_user_id', '>', 0)
			->paginate();
		$response = Response::validateQueryResponse($db);
		return $response;
		// curhat mentioned user
	}
	public static function getToUserCurhats($user_id){
		$db = Curhat::where('to_user_id', '=', $user_id)->paginate();
		$response = Response::validateQueryResponse($db);
		return $response;
		// curhat mentioned user
	}
	public static function getCurhat($curhat_id){
		$db = Curhat::find($curhat_id);
		$response = Response::validateQueryResponse($db);
		return $response;
		// curhat by id
	}
	public static function getCurhatChilds($curhat_id){
		$db = Curhat::where('parent_id', '=', $curhat_id)->get();
		$response = Response::validateQueryResponse($db);
		return $response;
		// curhat by id
	}
	
	
	#create
	public static function getCurhatOptions(){
	}
	
	#edit
	public static function editCurhat($curhat_id){
		$db = Curhat::find($curhat_id);
		$response = Response::validateQueryResponse($db);
		return $response;
	}
	
	#save
	public static function saveCurhat($user_id){
		$response['status'] = UNKNOWN_ERROR;
		
		$curhat = new Curhat;
		$curhat->user_id = $user_id;
		
		$curhat->fillable = array(
			'to_user_id',
			'description'
		);
		
		if($curhat->save()) {
			$response['status'] = SUCCESS;
			$response['result'] = $curhat->data;
			Log::saveLog(SAVE_CURHAT, $user_id, $curhat->data['id']);
		}else{
			$response['status'] = VALIDATION_ERROR;
			$response['errors'] = $curhat->errors;
		}
		
		return $response;
	}
	
	#update
	public static function updateCurhat($user_id, $curhat_id){
		$response['status'] = UNKNOWN_ERROR;
		
		$curhat = new Curhat;
		$curhat->user_id = $user_id;
		$curhat->parent_id = $curhat_id;
		
		$curhat->fillable = array(
			'to_user_id',
			'description'
		);
		
		if($curhat->save()) {
			$response['status'] = SUCCESS;
			$response['result'] = $curhat->data;
			Log::saveLog(UPDATE_CURHAT, $user_id, $curhat->data['id']);
		}else{
			$response['status'] = VALIDATION_ERROR;
			$response['errors'] = $curhat->errors;
		}
		
		return $response;
	}
	
	#delete
	public static function deleteCurhat($curhat_id){
		$result = Curhat::delete();
	}
	
	#append
	public static function append_log_on_user($result){
		$curhat_id = $result['id'];
		$userLoginData = Auth::getUserLoginData();
		$user_id = $userLoginData['result']['id'];
		$response['is_liked'] = CurhatLike::isLiked($curhat_id, $user_id);
		$response['is_pinned'] = CurhatPin::isPinned($curhat_id, $user_id);
		return $response;
	}
	public static function append_detail($result){
		$curhat_id = $result['id'];
		
		$response['childs'] = null;
		$getCurhatChilds = self::getCurhatChilds($curhat_id);
		if($getCurhatChilds['status'] == SUCCESS){
			$response['childs'] = $getCurhatChilds['results'];
		}
		
		$response['images'] = null;
		$getCurhatAttachment = CurhatAttachment::getCurhatAttachments($curhat_id);
		if($getCurhatAttachment['status'] == SUCCESS){
			$response['images'] = $getCurhatAttachment['results'];
		}
		
		$response['likes'] = null;
		$getCurhatLikes = CurhatLike::getCurhatLikes($curhat_id);
		if($getCurhatLikes['status'] == SUCCESS){
			$response['likes'] = $getCurhatLikes['results'];
		}
		
		$response['comments'] = null;
		$getCurhatComments = CurhatComment::getCurhatComments($curhat_id);
		if($getCurhatComments['status'] == SUCCESS){
			$response['comments'] = $getCurhatComments['results'];
		}
		
		return $response;
	}
	
	
	
}