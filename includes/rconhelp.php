<?php

// mined from https://github.com/nuthing/pyARKon/blob/master/__main__.py

$rcon_help	= array();
	
$rcon_base	= array(
	'player' => array(
		array('listplayers', '', 'list current players in the server'),
		array('kickplayer', '<Steam64ID>', 'kick player by steamID, cmd>>listplayers'),
		array('allowplayertojoinnocheck', '<PlayerName>', 'add user to the whitelist, cmd>>listplayers'),
		array('disallowplayertojoinnocheck', '<PlayerName>', 'remove user from whitelist, cmd>>listplayers'),
		array('banplayer', '<Steam64ID>', 'ban player by steamID, cmd>>listplayers'),
		array('unbanplayer', '<Steam64ID>', 'unban player by steamID'),
		array('playersonly', '', 'Freeze crafting and creature movement'),
	),
	'server' => array(
		array('slomo', '<0.0 - 5.0>', 'Speed up or slow down server time float multiplier'),
		array('pause', '', 'Pauses the server.'),
		array('destroyallenemies', '', 'WARNING(death): destroy all enemy/dino'),
		array('saveworld', '', 'CAUTION(lag): force world save'),
		array('doexit', '', 'WARNING(corruption): kill server!! in rcon cmd>>pause cmd>>saveworld cmd>>doexit'),
		array('settimeofday', '<00:00 - 23:59>', 'set time of day, 24hr separated by hrs:min'),
	),
	'chat' => array(
		array('setmessageoftheday', '<message>', 'sets the MOTD'),
		array('showmessageoftheday', '<seconds>', 'displays the current MOTD'),
		array('broadcast', '<message>', 'broadcast a message in the MOTD window to all players'),
		array('getchat', '', 'get chat log from server, if chat loggin is set to True, logs to Chat.log'),
		array('serverchat', '<message>', 'send a message from rcon to the server in chat window'),
		array('serverchatto', '<Steam64ID> <message>', 'msg user by steamID(steamID in quotes)'),
		array('serverchattoplayer', '<PlayerName> <message>', 'msg user by playername(playername in quotes)'),
	),

	'program' => array(
		array('man', '<cmd>', 'man <cmd>    info about command'),
		array('help', '', 'prints back this list of commands'),
		array('history', '(cmd)|chat', 'show chat/cmd history, use getchat to save chat history'),
		array('clear', '(cmd)|chat', 'clear chat/cmd history, no argument will clear cmd history'),
	),
);

foreach ($rcon_base as $cat => $cmds) {
	foreach ($cmds as $info) {
		$rcon_help[ $info[0] ] = array(
			'command'		=> $info[0],
			'argumnets'		=> $info[1],
			'description'	=> $info[2],
			'group'			=> $cat,
		);
	}
}