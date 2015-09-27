<?php
class Login extends Controller{
	function __construct(){
		$this->xss_clean = true;
		parent::__construct();
		session_start();
	}
	function _actionIndex(){
		if($_SESSION[SESSION_APP]['login'])
		{
			URL::Redirect('panelbackend');
		}
		else
		{
			$this->PartialView('panelbackend/login');
		}
	}
	function _actionAuth(){
		$model = new AuthModel();
		echo json_encode($model->Login($this->post['username'],$this->post['password']));
	}
	function _actionLogout(){
		$_SESSION[SESSION_APP]['login']=false;
		unset($_SESSION[SESSION_APP]);
		URL::Redirect('panelbackend');
	}
}
