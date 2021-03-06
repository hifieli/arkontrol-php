{include file="_head.tpl"}


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
					<li><a href="/do/serverDetails.php">ARK Server Control</a></li>
					<li><a href="/do/rCon.php">rCon Commands</a></li>
					<li><a href="/do/serverWhitelist.php">Admin Whitelist</a></li>
					<li><a href="/do/serverProfiles.php">Manage Config Profiles</a></li>
					
					<li><a href="/do/steamLogBrowse.php">Steam Logs</a></li>
					<li><a href="/do/serverLogBrowse.php">ARK Server Logs</a></li>
				</ul>
			</div>

			<div class="col-md-4">
				<h4>ARK Configuration</h4>
				<ul class="nav nav-stacked">
					<li><a href="/do/serverConfig.php">Server Config</a></li>
					<li><a href="/do/serverConfigEngrams.php">Engram Config</a></li>
					<li><a href="/do/serverConfigTaming.php">Taming Config</a></li>
					<li><a href="/do/serverConfigSpawn.php">Dino Spawn Weights</a></li>
					<li><a href="/do/serverConfigResource.php">Resource Harvest Config</a></li>
					<li><a href="/do/serverConfigTuningTamed.php">Tamed Creature Tuning</a></li>
					<li><a href="/do/serverConfigTuningWild.php">Wild Creature Tuning</a></li>
					<li><a href="/do/serverConfigRaw.php">Raw Config Files</a></li>
				</ul>
			</div>
			<div class="col-md-4">
				<h4>ARKontrol Tools</h4>
				<ul class="nav nav-stacked">			
					<li><a href="/do/panelUpgrade.php">Update ARKontrol</a></li>
					<li><a href="/do/ftpControl.php">FTP Server Control</a></li>
					<li><a href="/do/webAuth.php">Change ARKontrol Password</a></li>
					<li><a href="/do/systemDetails.php">System Details</a></li>
					<li><a href="/do/webDebug.php">Environment Details</a></li>
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
				
					<li><a href="/do/dashboard.php">Changing Maps</a></li>
					<li><a href="/do/dashboard.php">Mods Browser</a></li>
					<li><a href="/do/dashboard.php">Dino/Player level ramps</a></li>
					<li><a href="/do/dashboard.php">Dino Replacements</a></li>
					<li><a href="/do/dashboard.php">PvP/PvE auto-switching</a></li>
					
				</ul>
			</div>
			<div class="col-md-4">
				<h4>Planned for the future</h4>
				<ul class="nav nav-stacked">
					
					<li><a href="/do/dashboard.php">Backups of the world state</a></li>
					<li><a href="/do/dashboard.php">Possibly to an external site</a></li>
					<li><a href="/do/dashboard.php">Additional Security Recommendations</a></li>
					<li><a href="/do/dashboard.php">Maintenance Mode & AutoUpdate</a></li>

				</ul>
			</div>
			<div class="col-md-4">
				<h4>Will it be possible?</h4>
				<ul class="nav nav-stacked">
				
					<li><a href="/do/dashboard.php">pull data from the world state</a></li>
					<li><a href="/do/dashboard.php">edit data in the world state</a></li>

				</ul>
			</div>
		</div>

	</div>
</div>

{include file="_foot.tpl"}