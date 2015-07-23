<?php
	chdir(dirname(__FILE__));
	include_once('../init.php');
	
	//do things.
	$logs		= '';
	$log_name	= 'No log selected. <a href="/do/browseLogs.php">Browse Logs</a>';
	
	if (!empty($_GET)) {
		if (!empty($_GET['log'])) {
		
			$logfile	= '';
			
			if        ($_GET['log'] == 'connect') {
				$logfile	= $_INICONF['serverlogpath'] . '/' . $_INICONF['logconnect'];
				$log_name	= 'connect';
			} else if ($_GET['log'] == 'content') {
				$logfile	= $_INICONF['serverlogpath'] . '/' . $_INICONF['logcontent'];
				$log_name	= 'connect';
			} else if ($_GET['log'] == 'service') {
				$logfile	= $_INICONF['serverlogpath'] . '/' . $_INICONF['logservice'];
				$log_name	= 'connect';
			}
		}
		
		if (!empty($_GET['logfile'])) {
		
			$logfile	= $_INICONF['serverlogpath'] . '/' . addslashes($_GET['logfile']);
			$log_name	= addslashes($_GET['logfile']);

		}
	
	}
	
	if (!empty($logfile) && file_exists($logfile)) {
		$cmd	= "tail -n 300 {$logfile}";
		$logs	= `$cmd`;
		$logs	= strip_tags($logs);
	}
	
	$_VIEW->assign('logs', $logs);
	$_VIEW->assign('log_name', $log_name);
	$_VIEW->assign('_MSGS', $_MSGS);
	$_VIEW->display('viewLog.tpl');