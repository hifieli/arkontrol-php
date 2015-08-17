<?php
	chdir(dirname(__FILE__));
	include_once('../init.php');	//init for authenticated areas!
	
	//fetch the defaults for Engrams
	include_once($_INICONF['webdocroot'] . '/includes/data/engramdefaults.php'); //$engram_defaults
	$_VIEW->assign('engram_defaults', $engram_defaults);
	
	//grab our Game.ini modeller
	require_once($_INICONF['webdocroot'] . '/includes/class/class.GameIniFixer.php');
	$iniGame	= new GameIniFixer($_INICONF);
	
	//set the combined to the defaults as a base.
	$engram_combined	= $engram_defaults;
	
	//assuming we got info from the ini:
	if (!empty($iniGame->gameini)) {
		
		//Build section if not there
		if (empty($iniGame->gameini['/script/shootergame.shootergamemode'])) {
			$iniGame->gameini['/script/shootergame.shootergamemode'] = array();
		}
		
		//Build OverrideNamedEngramEntries array if not there.
		if (empty($iniGame->gameini['/script/shootergame.shootergamemode']['OverrideNamedEngramEntries'])) {
			$iniGame->gameini['/script/shootergame.shootergamemode']['OverrideNamedEngramEntries'] = array();
		}
		//Get a smaller variable
		$Engrams	= $iniGame->gameini['/script/shootergame.shootergamemode']['OverrideNamedEngramEntries'];
		
		//send it to the view for debugging 
		$_VIEW->assign('engram_alreadyini', $Engrams);
		
		//assuming we found entries for OverrideNamedEngramEntries already in the INI file,
		if (!empty($Engrams)) {
		
			//carefully merge the INI details over the defaults.
			foreach ($Engrams as $idx => $iniinfo) {
				//EngramIndex=<index>[,EngramHidden=<hidden>][,EngramPointsCost=<cost>][,EngramLevelRequirement=<level>][,RemoveEngramPreReq=<remove_prereq>]
				
		
				$defaults							= $engram_defaults[ $iniinfo['EngramClassName'] ];
				$iniinfo['EngramHidden']			= isset($iniinfo['EngramHidden'])			? $iniinfo['EngramHidden']			: $defaults['EngramHidden'];
				$iniinfo['EngramPointsCost']		= isset($iniinfo['EngramPointsCost'])		? $iniinfo['EngramPointsCost']		: $defaults['EngramPointsCost'];
				$iniinfo['EngramLevelRequirement']	= isset($iniinfo['EngramLevelRequirement'])	? $iniinfo['EngramLevelRequirement']: $defaults['EngramLevelRequirement'];
				$iniinfo['RemoveEngramPreReq']		= isset($iniinfo['RemoveEngramPreReq'])		? $iniinfo['RemoveEngramPreReq']	: $defaults['RemoveEngramPreReq'];		
				
				
				$iniinfo['name']		= $defaults['name'];
				
				if (isset($defaults['thumbnail'])) {
					$iniinfo['thumbnail'] = $defaults['thumbnail'];
				}
				if (isset($defaults['prereq1'])) {
					$iniinfo['prereq1'] = $defaults['prereq1'];
				}
				if (isset($defaults['prereq2'])) {
					$iniinfo['prereq2'] = $defaults['prereq2'];
				}
				
				$engram_combined[ $iniinfo['EngramClassName'] ] = $iniinfo;
			
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

		$engrams_towrite	= array();
		foreach ($engram_combined as $id => $info) {

			$engram_combined[ $id ]['RemoveEngramPreReq']		= (isset($_POST["RemoveEngramPreReq_{$id}"]))		? (empty($_POST["RemoveEngramPreReq_{$id}"])?'true':'false')	: $engram_combined[ $id ]['RemoveEngramPreReq'];
			$engram_combined[ $id ]['EngramHidden']				= (isset($_POST["EngramHidden_{$id}"]))				? (empty($_POST["EngramHidden_{$id}"])?'false':'true')			: $engram_combined[ $id ]['EngramHidden'];
			$engram_combined[ $id ]['EngramPointsCost']			= (isset($_POST["EngramPointsCost_{$id}"]))			? $_POST["EngramPointsCost_{$id}"]								: $engram_combined[ $id ]['EngramPointsCost'];
			$engram_combined[ $id ]['EngramLevelRequirement']	= (isset($_POST["EngramLevelRequirement_{$id}"]))	? $_POST["EngramLevelRequirement_{$id}"]						: $engram_combined[ $id ]['EngramLevelRequirement'];
			
			$purged	=	$engram_combined[ $id ]; //purged as in, we have removed all of the keys that don't go into the INI file:
			
			unset($purged['name']);
			unset($purged['thumbnail']);
			unset($purged['prereq1']);
			unset($purged['prereq2']);
			
			$engrams_towrite[] = $purged;

		}

		$iniGame->gameini['/script/shootergame.shootergamemode']['OverrideNamedEngramEntries'] = $engrams_towrite;
		$iniGame->write();
		
		//there were diffs, make sure we send a message telling them to restart ARK dedicated server.
		$_SESSION['need_to_restart'] = true;
	}
	
	//Assign our combined array: the defaults, with any values gleaned from the INI merged in, with any new details from the POST data merged in.
	$_VIEW->assign('engram_combined', $engram_combined);	
	
	
	$_VIEW->assign('_MSGS', $_MSGS);
	$_VIEW->display('serverConfigEngrams.tpl');
	
// $_INICONF['weasels'] = "are only ferrets.";
// $_INICONF['webtimeout'] = "700";
// echo updateConf( $_INICONF );






