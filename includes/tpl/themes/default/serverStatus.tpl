			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">ARK Server Status</h3>
				</div>
				<div class="panel-body">
					
					<h3 id="server_status" style="margin-top:0;">Fetching ...</h3>
					<p  id="server_status_raw"></p>
					<p  id="server_status_time" class="text-muted"></p>
					<p  id="server_uptime" class="text-muted"></p>
					
				</div>
			</div>
			<script>
			$(document).ready(function() {
				setInterval(
					function () {
						if ( document.hasFocus() ) {
							ajax_request('ark-status', {});
						}
					},
					10000
				);
				ajax_request('ark-status', {});
			});

			function callback_ark_status(data) {
				var rightnow = new Date();
				$("#server_status").html(data.server_status);
				$("#server_status_time").html('as of ' + rightnow);
				$("#server_status_raw").html(data.server_status_raw);
				$("#server_uptime").html('Operating System Up '+data.uptime);
			}
			</script>