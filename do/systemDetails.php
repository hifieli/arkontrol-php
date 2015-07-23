<?php
	chdir(dirname(__FILE__));
	include_once('../init.php');
	
	//do things.
	$top	= `top -b -n 1`;
	$freem	= `free -m`;
	$df		= `df -h`;
	$du		= `cd /home/steam && du -h --max-depth=3`;
	//$cpu	= `cat /proc/cpuinfo | head -n 9`;
	$cpu	= `cat /proc/cpuinfo`;
	
	
	$_VIEW->assign('top', $top);
	$_VIEW->assign('freem', $freem);
	$_VIEW->assign('df', $df);
	$_VIEW->assign('du', $du);
	$_VIEW->assign('cpu', $cpu);
	$_VIEW->assign('_MSGS', $_MSGS);
	$_VIEW->display('systemDetails.tpl');