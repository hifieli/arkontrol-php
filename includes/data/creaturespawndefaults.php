<?php

require_once($_INICONF['webdocroot'] . '/includes/data/creatures.php');	//provides $creature_defaults

//DinoSpawnWeightMultipliers=(DinoNameTag=<tag>,SpawnWeightMultiplier=<factor>][,OverrideSpawnLimitPercentage=<override>][,SpawnLimitPercentage=<limit>])

$spawn_defaults	= array ();

$ban_list	= array(
	'MegaRaptor_Character_BP_C',
	'MegaRex_Character_BP_C',
	'SpiderL_Character_BP_C',
);

foreach ($creature_defaults as $id => $info) {
	
	if (in_array($id, $ban_list)) continue;
	
	$info['DinoNameTag'] 					= str_replace('_Character_BP_C', '', $info['ClassName']);
	$info['SpawnWeightMultiplier']			= (int)		1;
	$info['OverrideSpawnLimitPercentage']	= (string)	'false';
	$info['SpawnLimitPercentage']			= (float)	1.0;
	
	unset($info['ClassName']);
	
	$spawn_defaults[ $info['DinoNameTag'] ]	= $info;
	
}


ksort($spawn_defaults);


// Caller now has $creature_defaults, $spawn_defaults
