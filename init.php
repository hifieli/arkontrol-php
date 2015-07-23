<?php

//chdir(dirname(__FILE__));
require_once('confinc.php');


//check session
if (
	empty($_SESSION) || 
	empty($_SESSION['authed_at']) || 
	empty($_SESSION['authed_from']) || 
	empty($_SESSION['last_act']) || 
	(($_SESSION['authed_from'] != $_SERVER['REMOTE_ADDR']) && (!empty($_INICONF['websessionip']))) ||
	($_SESSION['last_act'] + $_INICONF['webtimeout'] < time())
) {
	session_destroy();
	//show login form
	if ($_SERVER['SCRIPT_NAME'] == '/do/ajax.php') {
		$response	= array('result'=>'error','data'=>array('msg'=>'Invalid session.'));
		$callback	= filter_input(INPUT_GET, 'callback');
		echo $callback . "(" . json_encode($response) . ")";
	} else {
		$went_to = $_SERVER['REQUEST_URI'];
		header("location: /login.php?do={$went_to}"); //{$_INICONF['webdocroot']}/
	}
	die();
}

$_SESSION['last_act']		= time();
$_VIEW->assign('valid_login', true);

// go on, then




