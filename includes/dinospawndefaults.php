<?php
/*
DinoSpawnWeightMultipliers=(
DinoNameTag=<tag>
,SpawnWeightMultiplier=<factor>]
[,OverrideSpawnLimitPercentage=<override>]
[,SpawnLimitPercentage=<limit>])
*/
$default_dino	= array(
	'DinoNameTag'					=> (string)	'default',
	'SpawnWeightMultiplier'			=> (int)	1,
	'OverrideSpawnLimitPercentage'	=> (string)	'false',
	'SpawnLimitPercentage'			=> (float)	1.0,
);

$dino_names	= array(
	'Anky'			=> 'Ankylosaurus',
	'Argent'		=> 'Argentavis',
	'Bat'			=> 'Bat',
	'Bronto'		=> 'Brontosaurus',
	'Carno'			=> 'Carnotaurus',
	'Coel'			=> 'Coelacanth',
	'Dilo'			=> 'Dilophosaur',
	'Dodo'			=> 'Dodo',
	'Mammoth'		=> 'Mammoth',
	'Mega'			=> 'Megalodon',
	'Para'			=> 'Parasaur',
	'Phiomia'		=> 'Phiomia',
	'Piranha'		=> 'Piranha',
	'Ptera'			=> 'Pterosaur',
	'Raptor'		=> 'Raptor',
	'Rex'			=> 'Tyrannosaurus',
	'Sabertooth'	=> 'Sabertooth',
	'Sarco'			=> 'Sarcosaurus',
	'Scorpion'		=> 'Pulmonoscorpius',
	'Stego'			=> 'Stegosaurus',
	'Spino'			=> 'Spinosaur',
	'Spider'		=> 'Spider',
	'Titanboa'		=> 'Titanboa',
	'Trike'			=> 'Triceratops',
	'Turtle'		=> 'Carbonemys',
	
// Not documented as tags, but, are listed as tameable.
//	'Ichthy'		=> 'Ichthyosaurus (Dolphin)',
//	'Plesio'		=> 'Plesiosaur',

	
	
);

$dino_defaults	= array();


foreach($dino_names as $d => $f) {
	$dino_defaults[ $d ]				= $default_dino;
	$dino_defaults[ $d ]['DinoNameTag']	= $d;
	$dino_defaults[ $d ]['name']		= $f;
}

ksort($dino_defaults);

//var_export($dino_defaults);