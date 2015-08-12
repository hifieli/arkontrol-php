<?php
	chdir(dirname(__FILE__));
	include_once('../init.php');	//init for authenticated areas!
	
	//fetch the defaults for Resources
	include_once($_INICONF['webdocroot'] . '/includes/resourcedefaults.php'); //$resource_defaults
	$_VIEW->assign('resource_defaults', $resource_defaults);
	
	//grab our Game.ini modeller
	require_once($_INICONF['webdocroot'] . '/includes/class.GameIniFixer.php');
	$iniGame	= new GameIniFixer($_INICONF);
	
	//set the combined to the defaults as a base.
	$resource_combined	= $resource_defaults;
	
	//assuming we got info from the ini:
	if (!empty($iniGame->gameini)) {
		
		//Build section if not there
		if (empty($iniGame->gameini['/script/shootergame.shootergamemode'])) {
			$iniGame->gameini['/script/shootergame.shootergamemode'] = array();
		}
		
		//Build HarvestResourceItemAmountClassMultipliers array if not there.
		if (empty($iniGame->gameini['/script/shootergame.shootergamemode']['HarvestResourceItemAmountClassMultipliers'])) {
			$iniGame->gameini['/script/shootergame.shootergamemode']['HarvestResourceItemAmountClassMultipliers'] = array();
		}
		//Get a smaller variable
		$Resources	= $iniGame->gameini['/script/shootergame.shootergamemode']['HarvestResourceItemAmountClassMultipliers'];
		
		//send it to the view for debugging 
		$_VIEW->assign('resource_alreadyini', $Resources);
		
		//assuming we found entries for HarvestResourceItemAmountClassMultipliers already in the INI file,
		if (!empty($Resources)) {
		
			//carefully merge the INI details over the defaults.
			foreach ($Resources as $idx => $iniinfo) {
				//HarvestResourceItemAmountClassMultipliers=(ClassName="PrimalItemResource_Thatch_C",Multiplier=2.0)
				
				$defaults				= $resource_defaults[ $iniinfo['ClassName'] ];
				$iniinfo['Multiplier']	= isset($iniinfo['Multiplier'])			? $iniinfo['Multiplier']			: $defaults['Multiplier'];
				
				$iniinfo['name']		= $defaults['name'];
				
				if (isset($defaults['thumbnail'])) {
					$iniinfo['thumbnail'] = $defaults['thumbnail'];
				}

				
				$resource_combined[ $iniinfo['ClassName'] ] = $iniinfo;
			
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

		$resources_towrite	= array();
		foreach ($resource_combined as $id => $info) {

			$resource_combined[ $id ]['Multiplier']	= (float) (isset($_POST["Multiplier_{$id}"]))	? $_POST["Multiplier_{$id}"] : $resource_combined[ $id ]['Multiplier'];
			
			$purged	=	$resource_combined[ $id ]; //purged as in, we have removed all of the keys that don't go into the INI file:
			
			unset($purged['name']);
			unset($purged['thumbnail']);
			
			$resources_towrite[] = $purged;

		}

		$iniGame->gameini['/script/shootergame.shootergamemode']['HarvestResourceItemAmountClassMultipliers'] = $resources_towrite;
		$iniGame->write();
		
		//there were diffs, make sure we send a message telling them to restart ARK dedicated server.
		$_SESSION['need_to_restart'] = true;
	}
	
	//Assign our combined array: the defaults, with any values gleaned from the INI merged in, with any new details from the POST data merged in.
	$_VIEW->assign('resource_combined', $resource_combined);	
	
	
	$_VIEW->assign('_MSGS', $_MSGS);
	$_VIEW->display('serverConfigResource.tpl');
	
// $_INICONF['weasels'] = "are only ferrets.";
// $_INICONF['webtimeout'] = "700";
// echo updateConf( $_INICONF );






