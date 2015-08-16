{*
	FTP server Status Widget
	
	Shows the status of the FTP server and continually polls for updates via ajax.php

	These variables are being passed to this template

*}{*

	_INICONF
	<pre>{$_INICONF|print_r}</pre>
	
	_MSGS
	<pre>{$_MSGS|print_r}</pre>
	
	pretty_cmd
	<pre>{$pretty_cmd|print_r}</pre>
	

*}
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">ARK FTP Server Status</h3>
				</div>
				<div class="panel-body">
					
					<h3 id="ftp_server_status" style="margin-top:0;">Fetching ...</h3>
					<p  id="ftp_server_status_raw"></p>
					<p  id="ftp_server_status_time" class="text-muted"></p>
					<p  id="ftp_server_uptime" class="text-muted"></p>
					
				</div>
			</div>
			<script>
			$(document).ready(function() {
				setInterval(
					function () {
						if ( document.hasFocus() ) {
							ajax_request('ark-ftp-status', {});
						}
					},
					10000
				);
				ajax_request('ark-ftp-status', {});
			});

			function callback_ark_ftp_status(data) {
				var rightnow = new Date();
				$("#ftp_server_status").html(data.ftp_server_status);
				$("#ftp_server_status_time").html('as of ' + rightnow);
				$("#ftp_server_status_raw").html(data.ftp_server_status_raw);
				$("#ftp_server_uptime").html('Operating System Up '+data.uptime);
			}
			</script>