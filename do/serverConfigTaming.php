<?php
	chdir(dirname(__FILE__));
	include_once('../init.php');	//init for authenticated areas!
	
	//fetch the defaults for Taming
	include_once($_INICONF['webdocroot'] . '/includes/tamingdefaults.php'); //$taming_defaults
	$_VIEW->assign('taming_defaults', $taming_defaults);
	
	//grab our Game.ini modeller
	require_once($_INICONF['webdocroot'] . '/includes/class.GameIniFixer.php');
	$iniGame	= new GameIniFixer($_INICONF);
	
	//set the combined to the defaults as a base.
	$taming_combined	= $taming_defaults;
	
	//assuming we got info from the ini:
	if (!empty($iniGame->gameini)) {
		
		//Build section if not there
		if (empty($iniGame->gameini['/script/shootergame.shootergamemode'])) {
			$iniGame->gameini['/script/shootergame.shootergamemode'] = array();
		}
		
		//Build PreventDinoTameClassNames array if not there.
		if (empty($iniGame->gameini['/script/shootergame.shootergamemode']['PreventDinoTameClassNames'])) {
			$iniGame->gameini['/script/shootergame.shootergamemode']['PreventDinoTameClassNames'] = array();
		}
		//Get a smaller variable
		$Taming	= $iniGame->gameini['/script/shootergame.shootergamemode']['PreventDinoTameClassNames'];
		
		//send it to the view for debugging 
		$_VIEW->assign('taming_alreadyini', $Taming);
		
		//assuming we found entries for PreventDinoTameClassNames already in the INI file,
		if (!empty($Taming)) {
		
			//carefully merge the INI details over the defaults.
			foreach ($Taming as $idx => $ClassName) {
				//PreventDinoTameClassNames="Argent_Character_BP_C"
				$iniinfo						= array();
			
				$defaults						= $taming_defaults[ $ClassName ];
				
				$iniinfo['TamingDisabled']		= 1; 
				$iniinfo['name']				= $defaults['name'];
				$iniinfo['ClassName']			= $ClassName;
				
				if (isset($defaults['thumbnail'])) {
					$iniinfo['thumbnail']	= $defaults['thumbnail'];
				}

				$taming_combined[ $ClassName ] = $iniinfo;
			
			}
			
		}
	}
	
	
	if (!empty($_POST)) {
		//We are updating. Good thing we already have a combined list of the defaults plus the current config.
		//So, we should just be able to foreach through the combined list, look for changes in the postdata, and then write() the ini file.
		
		//Make a snapshot, just in case. We make it before we change anything.
		require_once($_INICONF['webdocroot'] . '/includes/class.snapshot.php');
		$snapshot			= new snapshot($_INICONF);
		$saved				= $snapshot->create(null, 'snapshot');

		$taming_towrite	= array();
		foreach ($taming_combined as $id => $info) {

			$taming_combined[ $id ]['TamingDisabled']		= (isset($_POST["TamingDisabled_{$id}"]))	? (empty($_POST["TamingDisabled_{$id}"])?0:1)	: $taming_combined[ $id ]['TamingDisabled'];
			
			if (!empty($taming_combined[ $id ]['TamingDisabled'])) {	//we just plain ol' don't include the ones that we want to be tameable. we need to list only the ones that are untamable
				
				$taming_towrite[] = '"' . $taming_combined[ $id ]['ClassName'] . '"';
				
			}

		}

		$iniGame->gameini['/script/shootergame.shootergamemode']['PreventDinoTameClassNames'] = $taming_towrite;
		$iniGame->write();
		
		//there were diffs, make sure we send a message telling them to restart ARK dedicated server.
		$_SESSION['need_to_restart'] = true;
	}
	
	//Assign our combined array: the defaults, with any values gleaned from the INI merged in, with any new details from the POST data merged in.
	$_VIEW->assign('taming_combined', $taming_combined);	
	
	
	$_VIEW->assign('_MSGS', $_MSGS);
	$_VIEW->display('serverConfigTaming.tpl');
	
// $_INICONF['weasels'] = "are only ferrets.";
// $_INICONF['webtimeout'] = "700";
// echo updateConf( $_INICONF );






