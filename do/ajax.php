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
					
					case 'rcon-cmd':
						
						require_once($_INICONF['webdocroot'] . '/includes/rCon-process.php');	//provides $rcon_request and $rcon_response
						$result		= 'success';
						$cb			= 'callback_rcon_cmd';
					//	$data		= array('msg'=>'rCon command processed.', 'rcon_response'=>htmlentities($rcon_response), 'rcon_request'=>htmlentities($rcon_request));
						$data		= array('msg'=>'rCon command processed.', 'rcon_response'=>$rcon_response, 'rcon_request'=>$rcon_request);
					break;
					
					case 'ark-updatelog':
						$updatelog	= file_get_contents('/tmp/update.log');
						$result		= 'success';
						$cb			= 'callback_ark_updatelog';
						$data		= array('msg'=>'Updatelog fetched.', 'log'=>$updatelog, 'uptime'=>$uptime);
					break;
					
					case 'ark-status' :
						$cmd				= "service {$_INICONF['servicename']} status";
						$server_status_raw	= exec($cmd);
						$server_status 		= 'Unknown';

						if ( strstr($server_status_raw, 'running') ) {
							$server_status = 'Running';
						}
						else if ( strstr($server_status_raw, 'starting') ) {
							$server_status = 'Starting';
						}
						else if ( strstr($server_status_raw, 'stopping') ) {
							$server_status = 'Stopping';
						}
						else if ( strstr($server_status_raw, 'waiting') ) {
							$server_status = 'Stopped';
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
						throw new \Exception('Invalid call specified.', 408);
				}
				
			}
		}
	} catch (\Exception $e) {
		$data	= array('msg'=>$e->getMessage(), 'code'=>$e->getCode());
		$result	= 'error';
	}
	
	
	$response = array(
		'result'	=> $result,
		'data'		=> $data,
		'callback'	=> $cb,
	);
	
	
	$callback = filter_input(INPUT_GET, 'callback');
	echo $callback . "(" . json_encode($response) . ")";	