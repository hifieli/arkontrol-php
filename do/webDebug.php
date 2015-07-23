<?php
	chdir(dirname(__FILE__));
	include_once('../init.php');	//init for authenticated areas!
	
	//do things.
	
	//parse the game's ini files, or something
	//maybe run a systemctl status command
	//get some CPU, RAM, and Disk metrics
	//bandwidth?
	//game log file overview
	//maybe check with an RSS feed of some kind for news and updates
	
	
	//$_VIEW->assign('things', $stuff);
	//$_VIEW->assign('_MSGS', $_MSGS);
	$_VIEW->display('webDebug.tpl');
	
// $_INICONF['weasels'] = "are only ferrets.";
// $_INICONF['webtimeout'] = "700";
// echo updateConf( $_INICONF );
	
// echo "<h1>Welcome back {$_INICONF['webadminname']}!</h1>";
// echo '<pre>';
// print_r($_INICONF);
// print_r($_SERVER);
// print_r($_SESSION);