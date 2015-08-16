{include file="_head.tpl"}
{*
	FTP Server Control
	
	Interface for stopping/starting/restarting the FTP server

	These variables are being passed to this template

*}{*

	_INICONF
	<pre>{$_INICONF|print_r}</pre>
	
	_MSGS
	<pre>{$_MSGS|print_r}</pre>
	
	pretty_cmd
	<pre>{$pretty_cmd|print_r}</pre>
	
*}
			{include file="ftpStatus.tpl"}

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">ARK FTP Server Control</h3>
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
									<p>Are you sure?</p>
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
								
								
								</div>
							</div>
						</div>
					</div>	
				</div>
			</div>
<script>
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


});

</script>

{include file="_foot.tpl"}