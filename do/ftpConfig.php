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
			
			//replace txt file
			file_put_contents($ftp_users_file, $_POST['ftp_users']);
			
			//use the new info on the current page view (show them the info they just posted, bro)
			$ftp_users	= $_POST['ftp_users'];
			
			//remove db file
			$issue_cmd	= "sudo -u www-data sudo rm -f {$ftp_users_db}";
			$response	= exec($issue_cmd);
			$_MSGS[]	= array('type'=>'info','msg'=>"response: {$response}");
			
			//rehash db file
			$issue_cmd	= "sudo -u www-data sudo db5.3_load -T -t hash -f {$ftp_users_file} {$ftp_users_db}";
			$response	= exec($issue_cmd);
			$_MSGS[]	= array('type'=>'info','msg'=>"response: {$response}");			
			
			//restart ftp
			$issue_cmd	= "sudo -u www-data sudo rm -f service vsftpd restart";
			$response	= exec($issue_cmd);
			$_MSGS[]	= array('type'=>'info','msg'=>"response: {$response}");
			
			$_MSGS[]	= array('type'=>'info','msg'=>"arkontrol has issued the `restart` command to the FTP server.");
			
		}
	}
	
	$_VIEW->assign('ftp_users', $ftp_users);
	$_VIEW->assign('_MSGS', $_MSGS);
	$_VIEW->display('ftpConfig.tpl');
	
//$response = exec($issue_cmd);
//$_MSGS[]	= array('type'=>'info','msg'=>"response: {$response}");