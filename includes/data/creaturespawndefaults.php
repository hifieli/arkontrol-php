<?php

require_once($_INICONF['webdocroot'] . '/includes/data/creatures.php');	//provides $creature_defaults, $untamables

//DinoSpawnWeightMultipliers=(DinoNameTag=<tag>,SpawnWeightMultiplier=<factor>][,OverrideSpawnLimitPercentage=<override>][,SpawnLimitPercentage=<limit>])

$spawn_defaults	= array ();

$ban_list	= array(
	'MegaCarno_Character_BP_C',
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

//Kludges for non-standard NameTags. If this gets to be too big, we will have to make 'DinoNameTag' part of the $creature_defaults arrays.

// $spawn_defaults['SpiderL']['DinoNameTag'] = 'Uberspider';
// $spawn_defaults['Spider'] = $spawn_defaults['SpiderL'];
// unset($spawn_defaults['SpiderL']);

$spawn_defaults['SpiderS']['DinoNameTag'] = 'Spider';
$spawn_defaults['Spider'] = $spawn_defaults['SpiderS'];
unset($spawn_defaults['SpiderS']);

//unconfirmed report that the nametag for the MegaRex_Character_BP_C is actually 'Elite Rex' (with the space).
// the same may be true for the other Alpha ... er Mega ... er Elite creatures.

ksort($spawn_defaults);

// Caller now has $creature_defaults, $untamables, $spawn_defaults
