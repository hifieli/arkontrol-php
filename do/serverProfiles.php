<?php
	chdir(dirname(__FILE__));
	include_once('../init.php');
	
	//do things.
	require_once($_INICONF['webdocroot'] . '/includes/class.snapshot.php');
	$snapshot		= new snapshot($_INICONF);
	
	if (!empty($_POST)) {
		if (!empty($_POST['action'])) {
			
			$type			= (!empty($_POST['type']))			? $_POST['type']			: 'custom';
			$profile_name	= (!empty($_POST['profile_name']))	? $_POST['profile_name']	: 'totallybogus87asjhfiuf9832hsdkjsdf'; 


			$profile_data	= $snapshot->get($profile_name, $type);
			$_VIEW->assign('profile', $profile_name);
			
			
			if ($_POST['action'] == 'download') {
				header("Content-Type: application/json");
				header("Content-Disposition: {$profile_name}");
				echo json_encode($profile_data);
				die();
			}
		
			if ($_POST['action'] == 'view') {
				if (!empty($profile_data)) {
					$_VIEW->assign('profile_data', $profile_data);
					$_VIEW->assign('_MSGS', $_MSGS);
					$_VIEW->display('serverProfileView.tpl');
					die();
				} else {
					$_MSGS[]	= array('type'=>'error','msg'=>"Unable to view configuration profile `{$profile_name}`.");
				}
			}
			
			if ($_POST['action'] == 'delete') {
				$removed	= $snapshot->delete($profile_name, $type);
				if (!empty($removed)) {
					$_MSGS[]	= array('type'=>'info','msg'=>"arkontrol has deleted the configuration profile `{$profile_name}`.");
				} else {
					$_MSGS[]	= array('type'=>'error','msg'=>"Unable to delete configuration profile `{$profile_name}`.");
				}
			}
			
			if ($_POST['action'] == 'restore') {
				
				$cmd	= "sudo chmod 666 {$_INICONF['settingspath']}/*";
				exec($cmd);
				
				$restored	= $snapshot->restore($profile_name, $type);
				
				if (!empty($restored)) {
					$_MSGS[]	= array('type'=>'info','msg'=>"arkontrol has restored the configuration profile `{$profile_name}`.");
					// make sure we send a message telling them to restart ARK dedicated server.
					$_SESSION['need_to_restart'] = true;
				} else {
					$_MSGS[]	= array('type'=>'error','msg'=>"Restoration of configuration profile `{$profile_name}` has failed.");
				}
			}
			
			if ($_POST['action'] == 'save') {
				
				$cmd	= "sudo chmod 666 {$_INICONF['settingspath']}/*";
				exec($cmd);
				
				$saved	= $snapshot->create($profile_name, $type);
				if (!empty($saved)) {
					$_MSGS[]	= array('type'=>'info','msg'=>"arkontrol has saved the configuration profile `{$profile_name}`.");
				} else {
					$_MSGS[]	= array('type'=>'error','msg'=>"Unable to save configuration profile `{$profile_name}`.");
				}
			}
		}
	}
	
	
	$profiles_snapshot	= $snapshot->list_profiles("snapshot");
	$profiles_custom	= $snapshot->list_profiles("custom");
	
	$_VIEW->assign('profiles_snapshot', $profiles_snapshot);
	$_VIEW->assign('profiles_custom', $profiles_custom);
	$_VIEW->assign('_MSGS', $_MSGS);
	$_VIEW->display('serverProfiles.tpl');