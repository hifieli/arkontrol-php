{include file="_head.tpl"}
{*
	FTP Server Configuration
	
	Allows the specification of usernames/passwords for the FTP server.

	These variables are being passed to this template

*}{*

	_INICONF
	<pre>{$_INICONF|print_r}</pre>
	
	_MSGS
	<pre>{$_MSGS|print_r}</pre>
	
	ftp_users
	<pre>{$ftp_users|print_r}</pre>
	

*}
	{include file="ftpStatus.tpl"}

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">FTP User Configuration</h3>
		</div>
		<div class="panel-body">
		
			<p>
			Format: Alternating lines are username and password for each user: <br />
			arkftp <br />
			l33tP@sssw0rd <br />
			beverly <br />
			beverly-password <br />
			</p>
			
			<p>
			This example would create 2 users, 'arkftp' with password 'l33tP@sssw0rd' and 'beverly' with a not-so-secure password of 'beverly-password'
			</p>
			
			<form method="post">
				<textarea id="ftp_users" name="ftp_users" style="width: 66%; height: 100%">{$ftp_users}</textarea><br /><br />
				<input class="btn btn-md" type="submit" value="Save and Restart FTP">
			</form>

		</div>
	</div>



{include file="_foot.tpl"}