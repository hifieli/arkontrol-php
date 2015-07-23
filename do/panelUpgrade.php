<?php
	chdir(dirname(__FILE__));
	include_once('../init.php');
	
	//do things.
	
	$doing_an_upgrade	= false;
	
	if (strstr($_SERVER['SERVER_NAME'], 'arkontrol.com')) {
		$_MSGS[]	= array('type'=>'error','msg'=>"We do not want to update this panel with this utility.");
		$_POST		= array();
	}

	$latest_version	= @file_get_contents('http://cdn.arkontrol.com/arkontrol-php-version');
	if (empty($latest_version)) { $latest_version = 'unknown'; }
	
	$current_version	= $_INICONF['version'];
	
	$_VIEW->assign('latest_version', $latest_version);
	$_VIEW->assign('current_version', $current_version);
	
	
	if (!empty($_POST)) {
		if (!empty($_POST['performUpdate'])) {
			$cmd	= "cd /var/www && wget http://cdn.arkontrol.com/arkontrol-php.tar &&  tar -xvzf arkontrol-php.tar --overwrite &&  rm -f arkontrol-php.tar &&  chmod 777 /var/www/includes/smarty/templates_c/ &&  mv /var/www/arkontrol.ini /etc/arkontrol.ini &&  chmod 777 /etc/arkontrol.ini";
			$upgrading = exec($cmd . " > /dev/null &");
			//$upgrading = exec($cmd . " 2>&1" ,$somelines,$someexitcode);
			//$_MSGS[]	= array('type'=>'info','msg'=>"{$upgrading} - {$someexitcode} - " . json_encode($somelines));
		
			$doing_an_upgrade	= true;
			$_MSGS[]	= array('type'=>'success','msg'=>"Update {$latest_version} is downloading in the background.");
		}
	} else {
		if ($current_version != $latest_version) {
			$_MSGS[]	= array('type'=>'success','msg'=>"arkontrol-php v{$latest_version} is now available. You are running arkontrol-php v{$current_version}. Please upgrade at earliest convenience.");
		}
	}
	
	$_VIEW->assign('_MSGS', $_MSGS);
	$_VIEW->assign('doing_an_upgrade', $doing_an_upgrade);
	$_VIEW->display('panelUpgrade.tpl');