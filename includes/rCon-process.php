<?php
	chdir(dirname(__FILE__));
	include_once('../init.php');
	
	//provides $rcon_request and $rcon_response
	
	//do things.
	$rcon_response	= 'General Failure';
	$rcon_request	= '';
	
	//get config info
	$gameuserini = @parse_ini_file($_INICONF['settingspath'] . "/GameUserSettings.ini", true);
	
	//verify config info.
	$go_ahead	= false;
	try {
		if (empty($_REQUEST['rcon-cmd-string']))							throw new \Exception("No command issued."); //check for a command in $_POST
		$rcon_request	= trim($_REQUEST['rcon-cmd-string']);
		
		if (empty($gameuserini['ServerSettings']['ServerAdminPassword']))	throw new \Exception("'ServerAdminPassword' is required.");
		if (empty($gameuserini['ServerSettings']['RCONEnabled']))			throw new \Exception("'RCONEnabled' must be set to 'true'.");
		if (empty($gameuserini['ServerSettings']['RCONPort']))				throw new \Exception("'RCONPort' not set.");
		
		if (!empty($_SESSION['need_to_restart']))							throw new \Exception("Server is pending a restart to apply updated configuration.");
		
		$server_status_raw	= exec("service {$_INICONF['servicename']} status");
		if ( strstr($server_status_raw, 'running') === false )				throw new \Exception("Server is not running.");
		
		$go_ahead	= true;
		
	} catch (\Exception $e) {
		
		$go_ahead		= false;
		$rcon_response	= 'rCon is currently unavailable: ' . $e->getMessage() . ' You can adjust your RCON settings in the <a href="/do/serverConfig.php#authentication">Server Configuration Interface</a>.';
		
	}
	
	//verify command
	if (!empty($go_ahead)) {
		
		$user_cmd	= trim($rcon_request);				//the command as the user typed it
		$cmd_check	= explode(' ', trim($user_cmd));	//split it on the space character to isolate the command itself
		$cmd_only	= trim($cmd_check[0]);				//woomp. there it is.
		
		require_once($_INICONF['webdocroot'] . '/includes/rconhelp.php');	//provides $rcon_help
		
		if (!in_array($cmd_only, array_keys($rcon_help))) {
			
			$rcon_response = "Unknown or Restricted rCon command issued.";
			
		} else {
			
			try {
				$rcon_request	= $user_cmd;
				
				//issue the command
				require_once($_INICONF['webdocroot'] . '/includes/class.valve_rcon.php');
				$rCon = new Valve_RCON($gameuserini['ServerSettings']['ServerAdminPassword'], '127.0.0.1', $gameuserini['ServerSettings']['RCONPort'], Valve_RCON::PROTO_SOURCE);
				$rCon->connect();
				$rCon->authenticate();
				$rcon_response = trim($rCon->execute($user_cmd));
				$rCon->disconnect();
				
				if (empty($rcon_response) || $rcon_response == 'Server received, But no response!!') {
					$rcon_response	= '{Empty Response}';
				}
				
			} catch (\Exception $e) {
				$rcon_response	= 'rCon Exception: ' . $e->getMessage();
			}
			
		}
	}
	
	//Several of those trim()s are redundant. But you can never trim too much. That's a lesson that will serve anyone until the end of their days.