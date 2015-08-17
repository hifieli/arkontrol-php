<?php
	chdir(dirname(__FILE__));
	include_once('../init.php');
	
	//do things.
	$logs		= '';
	$log_name	= 'No log selected. <a href="/do/serverLogBrowse.php">Browse Logs</a>';
	
	if (!empty($_GET)) {

		if (!empty($_GET['logfile'])) {
		
			$logfile	= $_INICONF['serverlogpath'] . '/' . addslashes($_GET['logfile']);
			$log_name	= addslashes($_GET['logfile']);

		}
	
	}
	
	if (!empty($logfile) && file_exists($logfile)) {
		$cmd	= "sudo tail -n 300 {$logfile}";
		$logs	= `$cmd`;
		$logs	= strip_tags($logs);
	}
	
	$_VIEW->assign('logs', $logs);
	$_VIEW->assign('log_name', $log_name);
	$_VIEW->assign('_MSGS', $_MSGS);
	$_VIEW->display('serverLogView.tpl');