<?php

require_once('confinc.php');

$valid_login = false;

//process login creds if supplied.
if (!empty($_POST['username']) && !empty($_POST['password'])) {
	
	//try plaintext first
	if (($_POST['username'] == $_INICONF['webadminname']) &&
		($_POST['password'] == $_INICONF['webadminpass']) ){
		
		$valid_login = true;
		
	}
	
	//try hashed (weak) next
	else if (($_POST['username']  == $_INICONF['webadminname']) &&
		 (md5($_POST['password']) == $_INICONF['webadminpass']) ){
		
		$valid_login = true;
		
	} 
	
	//credentials supplied, but do not match.
	else {
		$_MSGS[] = array('type'=>'error','msg'=>"Invalid login credentials supplied.");
	}
	
	//valid logins get redirected to dashboard
	if (!empty($valid_login)) {
		
		//session_start();
		$_SESSION['authed_from']	= $_SERVER['REMOTE_ADDR'];
		$_SESSION['authed_at']		= time();
		$_SESSION['last_act']		= time();
		session_write_close();

		$send_to = ($_GET['do']) ? $_GET['do'] : '/do/dashboard.php';

		header("location: {$_GET['do']}");
		die();
		
	}
}

//no creds, or invalid creds. show login form.

$_VIEW->assign('_MSGS', $_MSGS);
$_VIEW->display('login.tpl');