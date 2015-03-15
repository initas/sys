<?php
namespace securhat\web\v1b0;
use securhat\api\v1b0\CurhatController as CurhatApi; 
use securhat\api\v1b0\UserController as UserApi; 
use \View;
class HomeController extends \BaseController{
	/*--- Implemented Controller ---*/
	public function index(){
		$curhatApi = new CurhatApi;
		$index = $curhatApi->setReuse()->index();
		$response['curhats'] = $index;
		return View::compile('securhat/v1b0/app/pages/index.php')->set('response', $response)->make();
	}
}