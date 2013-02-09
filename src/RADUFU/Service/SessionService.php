<?php

class SessionService{
	private $userinfo;
	private $cache;

	public function createSession(){
		session_start();
	}

	public function deleteSession(){
		if (isset($_COOKIE[session_name()]))
    		setcookie(session_name(), '', time()-42000, '/');
		session_destroy();
	}

	public function checkSession(){
		if(isset($_SESSION['userinfo']))
    		self::deleteSession();
    	else
    		self::createSession();
	}

	public function login(){
		self::createSession();
		$userinfo = array();
		$cache = array();
		$_SESSION['userinfo'] = $userinfo;
		$_SESSION['cache'] = $cache;
	}

	public function logout(){
		self::deleteSession();
	}

}


?>