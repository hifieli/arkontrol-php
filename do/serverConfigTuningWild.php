<?php

//damage and resistance for wild creatures.

	chdir(dirname(__FILE__));
	include_once('../init.php');	//init for authenticated areas!
	
	//fetch the defaults for Damage and Resistance of wild creatures.
	include_once($_INICONF['webdocroot'] . '/includes/data/damreswilddefaults.php'); //$creature_defaults, $untamables, $taming_defaults, $dinodamres_dmg_defaults, and $dinodamres_res_defaults
	$_VIEW->assign('dinodamres_dmg_defaults', $dinodamres_dmg_defaults);
	$_VIEW->assign('dinodamres_res_defaults', $dinodamres_res_defaults);
	
	//grab our Game.ini modeller
	require_once($_INICONF['webdocroot'] . '/includes/class/class.GameIniFixer.php');
	$iniGame	= new GameIniFixer($_INICONF);
	
	//set the combined to the defaults as a base.
	$dinodamres_dmg_combined	= $dinodamres_dmg_defaults;
	$dinodamres_res_combined	= $dinodamres_res_defaults;
	
	//assuming we got info from the ini:
	if (!empty($iniGame->gameini)) {
		
		//Build section if not there
		if (empty($iniGame->gameini['/script/shootergame.shootergamemode'])) {
			$iniGame->gameini['/script/shootergame.shootergamemode'] = array();
		}
		
		//Build DinoClassDamageMultipliers array if not there.
		if (empty($iniGame->gameini['/script/shootergame.shootergamemode']['DinoClassDamageMultipliers'])) {
			$iniGame->gameini['/script/shootergame.shootergamemode']['DinoClassDamageMultipliers'] = array();
		}
		//Build DinoClassResistanceMultipliers array if not there.
		if (empty($iniGame->gameini['/script/shootergame.shootergamemode']['DinoClassResistanceMultipliers'])) {
			$iniGame->gameini['/script/shootergame.shootergamemode']['DinoClassResistanceMultipliers'] = array();
		}		
		
		//Get a smaller variable
		$Damages		= $iniGame->gameini['/script/shootergame.shootergamemode']['DinoClassDamageMultipliers'];
		$Resistances	= $iniGame->gameini['/script/shootergame.shootergamemode']['DinoClassResistanceMultipliers'];
		
		//send it to the view for debugging 
		$_VIEW->assign('damages_alreadyini', $Damages);
		$_VIEW->assign('resistances_alreadyini', $Resistances);
		
		
		//assuming we found entries for DinoClassDamageMultipliers already in the INI file,
		if (!empty($Damages)) {
		
			//carefully merge the INI details over the defaults.
			foreach ($Damages as $idx => $iniinfo) {
				//DinoClassDamageMultipliers=(ClassName="Ptero_Character_BP_C",Multiplier=0.5)
				
				$defaults				= $dinodamres_dmg_defaults[ $iniinfo['ClassName'] ];
				$iniinfo['Multiplier']	= isset($iniinfo['Multiplier'])			? $iniinfo['Multiplier']			: $defaults['Multiplier'];
				
				$iniinfo['name']		= $defaults['name'];
				
				if (isset($defaults['thumbnail'])) {
					$iniinfo['thumbnail'] = $defaults['thumbnail'];
				}
				
				$dinodamres_dmg_combined[ $iniinfo['ClassName'] ] = $iniinfo;
			
			}
			
		}
		
		//assuming we found entries for DinoClassResistanceMultipliers already in the INI file,
		if (!empty($Resistances)) {
		
			//carefully merge the INI details over the defaults.
			foreach ($Resistances as $idx => $iniinfo) {
				//DinoClassResistanceMultipliers=(ClassName="Ptero_Character_BP_C",Multiplier=0.5)
				
				$defaults				= $dinodamres_res_defaults[ $iniinfo['ClassName'] ];
				$iniinfo['Multiplier']	= isset($iniinfo['Multiplier'])			? $iniinfo['Multiplier']			: $defaults['Multiplier'];
				
				$iniinfo['name']		= $defaults['name'];
				
				if (isset($defaults['thumbnail'])) {
					$iniinfo['thumbnail'] = $defaults['thumbnail'];
				}
				
				$dinodamres_res_combined[ $iniinfo['ClassName'] ] = $iniinfo;
			
			}
			
		}
	}
	
	
	if (!empty($_POST)) {
		//We are updating. Good thing we already have a combined list of the defaults plus the current config.
		//So, we should just be able to foreach through the combined list, look for changes in the postdata, and then write() the ini file.
		
		//Make a snapshot, just in case. We make it before we change anything.
		require_once($_INICONF['webdocroot'] . '/includes/class/class.snapshot.php');
		$snapshot			= new snapshot($_INICONF);
		$saved				= $snapshot->create(null, 'snapshot');

		$damages_towrite	= array();
		foreach ($dinodamres_dmg_combined as $id => $info) {

			$dinodamres_dmg_combined[ $id ]['Multiplier']	= (float) (isset($_POST["Multiplier_dmg_{$id}"]))	? $_POST["Multiplier_dmg_{$id}"] : $dinodamres_dmg_combined[ $id ]['Multiplier'];
			
			$purged	=	$dinodamres_dmg_combined[ $id ]; //purged as in, we have removed all of the keys that don't go into the INI file:
			
			unset($purged['name']);
			unset($purged['thumbnail']);
			
			$damages_towrite[] = $purged;

		}
		$iniGame->gameini['/script/shootergame.shootergamemode']['DinoClassDamageMultipliers'] = $damages_towrite;
		
		$resistances_towrite	= array();
		foreach ($dinodamres_res_combined as $id => $info) {

			$dinodamres_res_combined[ $id ]['Multiplier']	= (float) (isset($_POST["Multiplier_res_{$id}"]))	? $_POST["Multiplier_res_{$id}"] : $dinodamres_res_combined[ $id ]['Multiplier'];
			
			$purged	=	$dinodamres_res_combined[ $id ]; //purged as in, we have removed all of the keys that don't go into the INI file:
			
			unset($purged['name']);
			unset($purged['thumbnail']);
			
			$resistances_towrite[] = $purged;

		}
		$iniGame->gameini['/script/shootergame.shootergamemode']['DinoClassResistanceMultipliers'] = $resistances_towrite;
		
		
		$iniGame->write();
		
		//there were diffs, make sure we send a message telling them to restart ARK dedicated server.
		$_SESSION['need_to_restart'] = true;
	}
	
	//Assign our combined array: the defaults, with any values gleaned from the INI merged in, with any new details from the POST data merged in.
	$_VIEW->assign('dinodamres_dmg_combined', $dinodamres_dmg_combined);	
	$_VIEW->assign('dinodamres_res_combined', $dinodamres_res_combined);	
	
	
	$_VIEW->assign('_MSGS', $_MSGS);
	$_VIEW->display('serverConfigTuningWild.tpl');
	
