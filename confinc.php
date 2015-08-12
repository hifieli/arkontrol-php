<?php

/*
 *	Because you don't really want the config file to be accessible in any way,
 *	this file just includes it from wherever it is actually located, and you 
 *	can include this file from any of the public scripts. Pretty cool, eh?
 *
**/

$full_ini_path	= '/etc/arkontrol.ini';

if (!file_exists($full_ini_path)) {
	//couldn't find it? go ahead and use the local config.
	$full_ini_path	= dirname(__FILE__) . '/arkontrol.ini';
}

//Parse the config file into an array.
$_INICONF	= parse_ini_file($full_ini_path);

//Stop now and let someone know if there is a problem.
if ($_INICONF === false) {
	die("Unable to parse config file at {$full_ini_path}. quitting.");
	die("Unable to parse config file. quitting.");
}

//Handle the firstrun
if (!empty($_INICONF['firstrun']) || !isset($_INICONF['webdocroot']) || (isset($_INICONF['webdocroot']) && file_exists($_INICONF['webdocroot'] . '/updated'))) {
	$_INICONF['hostname']	= `hostname`; $_INICONF['hostname'] = trim($_INICONF['hostname']);
	$_INICONF['inipath']	= $full_ini_path;
	$_INICONF['webdocroot']	= dirname(__FILE__);
	$_INICONF['firstrun']	= 0;
	
	updateConf($_INICONF);
	
	if (isset($_INICONF['webdocroot']) && file_exists($_INICONF['webdocroot'] . '/updated')) {
		unlink($_INICONF['webdocroot'] . '/updated');
	}
}

$_INICONF['version']	= file_get_contents($_INICONF['webdocroot'] . '/version');

//include and setup smarty right here. go ahead and 
require_once($_INICONF['webdocroot'] . '/includes/smarty/Smarty.class.php');
$_VIEW	= new Smarty();
$_VIEW->setTemplateDir($_INICONF['webdocroot'] . '/includes/tpl/themes/' . $_INICONF['webtheme'] . '/');
$_VIEW->setCompileDir( $_INICONF['webdocroot'] . '/includes/smarty/templates_c/');
$_VIEW->setConfigDir(  $_INICONF['webdocroot'] . '/includes/smarty/configs/');
$_VIEW->setCacheDir(   $_INICONF['webdocroot'] . '/includes/smarty/cache/');
//$_VIEW->debugging = true; // show the debug console

//Pass the $_INICONF variable to smarty
$_VIEW->assign('_INICONF', $_INICONF);

//create the messages array
$_MSGS	= array();



//everyone gets a session
session_start();



//move this at some point, please.
function updateConf( $CONF ) {
	
	if (empty($CONF) || empty($CONF['inipath'])) return -1;
	
	$file_as_array	= parse_ini_file($CONF['inipath']);
	
	$conf_diffs		= array();
	foreach ($CONF as $k => $v) {
		if (!isset($file_as_array[$k]) || ($file_as_array[$k] != $CONF[$k])) {
			$conf_diffs[$k] = $v;
		}
	}
	
	//nothing changed, so we are done here
	if (empty($conf_diffs)) return 0;
	
	$file_as_lines	= file($CONF['inipath'], FILE_IGNORE_NEW_LINES);
	$newlines		= array();
	$changed		= 0;
	foreach ($file_as_lines as $i => $thisline) {
		foreach ($conf_diffs as $k => $v) {
			if (strstr($thisline, $k) !== false) {
				$file_as_lines[$i] = "{$k}=\"{$v}\"";
				$changed++;
				unset($conf_diffs[$k]);
				break;
			}
		}
		if (empty($conf_diffs)) break;
	}
	
	if (!empty($conf_diffs)) {
		foreach ($conf_diffs as $k => $v) {
			$file_as_lines[] = "";
			$file_as_lines[] = "{$k}=\"{$v}\"";
			$changed++;
		}
	}
	
	if ($changed > 0) {
		file_put_contents($CONF['inipath'], implode("\r\n", $file_as_lines));
	}
	
	return $changed;
}