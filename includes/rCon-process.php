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
		
		if (empty($_REQUEST['rcon-cmd-string']))							throw new \Exception("No command issued."); //check for a command in $_POST
		
		if (!empty($_SESSION['need_to_restart']))							throw new \Exception("Server is pending a restart to apply updated configuration.");
		
		$go_ahead	= true;
		
	} catch (\Exception $e) {
		
		$go_ahead		= false;
		$rcon_response	= 'rCon is currently unavailable: ' . $e->getMessage() . ' You can adjust your RCON settings in the <a href="/do/serverConfig.php#authentication">Server Configuration Interface</a>.';
		
	}
	
	//verify command
	if (!empty($go_ahead)) {
		
		$user_cmd	= trim($_REQUEST['rcon-cmd-string']);	// the command as the user typed it
		$cmd_check	= explode(' ', trim($user_cmd));		//split it on the space character to isolate the command iteself
		$cmd_only	= trim($cmd_check[0]);					//woomp. there it is.
		
		require_once($_INICONF['webdocroot'] . '/includes/rconhelp.php');	//provides $rcon_help
		
		if (!in_array($cmd_only, array_keys($rcon_help))) {
			
			$rcon_response = "Unknown or Restricted rCon command issued.";
			
		} else {
			
			//issue the command
			require_once($_INICONF['webdocroot'] . '/includes/class.valve_rcon.php');
			$rCon = new Valve_RCON($gameuserini['ServerSettings']['ServerAdminPassword'], '127.0.0.1', $gameuserini['ServerSettings']['RCONPort'], Valve_RCON::PROTO_SOURCE);
			$rCon->connect();
			$rCon->authenticate();
			$rcon_response = $rCon->execute($user_cmd);
			$rCon->disconnect();
			
		}
	}
	
	$_VIEW->assign('rcon_response', $rcon_response);
	
	//$_VIEW->assign('things', $stuff);
	$_VIEW->assign('_MSGS', $_MSGS);
	//$_VIEW->display('rCon.tpl');