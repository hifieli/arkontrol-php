<?php


require_once('class.GameIniFixer.php');

	$_INICONF	= array('settingspath' => dirname(__FILE__));

	$iniGame	= new GameIniFixer($_INICONF);
	
	print_r($iniGame->gameini);
	
	$Engrams	= $iniGame->gameini['/script/shootergame.shootergamemode']['OverrideEngramEntries'];
	
	$Engrams[3]['EngramPointsCost'] = 1000;
	//arrays are zero indexed, Engrams are 1 indexed so
	//($Engrams[3]['EngramIndex'] == 4) is true;
	
	$iniGame->gameini['/script/shootergame.shootergamemode']['OverrideEngramEntries'] = $Engrams;
	
	print_r($iniGame->gameini);
	
	$iniGame->write();