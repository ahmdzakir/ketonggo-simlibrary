<?php
define("base_dir",dirname(__FILE__).'/');
define("core",base_dir.'core/');
define("SESSION_APP",'SESSION_APP');
define("fileindex", basename(__FILE__));

//set prod if ready for production
define('status','dev');
switch (status){
	case 'dev':
		error_reporting(E_ALL ^ E_NOTICE);
		require_once(core.'ErrorHandler.php');
	break;
	case 'prod':
		error_reporting(0);
	break;
}

//run application
require_once(core.'Autoload.php');
try{
	$router = new Router;
	new Core;
	unset($router);
}catch(Exception $e){
	echo $e->getMessage();
}
?>
