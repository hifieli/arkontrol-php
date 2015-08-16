<?php
	chdir(dirname(__FILE__));
	include_once('../init.php');
	
	$ftp_users_file	= '/etc/vsftpd/virtual-users.txt';
	$ftp_users_db	= '/etc/vsftpd/virtual-users.db';
	
	//do things.
	$ftp_users	= file_get_contents($ftp_users_file);

	
	// Handle any requested action
	if (!empty($_POST)) {
		if (!empty($_POST['ftp_users'])) {
			
			//use the new info on the current page view (the info they just posted, bro)
			$ftp_users	= trim($_POST['ftp_users']);
			$ftp_users	= $ftp_users . "\n";						//add a line-feed. most people don't press enter after the last entry in a list, myself included.
			$ftp_users	= str_replace("\r\n",	"\n", $ftp_users);	//windows to linux
			$ftp_users	= str_replace("\r",		"\n", $ftp_users);	//mac to linux
			$ftp_users	= str_replace("\n\n",	"\n", $ftp_users);	//collapse to single (so it doesn't matter if adding the line-feed above was redundant)
			
			
			//replace txt file
			file_put_contents($ftp_users_file, $ftp_users);
			
			// $ftp_users_cleaned	= escapeshellarg($_POST['ftp_users']);
			
			// $issue_cmd	= "sudo -u www-data sudo echo \"{$ftp_users_cleaned}\" > {$ftp_users_file}";
			// $response	= exec($issue_cmd);
			// $_MSGS[]	= array('type'=>'info','msg'=>"response: {$response}");
			

			
			//remove db file
			$issue_cmd	= "sudo -u www-data sudo rm -f {$ftp_users_db}";
			$response	= exec($issue_cmd);
		//	$_MSGS[]	= array('type'=>'info','msg'=>"response: {$response}");
			
			//rehash db file
			$issue_cmd	= "sudo -u www-data sudo db5.3_load -T -t hash -f {$ftp_users_file} {$ftp_users_db}";
			$response	= exec($issue_cmd);
		//	$_MSGS[]	= array('type'=>'info','msg'=>"response: {$response}");			
			
			//restart ftp
			$issue_cmd	= "sudo -u www-data sudo rm -f service vsftpd restart";
			$response	= exec($issue_cmd);
		//	$_MSGS[]	= array('type'=>'info','msg'=>"response: {$response}");
			
			$_MSGS[]	= array('type'=>'info','msg'=>"arkontrol has issued the `restart` command to the FTP server.");
			
		}
	}
	
	$_MSGS[]	= array('type'=>'info','msg'=>'ARKontrol highly recommends using <a href="https://filezilla-project.org" target="_new">FileZilla</a> as your FTP client.');
	
	$_VIEW->assign('ftp_users', $ftp_users);
	$_VIEW->assign('_MSGS', $_MSGS);
	$_VIEW->display('ftpConfig.tpl');
	
//$response = exec($issue_cmd);
//$_MSGS[]	= array('type'=>'info','msg'=>"response: {$response}");