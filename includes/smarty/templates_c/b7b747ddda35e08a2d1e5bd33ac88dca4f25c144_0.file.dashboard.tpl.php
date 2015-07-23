<?php /* Smarty version 3.1.27, created on 2015-07-22 22:38:16
         compiled from "/home/arkontrol/domains/bandsox.arkontrol.com/public_html/includes/tpl/themes/default/dashboard.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:170010922255b07dc8eb5a19_26040649%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b7b747ddda35e08a2d1e5bd33ac88dca4f25c144' => 
    array (
      0 => '/home/arkontrol/domains/bandsox.arkontrol.com/public_html/includes/tpl/themes/default/dashboard.tpl',
      1 => 1437628402,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '170010922255b07dc8eb5a19_26040649',
  'variables' => 
  array (
    '_INICONF' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_55b07dc8edae37_03808853',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55b07dc8edae37_03808853')) {
function content_55b07dc8edae37_03808853 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '170010922255b07dc8eb5a19_26040649';
echo $_smarty_tpl->getSubTemplate ("_head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<h1>Welcome back <?php echo $_smarty_tpl->tpl_vars['_INICONF']->value['webadminname'];?>
!</h1>

<p><br /></p>

<?php echo $_smarty_tpl->getSubTemplate ("serverStatus.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


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
					<li><a href="/do/dashboard.php">(s)FTP access to game files</a></li>

				</ul>
			</div>
			<div class="col-md-4">
				<h4>Planned for the future</h4>
				<ul class="nav nav-stacked">
					
					<li><a href="/do/dashboard.php">...probably log file exposure</a></li>
					<li><a href="/do/dashboard.php">Backups of the world state</a></li>
					<li><a href="/do/dashboard.php">...Possibly to an external site</a></li>
					<li><a href="/do/dashboard.php">Additional Security Recommendations</a></li>

				</ul>
			</div>
			<div class="col-md-4">
				<h4>Will it be possible?</h4>
				<ul class="nav nav-stacked">
				
					<li><a href="/do/dashboard.php">rCon Commands</a></li>
					<li><a href="/do/dashboard.php">pull data from the world state</a></li>
					<li><a href="/do/dashboard.php">edit data in the world state</a></li>

				</ul>
			</div>
		</div>

	</div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("_foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>