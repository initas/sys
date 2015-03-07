<?php
namespace securhat\web\v1b0;
use securhat\api\v1b0\CurhatController as CurhatApi; 
use \View;
class CurhatController extends \BaseController{
	/*--- Implemented Controller ---*/
	public function index(){
		$curhatApi = new CurhatApi;
		$index = $curhatApi->setReuse()->index();
		return View::compile('securhat/v1b0/curhat.php')->set('response', $index)->make();
	}
}