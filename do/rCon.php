<?php
	chdir(dirname(__FILE__));
	include_once('../init.php');
	
	//do things.
	
	
	//get config info
	$gameuserini = @parse_ini_file($_INICONF['settingspath'] . "/GameUserSettings.ini", true);
	
	//verify config info.
	
	$go_ahead	= false;
	try {
		
		if (empty($gameuserini['ServerSettings']['ServerAdminPassword']))	throw new \Exception("'ServerAdminPassword' is required.");
		if (empty($gameuserini['ServerSettings']['RCONEnabled']))			throw new \Exception("'RCONEnabled' must be set to 'true'.");
		if (empty($gameuserini['ServerSettings']['RCONPort']))				throw new \Exception("'RCONPort' not set.");
		
		//if (!empty($_REQUEST) && (empty($_REQUEST['rcon-cmd-string'])))		throw new \Exception("No command issued."); //check for a command in $_POST
		
		if (!empty($_SESSION['need_to_restart']))							throw new \Exception("Server is pending a restart to apply updated configuration.");
		
		require_once($_INICONF['webdocroot'] . '/includes/rconhelp.php');
		
		$_VIEW->assign('rcon_help', $rcon_help);
		
		$go_ahead	= true;
		
	} catch (\Exception $e) {
		$go_ahead	= false;
		$_MSGS[]	= array('type'=>'error', 'msg'=> 'rCon is currently unavailable: ' . $e->getMessage() . ' You can adjust your RCON settings in the <a href="/do/serverConfig.php#authentication">Server Configuration Interface</a>.');
	}
	
	$_VIEW->assign('go_ahead', $go_ahead);
	
	//$_VIEW->assign('things', $stuff);
	$_VIEW->assign('_MSGS', $_MSGS);
	$_VIEW->display('rCon.tpl');