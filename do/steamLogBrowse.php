<?php
	chdir(dirname(__FILE__));
	include_once('../init.php');
	
	//do things.
	
	$logfiles	= scandir($_INICONF['steamlogpath']);
	
	$_VIEW->assign('logfiles', $logfiles);
	$_VIEW->assign('_MSGS', $_MSGS);
	$_VIEW->display('browseLogs.tpl');