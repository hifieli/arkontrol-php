<?php

require_once($_INICONF['webdocroot'] . '/includes/data/creatures.php');	//provides $creature_defaults

//

$ban_list	= array(
	'SpiderL_Character_BP_C',
	'SpiderS_Character_BP_C',
	'Piranha_Character_BP_C',
	'MegaRaptor_Character_BP_C',
	'MegaRex_Character_BP_C',
	'Dragonfly_Character_BP_C',
	'FlyingAnt_Character_BP_C',
	'Coel_Character_BP_C',
	'Bat_Character_BP_C',
	'BoaFrill_Character_BP_C',
	'Ant_Character_BP_C',
);

$taming_defaults	= array ();

foreach ($creature_defaults as $id => $info) {
	
	if (in_array($id, $ban_list)) { continue; }//we don't need to deal with anything we can't tame
		
	$info['TamingDisabled']			= 0;
	
	$taming_defaults[ $id ]	= $info;
	
}


ksort($taming_defaults);


// Caller now has $creature_defaults, $taming_defaults