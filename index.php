<?php
session_start();
$_POST['baseUrl'] = dirname(__FILE__);



require_once 'protected/vendor/fufuriFramework/function.php';
require_once 'protected/app/constants.php';
require_once 'protected/app/log-constants.php';
require_once 'protected/config/database.php';
require_once 'protected/initial/autoload.php';
require_once 'protected/app/controllers/BaseController.php';
require_once 'protected/app/models/BaseModel.php';
require_once 'protected/app/routes.php';