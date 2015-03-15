<?php
namespace securhat\web\v1b0;
use securhat\api\v1b0\CurhatController as CurhatApi; 
use securhat\api\v1b0\CurhatCommentController as CurhatCommentApi; 
use securhat\api\v1b0\UserController as UserApi; 
use \View;
class WelcomeController extends \BaseController{
	/*--- Implemented Controller ---*/
	public function index(){
		
		$response = array();
		
		$curhatApi = new CurhatApi;
		$index = $curhatApi->setReuse()->index();
		$response['curhats_total'] = $index['results']['total'];
		
		$userApi = new UserApi;
		$index = $userApi->setReuse()->index();
		$response['users_total'] = $index['results']['total'];
		
		
		$curhatCommentApi = new CurhatCommentApi;
		$index = $curhatCommentApi->setReuse()->index();
		$response['curhat_comments_total'] = $index['results']['total'];
		
		return View::compile('securhat/v1b0/lp/pages/index.php')->set('response', $response)->make();
	}
}