<?php

require_once($_INICONF['webdocroot'] . '/includes/data/creatures.php');	//provides $creature_defaults, $untamables

//


$taming_defaults	= array ();

foreach ($creature_defaults as $id => $info) {
	
	if (in_array($id, $untamables)) { continue; }//we don't need to deal with anything we can't tame
		
	$info['TamingDisabled']	= 0;
	
	$taming_defaults[ $id ]	= $info;
	
}


ksort($taming_defaults);


// Caller now has $creature_defaults, $untamables, $taming_defaults