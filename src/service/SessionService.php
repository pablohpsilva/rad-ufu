<?php

class SessionService{
	private $userinfo;
	private $cache;

	public function checkSession(){
		if (isset($_COOKIE[session_name()]))
    		setcookie(session_name(), '', time()-42000, '/');
	}

	public function login(){
		session_start();
		$userinfo = array();
		$cache = array();
		$_SESSION['userinfo'] = $userinfo;
		$_SESSION['cache'] = $cache;
	}

	public function logout(){
		session_destroy();
	}

}


?>