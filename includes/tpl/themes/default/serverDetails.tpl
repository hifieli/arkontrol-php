{include file="_head.tpl"}

			{include file="serverStatus.tpl"}
			
			{if !empty($logwatch)}
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Activity Log</h3>
				</div>
				<div class="panel-body">
			
					<p  id="logwatch_p"></p>
					<textarea rows="15" id="logwatch_log" style="width: 100%; font-family: Courier New, Courier, terminal, system;"></textarea>
					<p class="text-muted"> * Be patient, it may take some time for the process to begin. It is common for the process to send large amounts of data to the log every minute or so, rather than small amounts of data every few seconds, which can be frustrating.</p>
					<p><input type="button" class="btn btn-md logwatch_refresh" value="Refresh"></p>
				</div>
			</div>
			{/if}

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">ARK Server Control</h3>
				</div>
				<div class="panel-body">
				
					<div class="container">			
						<div class="row">
							<div class="col-md-6">

								<div class="container">

								<div class="row"><br></div>
								
								<form method="post">
								<div class="row">
									<input type="hidden" name="action" value="restart">
									<input type="button" class="btn btn-lg btn-primary col-xs-3 action-init" data-action-group="restart" value="restart">
								</div>
								<div class="row col-xs-3 action-opts group-restart" data-option-group="restart" data-action-state="hidden" style="display: none;">
									<p>Are you sure? All players will be disconnected.</p>
									<input type="submit" class="btn btn-xs col-xs-4 btn-success  action-yes" value="Yes">
									<span class="col-xs-4"></span>
									<input type="button" class="btn btn-xs col-xs-4 btn-danger  action-no" value="No">
									<br><br>
								</div>								
								</form>

								<div class="row"><br></div>

								<form method="post">
								<div class="row">
									<input type="hidden" name="action" value="start">
									<input type="button" class="btn btn-lg btn-success col-xs-3 action-init" data-action-group="start" value="start">
								</div>
								<div class="row col-xs-3 action-opts group-start" data-option-group="start" data-action-state="hidden" style="display: none;">
									<p>Are you sure?</p>
									<input type="submit" class="btn btn-xs col-xs-4 btn-success  action-yes" value="Yes">
									<span class="col-xs-4"></span>
									<input type="button" class="btn btn-xs col-xs-4 btn-danger  action-no" value="No">
									<br><br>
								</div>								
								</form>

								<div class="row"><br></div>

								<form method="post">
								<div class="row">
									<input type="hidden" name="action" value="stop">
									<input type="button" class="btn btn-lg btn-danger col-xs-3 action-init" data-action-group="stop" value="stop">
								</div>
								<div class="row col-xs-3 action-opts group-stop" data-option-group="stop" data-action-state="hidden" style="display: none;">
									<p>Are you sure? All players will be disconnected.</p>
									<input type="submit" class="btn btn-xs col-xs-4 btn-success  action-yes" value="Yes">
									<span class="col-xs-4"></span>
									<input type="button" class="btn btn-xs col-xs-4 btn-danger  action-no" value="No">
									<br><br>
								</div>								
								</form>

								<div class="row"><br></div>



								</div>

							</div>
							<div class="col-md-6">
								
								<div class="container">
								<div class="row"><br></div>
								
								<form method="get" action="/do/serverConfig.php">
								<div class="row">
									<input type="submit" class="btn btn-lg btn-warning col-xs-3" value="configuration">
								</div>
								</form>
								
								<div class="row"><br></div>
								
								<form method="post">
								<div class="row">
									<input type="hidden" name="action" value="update">
									<input type="button" class="btn btn-lg btn-warning col-xs-3 action-init" data-action-group="update" value="update">
								</div>
								<div class="row col-xs-3 action-opts group-update" data-option-group="update" data-action-state="hidden" style="display: none;">
									<p>Are you sure? This could take several minutes, or even longer.</p>
									<input type="submit" class="btn btn-xs col-xs-4 btn-success  action-yes" value="Yes">
									<span class="col-xs-4"></span>
									<input type="button" class="btn btn-xs col-xs-4 btn-danger  action-no" value="No">
									<br><br>
								</div>								
								</form>


								<div class="row"><br></div>

								<form method="post">
								<div class="row">
									<input type="hidden" name="action" value="reinstall">
									<input type="button" class="btn btn-lg btn-info col-xs-3 action-init" data-action-group="reinstall" value="reinstall">
								</div>
								<div class="row col-xs-3 action-opts group-reinstall" data-option-group="reinstall" data-action-state="hidden" style="display: none;">
									<p>Are you sure? This process could take a long time to complete.</p>
									<input type="submit" class="btn btn-xs  col-xs-4 btn-success float-left action-yes" value="Yes">
									<span class="col-xs-4"></span>
									<input type="button" class="btn btn-xs  col-xs-4 btn-danger float-right action-no" value="No">
									<br><br>
								</div>								
								</form>

								<div class="row"><br></div>
								
								</div>
							</div>
						</div>
					</div>	
				</div>
			</div>
<script>

var logwatcher;
var logwatch	= {if !empty($logwatch)}1{else}0{/if};
var logcnt		= 0;
var logcntmax	= {if !empty($logwatch) && !empty($pretty_cmd) && ($pretty_cmd == 'reinstall')}2000{else}100{/if};


$(document).ready(function() {
	
	/*		*/
	$('.action-init').each(function () {
		$(this).click( function () {
			var group	= $(this).attr('data-action-group');
			
			if ($('.group-'+group).attr('data-action-state') == 'hidden') {
				$('.group-'+group).show();
				$('.group-'+group).attr('data-action-state', 'visible');
			} else {
				$('.group-'+group).hide();
				$('.group-'+group).attr('data-action-state', 'hidden');			
			}
		});
		//var group = $(this).attr('data-action-group');
		//$('.group-'+group).hide();
	});
	
	$('.action-no').each(function () {
		$(this).click( function () {
			$(this).parent().attr('data-action-state', 'hidden');
			$(this).parent().hide();
		});
	});

	if (logwatch > 0) {
	
		$('.logwatch_refresh').click( function () {
			start_logwatcher();
		});
		
		start_logwatcher();
	}

});

function start_logwatcher() {
	
	logcnt		= 0;
	
	clearInterval(logwatcher);

	logwatcher = setInterval(
		function () {
			logcnt++;
			
			if ( document.hasFocus() ) {
				$('.logwatch_refresh').attr('value','fetching...');
				ajax_request('ark-updatelog', {});
			}
		},
		6000
	);
	
	ajax_request('ark-updatelog', {});
}

function callback_ark_updatelog(data) {
	if (logcnt > logcntmax) {
		clearInterval(logwatcher);
	}
	
	$("#logwatch_log").html(data.log);
	$("#logwatch_log").scrollTop(999999999);
	
	$('.logwatch_refresh').attr('value','Refresh');
	
}
</script>

{include file="_foot.tpl"}