<?php
	chdir(dirname(__FILE__));
	include_once('../init.php');
	
	//do things.
	
	$pretty_cmd	= '';
	
	// Handle any requested action
	if (!empty($_POST)) {
		
		$issue_cmd	= '';
		switch ($_POST['action']) {
			
			case 'start':
				$pretty_cmd	= 'start';
				$issue_cmd	= "sudo -u www-data sudo service vsftpd start";
				$_MSGS[]	= array('type'=>'info','msg'=>"arkontrol has issued the `start` command to the FTP server.");
			break;
			case 'stop':
				$pretty_cmd	= 'stop';
				$issue_cmd	= "sudo -u www-data sudo service vsftpd stop";
				$_MSGS[]	= array('type'=>'info','msg'=>"arkontrol has issued the `stop` command to the FTP server.");
			break;
			case 'restart':
				$pretty_cmd	= 'restart';
				$issue_cmd	= "sudo -u www-data sudo service vsftpd restart";
				$_MSGS[]	= array('type'=>'info','msg'=>"arkontrol has issued the `restart` command to the FTP server.");
			break;

			default:
				$pretty_cmd	= 'unknown';
				$issue_cmd	= '';
				$_MSGS[]	= array('type'=>'info','msg'=>"arkontrol did not understand your request, and did not issue any commands.");
		}
		
		if (!empty($issue_cmd)) {
			
			$destination = '/dev/null';
			
			$response = exec($issue_cmd . " > {$destination} &");
			
			//$response = exec($issue_cmd);
			//$_MSGS[]	= array('type'=>'info','msg'=>"response: {$response}");
			
		}
		
	}
	
	$_MSGS[]	= array('type'=>'info','msg'=>'ARKontrol highly recommends using <a href="https://filezilla-project.org" target="_new">FileZilla</a> as your FTP client.');

	$_VIEW->assign('pretty_cmd', $pretty_cmd);
	$_VIEW->assign('_MSGS', $_MSGS);
	$_VIEW->display('ftpControl.tpl');