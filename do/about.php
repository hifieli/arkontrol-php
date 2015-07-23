<?php
	chdir(dirname(__FILE__));
	include_once('../confinc.php'); //non-authenticated
	
	//do things.
	
	
	//$_VIEW->assign('things', $stuff);
	$_VIEW->assign('_MSGS', $_MSGS);
	$_VIEW->display('about.tpl');