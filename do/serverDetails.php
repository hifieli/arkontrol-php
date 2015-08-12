<?php
	chdir(dirname(__FILE__));
	include_once('../init.php');
	
	//do things.
	
	$logwatch	= false;
	$pretty_cmd	= '';
	$need_to_restart = false;
	
	// Handle any requested action
	if (!empty($_POST)) {
		
		$issue_cmd	= '';
		switch ($_POST['action']) {
			
			case 'start':
				$pretty_cmd	= 'start';
				$issue_cmd	= "sudo -u www-data sudo service {$_INICONF['servicename']} start";
				$_MSGS[]	= array('type'=>'info','msg'=>"arkontrol has issued the `start` command to the server.");
			break;
			case 'stop':
				$pretty_cmd	= 'stop';
				$issue_cmd	= "sudo -u www-data sudo service {$_INICONF['servicename']} stop";
				$_MSGS[]	= array('type'=>'info','msg'=>"arkontrol has issued the `stop` command to the server.");
			break;
			case 'restart':
				$pretty_cmd	= 'restart';
				$issue_cmd	= "sudo -u www-data sudo service {$_INICONF['servicename']} restart";
				$_MSGS[]	= array('type'=>'info','msg'=>"arkontrol has issued the `restart` command to the server.");
			break;
			case 'update':
				$pretty_cmd	= 'update';
				$issue_cmd	= "sudo -u www-data sudo service {$_INICONF['servicename']} stop && sudo -u steam {$_INICONF['steamcmdbin']} +login anonymous +force_install_dir {$_INICONF['force_install_dir']} +app_update {$_INICONF['steamappid']} +quit"; // | tee /tmp/update.log
				$logwatch	= true;
				$_MSGS[]	= array('type'=>'info','msg'=>"arkontrol has issued the `update` command to the server. This process may some time to complete. Please don't forget, after the update, your server will be offline, and must be (re)started.");
			break;
			case 'reinstall':
				//we should stop it first.
				$pretty_cmd	= 'reinstall';
				$issue_cmd	= "sudo -u www-data sudo service {$_INICONF['servicename']} stop && sudo rm -rf /home/steam/ark_ds/* && sudo -u steam {$_INICONF['steamcmdbin']} +login anonymous +force_install_dir {$_INICONF['force_install_dir']} +app_update {$_INICONF['steamappid']} +quit"; // | tee /tmp/update.log
			//	$issue_cmd	= "sudo rm -rf {$_INICONF['force_install_dir']}/* && sudo -u steam /home/steam/steamcmd/steamcmd.sh +login anonymous +force_install_dir {$_INICONF['force_install_dir']} +app_update {$_INICONF['steamappid']} +quit";
				$logwatch	= true;
				$_MSGS[]	= array('type'=>'info','msg'=>"arkontrol has issued the `reinstall` command to the server. This process will take some time to complete.");
			break;
			case 'reconfig':
				$pretty_cmd	= 'reconfig';
				//look at post, update configs, issue a restart
				
				$issue_cmd	= "sudo -u www-data sudo service {$_INICONF['servicename']} restart";
				$_MSGS[]	= array('type'=>'info','msg'=>"arkontrol has updated the configuration and has issued the `restart` command to the server.");
			break;
			default:
				$pretty_cmd	= 'unknown';
				$issue_cmd	= '';
				$_MSGS[]	= array('type'=>'info','msg'=>"arkontrol did not understand your request, and did not issue any commands.");
		}
		
		if (!empty($issue_cmd)) {
			
			$destination = ($logwatch) ? '| tee /tmp/update.log' : '> /dev/null';
			
			$response = exec($issue_cmd . " {$destination} &");
			
			//$response = exec($issue_cmd);
			//$_MSGS[]	= array('type'=>'info','msg'=>"response: {$response}");
			
			if ($issue_cmd != 'start') {
				unset($_SESSION['need_to_restart']);
			}
		}
		
		
		
	}
	
	
	$_VIEW->assign('logwatch', $logwatch);
	$_VIEW->assign('pretty_cmd', $pretty_cmd);
	$_VIEW->assign('_MSGS', $_MSGS);
	$_VIEW->display('serverDetails.tpl');