<?php

require_once($_INICONF['webdocroot'] . '/includes/data/xpleveldefaults.php');	//provides $levelling_defaults

//

$playerlevelling_defaults	= array();

foreach ($levelling_defaults as $level_up => $info) {
	
	$playerlevelling_defaults[ $level_up  ] = $info;
	
}