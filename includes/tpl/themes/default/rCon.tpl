{include file="_head.tpl"}

<h2>rCon for ARK</h2>

<br /><br />
{*
	rCon
	
	This page holds the rCon interface. The actual requests are handed to the server by way of ajax.php, which in turn calls /includes/rCon-process.php

	These variables are being passed to this template
*}{*

	_INICONF
	<pre>{$_INICONF|print_r}</pre>
	
	go_ahead
	<pre>{$go_ahead|print_r}</pre>
	
	rcon_help - iff !empty(go_ahead)
	<pre>{$rcon_help|print_r}</pre>

*}

{if empty($go_ahead)}
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
{else}
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">rCon</h3>
				</div>
				<div class="panel-body text-center">
						<form method="none" id="rcon-cmd-fakeform">
							<textarea name="rcon-std-out" id="rcon-std-out" style="height:66%;width:100%;"></textarea>
							<br /><br />
							<input type="text" name="rcon-cmd-string" id="rcon-cmd-string" class="col-xs-9">
							<input type="submit" value="Issue Command" id="rcon-cmd-button" class="col-xs-3">
						</form>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">rCon Command Reference</h3>
				</div>
				<div class="panel-body">
					
					<table class="table">
						<tr>
						{*	<th class="col-xs-2">Group</th> *}
							<th class="col-xs-2">Command</th>
							<th class="col-xs-2">Arguments</th>
							<th>Description</th>
						</tr>
						
					{foreach $rcon_help as $cat => $info}
						<tr>
						{*	<td class="col-xs-2">{$info.group|escape}</td> *}
							<td class="col-xs-2"><a href="#" class="rcon-cmd-link" data-rcon-cmd="{$info.command|escape}">{$info.command|escape}</a></td>
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
			
				$('#rcon-cmd-fakeform').on('submit', function(event) {
					var user_cmd	= $('#rcon-cmd-string').val();				//grab the current contents of the entry box
					if (user_cmd != '') {
						ajax_request('rcon-cmd', {'rcon-cmd-string':user_cmd});	//send the request to the ajax handler.
						$('#rcon-cmd-string').val('');	//clear the entry box
					}
					$('#rcon-cmd-string').focus();		//focus the entry box
					event.preventDefault();
					return false;
				});
				
				
				$('.rcon-cmd-link').each(function() {
					$(this).click(function(event) {
						$('#rcon-cmd-string').val( $(this).attr('data-rcon-cmd')+' ' );	//set the entry box text to this command
						$('#rcon-cmd-string').focus();									//focus the entry box
						$(document).scrollTop(0);										//scroll back to the top of the page
						event.preventDefault();
						return false;
					});
				});
				
			});
			
			function callback_rcon_cmd(data) {
				var old_output	= $('#rcon-std-out').val();
				$('#rcon-std-out').val(old_output + "> " + data.rcon_request + "\n" + data.rcon_response + "\n");	//push the request and response text to the output box
				$('#rcon-std-out').scrollTop(999999999);	//scroll the output box to the bottom
			}
{/literal}
			</script>
{/if}





{include file="_foot.tpl"}