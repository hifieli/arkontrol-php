<?php

require_once($_INICONF['webdocroot'] . '/includes/data/creatures.php');	//provides $creature_defaults, $untamables,

//NPCReplacements=(FromClassName="MegaRaptor_Character_BP_C",ToClassName="Dodo_Character_BP_C")
//NPCReplacements=(FromClassName="MegaRex_Character_BP_C",ToClassName="")

$replace_defaults	= array();

foreach ($creature_defaults as $id => $info) {
			
	$info['FromClassName']	= $info['ClassName'];
	$info['ToClassName']	= $info['ClassName'];
	
	unset($info['ClassName']);
	
	$replace_defaults[ $id ]	= $info;

}

/*
**	ALPHAs
*/

$alpha_replace_defaults = array (


	'MegaRaptor_Character_BP_C'	=> array (
		'FromClassName'	=> 'MegaRaptor_Character_BP_C',
		'ToClassName'	=> 'Raptor_Character_BP_C',
		'name'			=> 'Alpha Raptor',
		'thumbnail'		=> '186px-Dossier_Raptor.png',
	),
	'MegaRex_Character_BP_C'	=> array (
		'FromClassName'	=> 'MegaRex_Character_BP_C',
		'ToClassName'	=> 'Rex_Character_BP_C',
		'name'			=> 'Alpha Rex',
		'thumbnail'		=> '186px-Dossier_Tyrannosaurus.png',
	),
	'MegaCarno_Character_BP_C'	=> array (
		'FromClassName'	=> 'MegaCarno_Character_BP_C',
		'ToClassName'	=> 'Carno_Character_BP_C',
		'name'			=> 'Alpha Carno',
		'thumbnail'		=> '186px-Dossier_Carno.png',
	),
	
);

$replace_defaults	= array_merge($replace_defaults, $alpha_replace_defaults);

ksort($replace_defaults);

// Caller now has $creature_defaults, $untamables, $replace_defaults