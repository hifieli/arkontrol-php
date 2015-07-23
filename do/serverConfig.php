<?php
	chdir(dirname(__FILE__));
	include_once('../init.php');	//init for authenticated areas!
	
	//do things.
	
	include_once($_INICONF['webdocroot'] . '/includes/gameuserini.php');	//$gameuserini
	
	//get the GameUserSettings template. file->section->key = value
	$ini_spec		= $gameuserini;
	
	//so, the gameserver resets the persmissions on the logfiles when it is restarted. so we have to set permissions before we try to read/write.
	//$cmd	= "sudo chmod 666 /home/steam/ark_ds/ShooterGame/Saved/Config/LinuxServer/*";
	$cmd	= "sudo chmod 666 {$_INICONF['settingspath']}/*";
	exec($cmd); //exec($cmd . " > /dev/null &");
	
	//assemble array of ini settings. file->section->key = value
	$all_ini		= scandir($_INICONF['settingspath']);
	$ini_current	= array();
	foreach ($all_ini as $this_ini) {
		if (($this_ini != '.')  && ($this_ini != '..') ) {
			$this_arr		= @parse_ini_file($_INICONF['settingspath'] . "/{$this_ini}", true);
			$this_arr		= (!empty($this_arr)) ? $this_arr : array();
			
			$ini_current	= array_merge($ini_current, array($this_ini=>$this_arr));
		}
	}
	
	//Replace any values in the template with their real values from the ini files.
	foreach ($ini_spec as $ini_file => $file_arr) {
		foreach ($file_arr as $ini_sect => $sect_arr) {
			foreach ($sect_arr as $key => $info) {
				if (isset($ini_current[ $ini_file ][ $ini_sect ][ $key ])) {
					$ini_spec[ $ini_file ][ $ini_sect ][ $key ][ 'valc' ] = $ini_current[ $ini_file ][ $ini_sect ][ $key ];
				}
			}
		}
	}

	//Replace in values in the template with the new values from $_POST
	if (!empty($_POST)) {
		
		//get new values from $_POST
		$postdata	= $_POST;
		
		//unless we got a json_conf. just parse and use that instead
		if (!empty($_POST['json_conf'])) {
			$postdata	= json_decode($_POST['json_conf']);
		}
		
		$files_diffed	= array();
		$keys_diffed	= array();
		
		//process diff ($ini_current vs $_POST)
		foreach ($ini_spec as $ini_file => $file_arr) {
			foreach ($file_arr as $ini_sect => $sect_arr) {
				foreach ($sect_arr as $key => $info) {
					if (isset($postdata[ $key ])) {
						$files_diffed[ $ini_file ] = 1;
						$ini_spec[ $ini_file ][ $ini_sect ][ $key ][ 'valc' ] = strip_tags($postdata[ $key ]);
					}	
				}
			}
		}
		
		//Combine our template and real into a full config.
		//ini_spec is more up to date than ini_current at this point
		//we need to merge ini_spec and ini_current, preferring ini_spec, into $ini_comb
		$ini_comb	= $ini_spec;
		foreach ($ini_current as $ini_file => $file_arr) {
			foreach ($file_arr as $ini_sect => $sect_arr) {
				foreach ($sect_arr as $key => $info) {
					if (!isset($ini_spec[ $ini_file ]) || !isset($ini_spec[ $ini_file ][ $ini_sect ]) || !isset($ini_spec[ $ini_file ][ $ini_sect ][ $key ])) {
						$ini_comb[ $ini_file ] = (isset($ini_comb[ $ini_file ])) ? $ini_comb[ $ini_file ] : array();
						$ini_comb[ $ini_file ][ $ini_sect ] = (isset($ini_comb[ $ini_file ][ $ini_sect ])) ? $ini_comb[ $ini_file ][ $ini_sect ] : array();
						$ini_comb[ $ini_file ][ $ini_sect ][ $key ] = (isset($ini_comb[ $ini_file ][ $ini_sect ][ $key ])) ? $ini_comb[ $ini_file ][ $ini_sect ][ $key ] : array();
						$ini_comb[ $ini_file ][ $ini_sect ][ $key ][ 'valc' ] = $ini_current[ $ini_file ][ $ini_sect ][ $key ];
						$ini_comb[ $ini_file ][ $ini_sect ][ $key ][ 'name' ] = $key;
					}
				}
			}
		}		
		
		//Replace any files from which keys were altered when we merged in $_POST
		if (!empty($files_diffed)) {
			
			//make a snapshot for restoration. We want the old data, in case there is a problem and we need to restore.
			require_once($_INICONF['webdocroot'] . '/includes/class.snapshot.php');
			$snapshot		= new snapshot($_INICONF);
			$saved			= $snapshot->create(null, 'snapshot');
			
			foreach (array_keys($files_diffed) as $ini_file) {
				
				/*	
					Kludge to not process Game.ini. maybe others. maybe only do this to GameUserSettings...
					proper ini syntax would have been to representing multiple entries of the 
					same key with array brackets [].				
				*/
				if ($ini_file == 'Game.ini') { continue; }
			
				$ini_fullpath	= $_INICONF['settingspath'] . "/{$ini_file}";
				$newlines		= array();
				$file_arr		= $ini_comb[$ini_file];
				foreach ($file_arr as $ini_sect => $sect_arr) {
					$newlines[]	= "[{$ini_sect}]";
					foreach ($sect_arr as $key => $info) {
						$newlines[] = "{$info['name']}={$info['valc']}";
					}
					$newlines[]	= "";
				}
				
				if (!empty($newlines)) {
					file_put_contents($ini_fullpath, implode("\r\n", $newlines));
				}				
			}
			
			//if there were diffs, make sure we send a message telling them to restart ARK dedicated server.
			$_SESSION['need_to_restart'] = true;
		}

	}
	
	$for_display	= array();
	foreach ($ini_spec as $ini_file => $file_arr) {
		foreach ($file_arr as $ini_sect => $sect_arr) {
			foreach ($sect_arr as $key => $info) {
				switch (strtolower($info['type'])) {

					case 'float':
					case 'unknown':
						$info['valc']	= number_format((float)$info['valc'],6);
						$info['vald']	= number_format((float)$info['vald'],1);
					break;
					
					case 'integer':
						$info['valc']	= (int) $info['valc'];
						$info['vald']	= (int) $info['vald'];
					case 'string':
					case 'boolean':
					default:
						$info['valc']	= (string) $info['valc'];
						$info['vald']	= (string) $info['vald'];
					break;		
					
				}
				$info['file']	= $ini_file;
				$info['sect']	= $ini_sect;
				$for_display[ $info['group'] ][ $key ]	= $info;
			}
		}
	}
	ksort($for_display);
	
	$_VIEW->assign('gameuserini', $for_display);
	$_VIEW->assign('ini_current', $ini_current);
	$_VIEW->assign('ini_spec', $ini_spec);
	$_VIEW->assign('ini_comb', $ini_comb);
	$_VIEW->assign('_MSGS', $_MSGS);
	
	
	//Just viewing or changing INI options the normal way, show the normal page.
	$_VIEW->display('serverConfig.tpl');
	
