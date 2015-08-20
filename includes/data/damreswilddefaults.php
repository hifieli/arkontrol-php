<?php

require_once($_INICONF['webdocroot'] . '/includes/data/creatures.php');	//provides $creature_defaults, $untamables

//DinoClassDamageMultipliers=(ClassName="MegaRaptor_Character_BP_C",Multiplier=0.1)
//DinoClassResistanceMultipliers=(ClassName="MegaRaptor_Character_BP_C",Multiplier=0.1)

$dinodamres_dmg_defaults	= array();
$dinodamres_res_defaults	= array();

foreach ($creature_defaults as $id => $info) {
		
	$info['Multiplier']				= 1;
	
	$dinodamres_dmg_defaults[ $id ]	= $info;
	
	$dinodamres_res_defaults[ $id ]	= $info;
	
}


ksort($dinodamres_defaults);


// Caller now has $creature_defaults, $untamables, $dinodamres_dmg_defaults, and $dinodamres_res_defaults