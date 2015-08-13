<?php
	chdir(dirname(__FILE__));
	include_once('../init.php');
	
	//do things.
	require_once($_INICONF['webdocroot'] . '/includes/valve_rcon.php');
	
	
	
	//include_once($_INICONF['webdocroot'] . '/includes/gameuserini.php');	//$gameuserini
	//$rCon = new Valve_RCON($gameuserini['GameUserSettings.ini']['ServerSettings']['ServerAdminPassword'], '127.0.0.1', 32330, Valve_RCON::PROTO_CLASSIC);
	$gameuserini = @parse_ini_file($_INICONF['settingspath'] . "/GameUserSettings.ini", true);
	$rCon = new Valve_RCON($gameuserini['ServerSettings']['ServerAdminPassword'], '127.0.0.1', 32330, Valve_RCON::PROTO_CLASSIC);

	
	$rCon->connect();
	$rCon->authenticate();
	$response = $rCon->execute('status');
	$rCon->disconnect();
	
	$_MSGS[]	= array('type'=>'info','msg'=>"<pre>{$response}</pre>");
	
	
	
	//$_VIEW->assign('things', $stuff);
	$_VIEW->assign('_MSGS', $_MSGS);
	$_VIEW->display('rCon.tpl');