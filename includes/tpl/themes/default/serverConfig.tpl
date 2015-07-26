{include file="_head.tpl"}

<h2>ARK Dedicated Server Configuration</h2>


<div class="row">

	<nav class="col-xs-3 conf-menu">
		<div class="fixed" style="position: fixed;">

			<ul class="nav nav-stacked fixed">
				<li>
					<h4>Related Tools</h4>
					<ul class="nav nav-stacked">
						<li><a href="/do/serverDetails.php">Server Control</a></li>
						<li><a href="/do/serverProfiles.php">Configuration Profiles</a></li>
						<li><a href="/do/serverConfigRaw.php">Raw Config</a></li>
						<li><a href="/do/serverConfigEngrams.php">Engram Config</a></li>
						<li><a href="/do/serverConfigSpawn.php">Spawn Config</a></li>
						<li><a href="/do/browseLogs.php">Server Logs</a></li>
					</ul>
				</li>

				<li>
					<h4>Skip to</h4>
					<ul class="nav nav-stacked">
					{foreach $gameuserini as $group => $groupinfo}
						<li><a href="#group-{$group}">{$group}</a></li>
					{/foreach}
					</ul>
				</li>
				
				<li>
					<br />
					<input type="button" class="btn btn-info col-xs-12" value="Save Config" onclick="$('#conf_form').submit();"> 
					<br />
				</li>
				
				<li>
					<br />
					<form method="post" action="/do/serverDetails.php">
						<input type="hidden" name="action" value="restart">
						<input type="submit" class="btn btn-primary col-xs-12" value="Restart Server">
					</form>
					<br />
				</li>
			</ul>

		</div>
	
	</nav>
	
	<div class="col-xs-9">

		<form method="POST" action="/do/serverConfig.php" class="form" id="conf_form" >
		{foreach $gameuserini as $group => $groupinfo}
					<span id="group-{$group}"><br></span>
					<br /><br />
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">{$group}</h3>
						</div>
						<div class="panel-body">
							<table class="table">
								<tbody>
						{foreach $groupinfo as $key => $info}
							
									<tr><td class="col-sm-2"><b>{$info.name}</b></td><td>
					
									{if $info.type == 'boolean'}
										<select class="col-sm-3" name="{$info.name}" id="{$info.name}" value="{$info.valc}" data-toggle="tooltip" data-placement="right" title="type: {$info.type} &nbsp;&nbsp; default: {$info.vald}">
											<option value="true"  {if $info.vald == 'true'}selected{/if} >true</option>
											<option value="false" {if $info.vald == 'false'}selected{/if}>false</option>
										</select>
									{else}
										<input class="col-sm-3"type="text" name="{$info.name}" id="{$info.name}" value="{$info.valc}" data-toggle="tooltip" data-placement="right" title="type: {$info.type} &nbsp;&nbsp; default: {$info.vald}"></td></tr>
									{/if}
									</td></tr>
									<tr><td colspan="2"><i>{$info.desc}</i><br><br></td></tr>
									

						{/foreach}
								</tbody>
							</table>
						</div>
					</div>
			<hr />
			<input type="submit" class="btn btn-info" value="Save Config">
			
		{/foreach}
		

		</form>

		{*
		<p>from the files</p>
		<pre>{$ini_current|print_r}</pre>
		<p>just our template</p>
		<pre>{$ini_spec|print_r}</pre>
		<p>template, values replaced from files</p>
		<pre>{$gameuserini|print_r}</pre>
		<p>everything. template and from the files together</p>
		<pre>{$ini_comb|print_r}</pre>		
		*}
		
	</div>
	
</div>

<script>
var HasUnsavedChanges = false;

$(document).ready(function() {
	
	$('input').each(function () {
		$(this).change( function () {
			HasUnsavedChanges = true;
		});
	});
	
	$('input[type=submit]').each(function () {
		$(this).click( function () {
			HasUnsavedChanges = false;
		});
	});
	
	$(window).bind('beforeunload', function(){
	
		if (HasUnsavedChanges) {
			return 'You have made changes that are not saved. You may proceed and abandon the changes, or return and save your changes.';
		}

	});
	
});
</script>

{include file="_foot.tpl"}