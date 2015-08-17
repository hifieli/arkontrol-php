<?php
	chdir(dirname(__FILE__));
	include_once('../init.php');	//init for authenticated areas!
	
	//do things.
	
	$inifileslist	= scandir($_INICONF['settingspath']);
	
	$inifiles		= array();
	
	if (!empty($inifileslist)) {
		foreach ($inifileslist as $inifile) {
			if (($inifile != '.') && ($inifile != '..') && (strstr($inifile,'.ini'))) {
				$inifiles[]	= $inifile;
			}
		}
	}

	if (!empty($_POST)) {
		
		//Make a snapshot, just in case. We make it before we change anything.
		require_once($_INICONF['webdocroot'] . '/includes/class/class.snapshot.php');
		$snapshot	= new snapshot($_INICONF);
		$saved		= $snapshot->create(null, 'snapshot');
		
		foreach ($_POST as $inifile => $contents) {
			$inifile = str_replace('_ini','.ini', $inifile);
			if (in_array($inifile, $inifiles)) {
				file_put_contents($_INICONF['settingspath'] . "/{$inifile}", $contents);
			} else {
				die('invalid config file! ' . $inifile . print_r($inifiles, true));
			}
		}
		
		$_SESSION['need_to_restart'] = true;
	}
	
	$inicontents	= array();
	foreach ($inifiles as $inifile) {
		
		$inicontents[ $inifile ]	= file_get_contents($_INICONF['settingspath'] . "/{$inifile}");
		
	}
	
	
	$_VIEW->assign('inifiles', $inifiles);
	$_VIEW->assign('inicontents', $inicontents);
	$_VIEW->assign('_MSGS', $_MSGS);
	$_VIEW->display('serverConfigRaw.tpl');