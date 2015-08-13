{include file="_head.tpl"}

<h2>rCon for ARK</h2>

<br /><br />

{if !empty($go_ahead)}
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">rCon</h3>
				</div>
				<div class="panel-body">
					
					<div class="row">
						<textarea name="rcon-std-out" id="rcon-std-out"></textarea>
					</div>
					<div class="row">
						<input type="text" name="rcon-cmd-string" id="rcon-cmd-string">
						<input type="button" value="Issue Command" id="rcon-cmd-button">
					</div>
					
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">rCon Command Reference</h3>
				</div>
				<div class="panel-body">
					
					<table class="table">
						<tr>
							<td class="col-xs-2">Command</td>
							<td class="col-xs-2">Arguments</td>
							<td>Description</td>
						</tr>
					{foreach $rcon_help as $cat => $info}
						<tr><td colspan="99">{$cat}</td></tr>
						{foreach $info as $stuff}
							<tr>
								<td class="col-xs-2">{$stuff.command}</td>
								<td class="col-xs-2">{$stuff.arguments}</td>
								<td>{$stuff.description}</td>
							</tr>
						{/foreach}
					{/foreach}
					</table>
					
				</div>
			</div>
			
			<script>
{literal}
			$(document).ready(function() {
				$('#rcon-cmd-button').click(function() {
					var user_cmd	= $('#rcon-cmd-string').val();
				
					if (user_cmd != '') {
						ajax_request('ark-updatelog', {'rcon-cmd-string':user_cmd});
					
						$('#rcon-cmd-string').val('');	//clear the entry box
					}
				});
			});
			
			function callback_rcon_cmd(data) {
				
				var old_output	= $('#rcon-std-out').val();
				$('#rcon-std-out').val(old_output + '\n' + data.rcon_response);
				
			}
{/literal}
			</script>
			
{else}

{/if}

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">rCon Disabled</h3>
				</div>
				<div class="panel-body">
					
					<p>
						rCon is currently disabled. Please see above for remedies.
					</p>
					
				</div>
			</div>



{include file="_foot.tpl"}