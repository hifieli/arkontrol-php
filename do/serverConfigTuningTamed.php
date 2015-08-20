<?php

//damage and resistance for tamed creatures.


<?php
	chdir(dirname(__FILE__));
	include_once('../init.php');	//init for authenticated areas!
	
	//fetch the defaults for Damage and Resistance of tamed creatures.
	include_once($_INICONF['webdocroot'] . '/includes/data/damrestameddefaults.php'); //$creature_defaults, $untamables, $taming_defaults, $taming_dmg_defaults, and $taming_res_defaults
	$_VIEW->assign('taming_dmg_defaults', $taming_dmg_defaults);
	$_VIEW->assign('taming_res_defaults', $taming_res_defaults);
	
	//grab our Game.ini modeller
	require_once($_INICONF['webdocroot'] . '/includes/class/class.GameIniFixer.php');
	$iniGame	= new GameIniFixer($_INICONF);
	
	//set the combined to the defaults as a base.
	$taming_dmg_combined	= $taming_dmg_defaults;
	$taming_res_combined	= $taming_res_defaults;
	
	//assuming we got info from the ini:
	if (!empty($iniGame->gameini)) {
		
		//Build section if not there
		if (empty($iniGame->gameini['/script/shootergame.shootergamemode'])) {
			$iniGame->gameini['/script/shootergame.shootergamemode'] = array();
		}
		
		//Build TamedDinoClassDamageMultipliers array if not there.
		if (empty($iniGame->gameini['/script/shootergame.shootergamemode']['TamedDinoClassDamageMultipliers'])) {
			$iniGame->gameini['/script/shootergame.shootergamemode']['TamedDinoClassDamageMultipliers'] = array();
		}
		//Build TamedDinoClassResistanceMultipliers array if not there.
		if (empty($iniGame->gameini['/script/shootergame.shootergamemode']['TamedDinoClassResistanceMultipliers'])) {
			$iniGame->gameini['/script/shootergame.shootergamemode']['TamedDinoClassResistanceMultipliers'] = array();
		}		
		
		//Get a smaller variable
		$Damages		= $iniGame->gameini['/script/shootergame.shootergamemode']['TamedDinoClassDamageMultipliers'];
		$Resistances	= $iniGame->gameini['/script/shootergame.shootergamemode']['TamedDinoClassResistanceMultipliers'];
		
		//send it to the view for debugging 
		$_VIEW->assign('damages_alreadyini', $Damages);
		$_VIEW->assign('resistances_alreadyini', $Resistances);
		
		
		//assuming we found entries for TamedDinoClassDamageMultipliers already in the INI file,
		if (!empty($Damages)) {
		
			//carefully merge the INI details over the defaults.
			foreach ($Damages as $idx => $iniinfo) {
				//TamedDinoClassDamageMultipliers=(ClassName="Ptero_Character_BP_C",Multiplier=0.5)
				
				$defaults				= $taming_dmg_defaults[ $iniinfo['ClassName'] ];
				$iniinfo['Multiplier']	= isset($iniinfo['Multiplier'])			? $iniinfo['Multiplier']			: $defaults['Multiplier'];
				
				$iniinfo['name']		= $defaults['name'];
				
				if (isset($defaults['thumbnail'])) {
					$iniinfo['thumbnail'] = $defaults['thumbnail'];
				}
				
				$taming_dmg_combined[ $iniinfo['ClassName'] ] = $iniinfo;
			
			}
			
		}
		
		//assuming we found entries for TamedDinoClassResistanceMultipliers already in the INI file,
		if (!empty($Resistances)) {
		
			//carefully merge the INI details over the defaults.
			foreach ($Resistances as $idx => $iniinfo) {
				//TamedDinoClassResistanceMultipliers=(ClassName="Ptero_Character_BP_C",Multiplier=0.5)
				
				$defaults				= $taming_res_defaults[ $iniinfo['ClassName'] ];
				$iniinfo['Multiplier']	= isset($iniinfo['Multiplier'])			? $iniinfo['Multiplier']			: $defaults['Multiplier'];
				
				$iniinfo['name']		= $defaults['name'];
				
				if (isset($defaults['thumbnail'])) {
					$iniinfo['thumbnail'] = $defaults['thumbnail'];
				}
				
				$taming_res_combined[ $iniinfo['ClassName'] ] = $iniinfo;
			
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
		foreach ($taming_dmg_combined as $id => $info) {

			$taming_dmg_combined[ $id ]['Multiplier']	= (float) (isset($_POST["Multiplier_dmg_{$id}"]))	? $_POST["Multiplier_dmg_{$id}"] : $taming_dmg_combined[ $id ]['Multiplier'];
			
			$purged	=	$taming_dmg_combined[ $id ]; //purged as in, we have removed all of the keys that don't go into the INI file:
			
			unset($purged['name']);
			unset($purged['thumbnail']);
			
			$damages_towrite[] = $purged;

		}
		$iniGame->gameini['/script/shootergame.shootergamemode']['TamedDinoClassDamageMultipliers'] = $damages_towrite;
		
		$resistances_towrite	= array();
		foreach ($taming_res_combined as $id => $info) {

			$taming_res_combined[ $id ]['Multiplier']	= (float) (isset($_POST["Multiplier_res_{$id}"]))	? $_POST["Multiplier_res_{$id}"] : $taming_res_combined[ $id ]['Multiplier'];
			
			$purged	=	$taming_res_combined[ $id ]; //purged as in, we have removed all of the keys that don't go into the INI file:
			
			unset($purged['name']);
			unset($purged['thumbnail']);
			
			$resistances_towrite[] = $purged;

		}
		$iniGame->gameini['/script/shootergame.shootergamemode']['TamedDinoClassResistanceMultipliers'] = $resistances_towrite;
		
		
		$iniGame->write();
		
		//there were diffs, make sure we send a message telling them to restart ARK dedicated server.
		$_SESSION['need_to_restart'] = true;
	}
	
	//Assign our combined array: the defaults, with any values gleaned from the INI merged in, with any new details from the POST data merged in.
	$_VIEW->assign('taming_dmg_combined', $taming_dmg_combined);	
	$_VIEW->assign('taming_res_combined', $taming_res_combined);	
	
	
	$_VIEW->assign('_MSGS', $_MSGS);
	$_VIEW->display('serverConfigTuningTamed.tpl');
	
