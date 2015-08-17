<?php
	chdir(dirname(__FILE__));
	include_once('../init.php');	//init for authenticated areas!
	
	//fetch the defaults for Engrams
//	include_once($_INICONF['webdocroot'] . '/includes/dinospawndefaults.php'); //$dino_defaults
	include_once($_INICONF['webdocroot'] . '/includes/data/creaturespawndefaults.php'); // Provides $creature_defaults, $spawn_defaults
	$dino_defaults	= $spawn_defaults;	//for now, this is safer than refactoring.
	$_VIEW->assign('dino_defaults', $dino_defaults);
	
	//grab our Game.ini modeller
	require_once($_INICONF['webdocroot'] . '/includes/class/class.GameIniFixer.php');
	$iniGame	= new GameIniFixer($_INICONF);
	
	//set the combined to the defaults as a base.
	$dino_combined	= $dino_defaults;
	
	//assuming we got info from the ini:
	if (!empty($iniGame->gameini)) {
		
		//Build section if not there
		if (empty($iniGame->gameini['/script/shootergame.shootergamemode'])) {
			$iniGame->gameini['/script/shootergame.shootergamemode'] = array();
		}
		
		//Build DinoSpawnWeightMultipliers array if not there.
		if (empty($iniGame->gameini['/script/shootergame.shootergamemode']['DinoSpawnWeightMultipliers'])) {
			$iniGame->gameini['/script/shootergame.shootergamemode']['DinoSpawnWeightMultipliers'] = array();
		}
		//Get a smaller variable
		$Dinos	= $iniGame->gameini['/script/shootergame.shootergamemode']['DinoSpawnWeightMultipliers'];
		
		//send it to the view for debugging 
		$_VIEW->assign('dino_alreadyini', $Dinos);
		
		//assuming we found entries for DinoSpawnWeightMultipliers already in the INI file,
		if (!empty($Dinos)) {
		
			//carefully merge the INI details over the defaults.
			foreach ($Dinos as $idx => $iniinfo) {
				//DinoNameTag=<tag>[,SpawnWeightMultiplier=<factor>][,OverrideSpawnLimitPercentage=<override>][,SpawnLimitPercentage=<limit>])
		
				$defaults									= $dino_defaults[ $iniinfo['DinoNameTag'] ];
				$iniinfo['OverrideSpawnLimitPercentage']	= isset($iniinfo['OverrideSpawnLimitPercentage'])	? $iniinfo['OverrideSpawnLimitPercentage']	: $defaults['OverrideSpawnLimitPercentage'];
				$iniinfo['SpawnWeightMultiplier']			= isset($iniinfo['SpawnWeightMultiplier'])			? $iniinfo['SpawnWeightMultiplier']			: $defaults['SpawnWeightMultiplier'];
				$iniinfo['SpawnLimitPercentage']			= isset($iniinfo['SpawnLimitPercentage'])			? $iniinfo['SpawnLimitPercentage']			: $defaults['SpawnLimitPercentage'];
				
				$iniinfo['name']							= $defaults['name'];
				
				if (isset($defaults['thumbnail'])) {
					$iniinfo['thumbnail']					= $defaults['thumbnail'];
				}
				
				$dino_combined[ $iniinfo['DinoNameTag'] ]	= $iniinfo;
			
			}
			
		}
	}
	
	
	if (!empty($_POST)) {
		//We are updating. Good thing we already have a combined list of the defaults plus the current config.
		//So, we should just be able to foreach through the combined list, look for changes in the postdata, and then write() the ini file.
		
		//Make a snapshot, just in case. We make it before we change anything.
		require_once($_INICONF['webdocroot'] . '/includes/class/class.snapshot.php');
		$snapshot		= new snapshot($_INICONF);
		$saved			= $snapshot->create(null, 'snapshot');
		
		$dinos_towrite	= array();
		foreach ($dino_combined as $id => $info) {

			$dino_combined[ $id ]['OverrideSpawnLimitPercentage']	= (isset($_POST["OverrideSpawnLimitPercentage_{$id}"]))	? (empty($_POST["OverrideSpawnLimitPercentage_{$id}"])?'false':'true')	: $dino_combined[ $id ]['OverrideSpawnLimitPercentage'];
			$dino_combined[ $id ]['SpawnWeightMultiplier']			= (isset($_POST["SpawnWeightMultiplier_{$id}"]))		? $_POST["SpawnWeightMultiplier_{$id}"]									: $dino_combined[ $id ]['SpawnWeightMultiplier'];
			$dino_combined[ $id ]['SpawnLimitPercentage']			= (isset($_POST["SpawnLimitPercentage_{$id}"]))			? $_POST["SpawnLimitPercentage_{$id}"] / 100							: $dino_combined[ $id ]['SpawnLimitPercentage'];
			
			$dinos_towrite[ $id ] = $dino_combined[ $id ];
			unset($dinos_towrite[ $id ]['name']);
			unset($dinos_towrite[ $id ]['thumbnail']);
		}

		
		$iniGame->gameini['/script/shootergame.shootergamemode']['DinoSpawnWeightMultipliers'] = $dinos_towrite;
		$iniGame->write();
		
		//there were diffs, make sure we send a message telling them to restart ARK dedicated server.
		$_SESSION['need_to_restart'] = true;
	}
	
	//Assign our combined array: the defaults, with any values gleaned from the INI merged in, with any new details from the POST data merged in.
	$_VIEW->assign('dino_combined', $dino_combined);	
	
	
	$_VIEW->assign('_MSGS', $_MSGS);
	$_VIEW->display('serverConfigSpawn.tpl');
	