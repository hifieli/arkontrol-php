<?php
	chdir(dirname(__FILE__));
	include_once('../init.php');
	
	//do things.
	
	$result	= 'error';
	$data	= array('msg'=>'Nothing to do.');
	$cb		= '';
	
	try {
	
		if (!empty($_GET)) {
			
			if (!empty($_GET['call'])) {
				
				$uptime	= `uptime`;
				
				switch ($_GET['call']) {
					
					case 'ark-updatelog':
						$updatelog	= file_get_contents('/tmp/update.log');
						$result		= 'success';
						$cb			= 'callback_ark_updatelog';
						$data		= array('msg'=>'Updatelog fetched.', 'log'=>$updatelog, 'uptime'=>$uptime);
					break;
					
					case 'ark-status' :
						$cmd				= "service {$_INICONF['servicename']} status";
						$server_status_raw	= exec($cmd);
						$words				= explode(' ', $server_status_raw);
						$server_status		= rtrim(',', (!empty($words[1]))? $words[1]: 'unknown');
						
						switch ($server_status) {
							
							case strstr($server_status, 'running') :
								$server_status = 'running';
							break;
							
							case strstr($server_status, 'starting') :
								$server_status = 'starting';
							break;
							
							case strstr($server_status, 'stopping') :
								$server_status = 'stopping';
							break;
							
							case strstr($server_status, 'waiting') :
								$server_status = 'stopped';
							break;
							
							
							default:
								$server_status = 'unknown';
						}
						$result	= 'success';
						$cb		= 'callback_ark_status';
						$data	= array(
							'msg'				=> 'Status fetched.',
							'server_status_raw'	=> $server_status_raw,
							'server_status'		=> $server_status,
							'uptime'			=> $uptime
						);
					break;
					
					case 'uptime':
						$result		= 'success';
						$cb			= 'callback_uptime';
						$data		= array('msg'=>'uptime fetched.', 'uptime'=>$uptime);
					break;
					
					default:
						$data	= array('msg'=>'Invalid call specified.');
				}
				
			}
		}
	} catch (\Exception $e) {
		$data	= array('msg'=>$e->getMessage());
	}
	
	
	$response = array(
		'result'	=> $result,
		'data'		=> $data,
		'callback'	=> $cb,
	);
	
	
	$callback = filter_input(INPUT_GET, 'callback');
	echo $callback . "(" . json_encode($response) . ")";	