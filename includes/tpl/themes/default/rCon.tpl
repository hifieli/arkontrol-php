{include file="_head.tpl"}

<h2>rCon for ARK</h2>

<br /><br />

<pre>{$rcon_help|print_r}</pre>

{if !empty($go_ahead)}
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">rCon</h3>
				</div>
				<div class="panel-body">
					
					
						<textarea name="rcon-std-out" id="rcon-std-out" style="height:66%;width:90%;"></textarea>

						<input type="text" name="rcon-cmd-string" id="rcon-cmd-string">
						<input type="button" value="Issue Command" id="rcon-cmd-button">
					
					
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">rCon Command Reference</h3>
				</div>
				<div class="panel-body">
					
					<table class="table">
						<tr>
						{*	<td class="col-xs-2">Group</td> *}
							<td class="col-xs-2">Command</td>
							<td class="col-xs-2">Arguments</td>
							<td>Description</td>
						</tr>
						
					{foreach $rcon_help as $cat => $info}
						<tr>
						{*	<td class="col-xs-2">{$info.group|escape}</td> *}
							<td class="col-xs-2">{$info.command|escape}</td>
							<td class="col-xs-2">{$info.arguments|escape}</td>
							<td>{$info.description|escape}</td>
						</tr>
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
						ajax_request('rcon-cmd', {'rcon-cmd-string':user_cmd});
					
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