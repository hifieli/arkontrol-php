<?php
	chdir(dirname(__FILE__));
	include_once('../init.php');
	
	//do things.
	
	
	//get config info
	$gameuserini = @parse_ini_file($_INICONF['settingspath'] . "/GameUserSettings.ini", true, INI_SCANNER_RAW);
	
	//verify config info.
	$go_ahead	= false;
	try {
		
		if (empty($gameuserini['ServerSettings']['ServerAdminPassword']))	throw new \Exception("'ServerAdminPassword' is required." . ' You can adjust your RCON settings in the <a href="/do/serverConfig.php#authentication">Server Configuration Interface</a>.');
		if (empty($gameuserini['ServerSettings']['RCONEnabled']))			throw new \Exception("'RCONEnabled' must be set to 'true'." . ' You can adjust your RCON settings in the <a href="/do/serverConfig.php#authentication">Server Configuration Interface</a>.');
		if (empty($gameuserini['ServerSettings']['RCONPort']))				throw new \Exception("'RCONPort' not set.". ' You can adjust your RCON settings in the <a href="/do/serverConfig.php#authentication">Server Configuration Interface</a>.');
		
	//	if (!empty($_REQUEST) && (empty($_REQUEST['rcon-cmd-string'])))		throw new \Exception("No command issued."); //check for a command in $_POST
		
		if (!empty($_SESSION['need_to_restart']))							throw new \Exception("Server is pending a restart to apply updated configuration.");
		
		$server_status_raw	= exec("service {$_INICONF['servicename']} status");
		if ( strstr($server_status_raw, 'running') === false )				throw new \Exception("Server is not running." . ' You can start the server in the <a href="/do/serverDetails.php">Server Control Interface</a>.');
				
		require_once($_INICONF['webdocroot'] . '/includes/data/rconhelp.php');
		
		$_VIEW->assign('rcon_help', $rcon_help);
		
		//if everything looks good, give the tpl the go ahead ;)
		$go_ahead	= true;
		
	} catch (\Exception $e) {
		
		$go_ahead	= false;
		$_MSGS[]	= array('type'=>'error', 'msg'=> 'rCon is currently unavailable: ' . $e->getMessage());
	
	}
	
	$_VIEW->assign('go_ahead', $go_ahead);
	$_VIEW->assign('_MSGS', $_MSGS);
	$_VIEW->display('rCon.tpl');