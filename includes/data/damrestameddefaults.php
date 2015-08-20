<?php

require_once($_INICONF['webdocroot'] . '/includes/tamingdefaults.php');	//provides $taming_defaults

//TamedDinoClassDamageMultipliers=(ClassName="Ptero_Character_BP_C",Multiplier=0.5)
//TamedDinoClassResistanceMultipliers=(ClassName="Argent_Character_BP_C",Multiplier=0.25)

$taming_dmg_defaults	= array();
$taming_res_defaults	= array();

foreach ($taming_defaults as $id => $info) {
	
	unset($info['TamingDisabled']);
	
	$info['Multiplier']			= 1;

	$taming_dmg_defaults[ $id ]	= $info;
	
	$taming_res_defaults[ $id ]	= $info;
	
}

// Caller now has $creature_defaults, $untamables, $taming_defaults, $taming_dmg_defaults, and $taming_res_defaults