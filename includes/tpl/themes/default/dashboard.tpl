{include file="_head.tpl"}

<h1>Welcome back {$_INICONF['webadminname']}!</h1>

<p><br /></p>

{include file="serverStatus.tpl"}

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Dashboard</h3>
	</div>
	<div class="panel-body">


		<div class="row">

			<div class="col-md-4">
				<h4>ARK Admin Tools</h4>
				<ul class="nav nav-stacked">
					<li><a href="/do/serverDetails.php">Server Control</a></li>
					<li><a href="/do/serverWhitelist.php">Admin Whitelist</a></li>
					<li><a href="/do/browseLogs.php">Server Logs</a></li>
				</ul>
			</div>

			<div class="col-md-4">
				<h4>ARK Configuration</h4>
				<ul class="nav nav-stacked">			
					<li><a href="/do/serverProfiles.php">Manage Profiles</a></li>
					<li><a href="/do/serverConfig.php">Server Config</a></li>
					<li><a href="/do/serverConfigEngrams.php">Engram Config</a></li>
					<li><a href="/do/serverConfigSpawn.php">Dino Spawn weights</a></li>
					<li><a href="/do/serverConfigRaw.php">Raw Config Files</a></li>
				</ul>
			</div>
			<div class="col-md-4">
				<h4>ARKontrol Tools</h4>
				<ul class="nav nav-stacked">			
					<li><a href="/do/webAuth.php">Change ARKontrol Password</a></li>
					<li><a href="/do/panelUpgrade.php">Upgrade ARKontrol</a></li>
					<li><a href="/do/systemDetails.php">System Details</a></li>
					<li><a href="/do/webDebug.php">Debug</a></li>
				</ul>
			</div>
		</div>

		<div class="row">
			<br /><br /><br />
		</div>

		<div class="row">
			<div class="col-md-4">
				<h4>In the works</h4>
				<ul class="nav nav-stacked">

					<li><a href="/do/dashboard.php">Dino/Player level ramps</a></li>
					<li><a href="/do/dashboard.php">Dino/Player XP/level caps</a></li>
					<li><a href="/do/dashboard.php">Harvested Resource Scaling</a></li>
					<li><a href="/do/dashboard.php">Item/Corpse Decomposition Scale</a></li>
					<li><a href="/do/dashboard.php">(s)FTP access to game files</a></li>

				</ul>
			</div>
			<div class="col-md-4">
				<h4>Planned for the future</h4>
				<ul class="nav nav-stacked">
					
					<li><a href="/do/dashboard.php">Backups of the world state</a></li>
					<li><a href="/do/dashboard.php">...Possibly to an external site</a></li>
					<li><a href="/do/dashboard.php">Additional Security Recommendations</a></li>

				</ul>
			</div>
			<div class="col-md-4">
				<h4>Will it be possible?</h4>
				<ul class="nav nav-stacked">
				
					<li><a href="/do/dashboard.php">Server Console Commands</a></li>
					<li><a href="/do/dashboard.php">rCon Commands</a></li>
					<li><a href="/do/dashboard.php">pull data from the world state</a></li>
					<li><a href="/do/dashboard.php">edit data in the world state</a></li>

				</ul>
			</div>
		</div>

	</div>
</div>

{include file="_foot.tpl"}