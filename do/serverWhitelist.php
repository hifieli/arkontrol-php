<?php
	chdir(dirname(__FILE__));
	include_once('../init.php');
	
	//do things.


	if (!empty($_POST)) {
		if (isset($_POST['new_whitelist'])) {
		//	file_put_contents($_INICONF[''] . "/{}", $_POST['new_whitelist']);
			file_put_contents("/home/steam/ark_ds/ShooterGame/Saved/AllowedCheaterSteamIDs.txt", $_POST['new_whitelist']);
			
			$_SESSION['need_to_restart'] = true;
		}
	}

	$whitelist_contents	= file_get_contents("/home/steam/ark_ds/ShooterGame/Saved/AllowedCheaterSteamIDs.txt");


	$_VIEW->assign('whitelist_contents', $whitelist_contents);
	$_VIEW->assign('_MSGS', $_MSGS);
	$_VIEW->display('serverWhiteList.tpl');