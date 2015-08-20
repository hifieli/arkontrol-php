<?php

require_once($_INICONF['webdocroot'] . '/includes/data/xpleveldefaults.php');	//provides $levelling_defaults

//
$dinolevelling_defaults	= array();

foreach ($levelling_defaults as $level_up => $info) {
	
	if ($level_up >= 50) { continue; } //Dinos only get +50 levels from when you tame them. again, these are defaults.
	
	$dinolevelling_defaults[ $level_up  ] = $info;
	
}



// Caller now has $creature_defaults, $untamables, $taming_defaults