{include file="_head.tpl"}

<h2>ARK Dedicated Server Configuration (Raw)</h2>


<div class="row">

	<nav class="col-xs-3 conf-menu">
		<div class="fixed" style="position: fixed;">

			<ul class="nav nav-stacked fixed">
				<li>
					<h4>Related Tools</h4>
					<ul class="nav nav-stacked">
						<li><a href="/do/serverDetails.php">Server Control</a></li>
						<li><a href="/do/serverProfiles.php">Configuration Profiles</a></li>
						<li><a href="/do/serverConfig.php">Server Config</a></li>
						<li><a href="/do/serverConfigEngrams.php">Engram Config</a></li>
						<li><a href="/do/serverConfigSpawn.php">Spawn Config</a></li>
						<li><a href="/do/browseLogs.php">Server Logs</a></li>
					</ul>
				</li>

				<li>
					<h4>Skip to</h4>
					<ul class="nav nav-stacked">
					{foreach $inifiles as $group}
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
				
				<li>
					<br />
					<input type="button" class="btn btn-info col-xs-12" value="Refresh" onclick="javascript: history.go(0);"> 
					<br />
				</li>
			</ul>

		</div>
	
	</nav>
	
	<div class="col-xs-9">

		<form method="POST" action="/do/serverConfigRaw.php" class="form" id="conf_form" >
		{foreach $inicontents as $group => $groupinfo}
					<span id="group-{$group}"><br></span>
					<br /><br />
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">{$group}</h3>
						</div>
						<div class="panel-body">

							<textarea rows="{if empty($groupinfo) || (strlen($groupinfo) <= 2)}4{else}30{/if}" name="{$group}" style="width:100%;">{$groupinfo}</textarea>

						</div>
					</div>
			<hr />
			<input type="submit" class="btn btn-info" value="Save Config">
			
		{/foreach}
		

		</form>

	</div>
	
</div>

{include file="_foot.tpl"}