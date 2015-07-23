<?php
	chdir(dirname(__FILE__));
	include_once('../init.php');
	
	//do things.
	
	
	//$_VIEW->assign('things', $stuff);
	$_VIEW->assign('_MSGS', $_MSGS);
	$_VIEW->display('junk.tpl');