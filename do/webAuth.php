<?php
	chdir(dirname(__FILE__));
	include_once('../init.php');
	
	//do things.
	if (!empty($_POST)) {
		
		$can_update	= true;
		if (empty($_POST['oldpass'])) {
			$_MSGS[]	= array('type'=>'error','msg'=>"Invalid login credentials supplied.");
			$can_update	= false;
		}
		
		if ($_POST['oldpass'] != $_INICONF['webadminpass']) {
			if (md5($_POST['oldpass']) != $_INICONF['webadminpass']) {
				$_MSGS[]	= array('type'=>'error','msg'=>"Invalid login credentials supplied.");
				$can_update	= false;
			}
		}
		
		if (empty($_POST['newpass']) || empty($_POST['newpass2'])) {
			$_MSGS[]	= array('type'=>'error','msg'=>"You must supply the new password and a confirmation.");
			$can_update	= false;
		}
		
		if (strlen($_POST['newpass']) < 5) {
			$_MSGS[]	= array('type'=>'error','msg'=>"New password must be at least 5 characters in length.");
			$can_update	= false;
		}
		
		if ($_POST['newpass'] != $_POST['newpass2']) {
			$_MSGS[]	= array('type'=>'error','msg'=>"New password must match confirmation.");
			$can_update	= false;
		}
		
		if ($_POST['newpass'] == $_POST['oldpass']) {
			$_MSGS[]	= array('type'=>'error','msg'=>"New password must not match current password.");
			$can_update	= false;
		}
		
		if (!empty($can_update)) {
			$_INICONF['webadminpass'] = md5($_POST['newpass']);
			
			$updated	= updateConf($_INICONF);
			
			if (!empty($updated)) {
				header("location: /logout.php");
				die();
			}
			
			$_MSGS[]	= array('type'=>'error','msg'=>"Unable to update password.");
		}

	}
	
	
	//$_VIEW->assign('things', $stuff);
	$_VIEW->assign('_MSGS', $_MSGS);
	$_VIEW->display('webAuth.tpl');