<?php

// mined from https://github.com/nuthing/pyARKon/blob/master/__main__.py

$rcon_help	= array();
	
$rcon_base	= array(
	'player' => array(
		array('listplayers', '', 'list current players in the server'),
		array('kickplayer', '[Steam64ID]', 'Kick player by steamID, cmd>>listplayers'),
		array('banplayer', '[Steam64ID]', 'Ban player by steamID, cmd>>listplayers'),
		array('unbanplayer', '[Steam64ID]', 'Unban player by steamID'),
		array('allowplayertojoinnocheck', '[PlayerName]', 'Add user to the whitelist, cmd>>listplayers'),
		array('disallowplayertojoinnocheck', '[PlayerName]', 'Remove user from whitelist, cmd>>listplayers'),
	),
	'server' => array(
		array('slomo', '[0.0 - 5.0]', 'Speed up or slow down the flow of time'),
		array('pause', '', 'Pauses the server.'),
		array('destroyallenemies', '', 'WARNING: Destruction of all enemies and creatures.'),
		array('playersonly', '', 'Freeze crafting and creature movement'),
		array('saveworld', '', 'CAUTION: Lag. Force world save'),
		array('doexit', '', 'WARNING: Corruption. Kill server immediately. Consider doing this: cmd>>pause cmd>>saveworld cmd>>doexit'),
		array('settimeofday', '[00:00 - 23:59]', 'Set time of day, 24hr separated by hrs:min'),
	),
	'chat' => array(
		array('setmessageoftheday', '[message]', 'Sets the MOTD'),
		array('showmessageoftheday', '[seconds]', 'Displays the current MOTD'),
		array('broadcast', '[message]', 'Broadcast a message in the MOTD window to all players'),
		array('getchat', '', 'Get chat log from server.'),
		array('serverchat', '[message]', 'Send a message from rcon to the server in chat window'),
		array('serverchatto', '"[Steam64ID]" [message]', 'Msg user by steamID(steamID in quotes)'),
		array('serverchattoplayer', '"[PlayerName]" [message]', 'Msg user by playername(playername in quotes)'),
	),

);

foreach ($rcon_base as $cat => $cmds) {
	foreach ($cmds as $info) {
		$rcon_help[ $info[0] ] = array(
			'command'		=> $info[0],
			'arguments'		=> $info[1],
			'description'	=> $info[2],
			'group'			=> $cat,
		);
	}
}