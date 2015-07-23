<?php /* Smarty version 3.1.27, created on 2015-07-22 22:38:08
         compiled from "/home/arkontrol/domains/bandsox.arkontrol.com/public_html/includes/tpl/themes/default/_head.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:99913502055b07dc058cfa3_07754790%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '88d2cf341b5166afa9f9f991478e0bf0ced2cad5' => 
    array (
      0 => '/home/arkontrol/domains/bandsox.arkontrol.com/public_html/includes/tpl/themes/default/_head.tpl',
      1 => 1436680218,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '99913502055b07dc058cfa3_07754790',
  'variables' => 
  array (
    '_INICONF' => 0,
    'valid_login' => 0,
    '_MSGS' => 0,
    'thismsg' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_55b07dc05b23e3_05035911',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55b07dc05b23e3_05035911')) {
function content_55b07dc05b23e3_05035911 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '99913502055b07dc058cfa3_07754790';
?>
<html>
	<head>
		<title>ARKontrol - A dedicated server manager for ARK: Survival Evolved</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<?php echo '<script'; ?>
 type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"><?php echo '</script'; ?>
>
	<!-- <?php echo '<script'; ?>
 type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"><?php echo '</script'; ?>
> -->
		<?php echo '<script'; ?>
 type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 type="text/javascript" src="/main.js"><?php echo '</script'; ?>
>

		<style type="text/css">
		<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['_INICONF']->value['webdocroot'])."/includes/tpl/themes/".((string)$_smarty_tpl->tpl_vars['_INICONF']->value['webtheme'])."/theme.css", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

		</style>
	</head>
	
	<body>
	
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">Home</a>
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
					
						<li class=""><a class="" href="http://arkcontrol.com">ARKontrol.com</a></li>
						
						<?php if (!empty($_smarty_tpl->tpl_vars['valid_login']->value)) {?>
							<li><a class="" href="/do/dashboard.php">Dashboard</a></li>
						<?php }?>
					
						<li><a href="/do/help.php">Help</a></li>
						<li><a href="/do/premium.php">Premium</a></li>
						
						
						<?php if (empty($_smarty_tpl->tpl_vars['valid_login']->value)) {?>
						<li class=""><a class="" href="/do/dashboard.php">Admin</a></li>
						<?php } else { ?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Admin <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								
								<li class="dropdown-header">ARKserver</li>
								<li><a href="/do/serverDetails.php">Details</a></li>
								<li><a href="/do/serverConfig.php">Configuration</a></li>
								<li><a href="/do/serverAdmins.php">Admin List</a></li>
								<li><a href="/do/rCon.php">Server rCon</a></li>
								<li><a href="/do/browseLogs.php">Server Logs</a></li>

								
								<li class="dropdown-header">ARKontrol</li>
								<li><a href="/do/webConfig.php">Configuration</a></li>
								<li><a href="/do/webAuth.php">Change Password</a></li>
								<li><a href="/do/panelUpgrade.php">Update</a></li>
							</ul>
						</li>
						<li><a href="/do/systemDetails.php">System</a></li>
						<li class=""><a class="" href="/logout.php">Logout</a></li>						
						<?php }?>
						
						<li>

						</li>
						<li style="padding-left:1em;">

						</li>
					</ul>
				</div>
			</div>
		</nav>

		<!-- Begin page content -->
		<div class="container">
		
		
		
		<?php if (!empty($_smarty_tpl->tpl_vars['_MSGS']->value)) {?>
			<?php
$_from = $_smarty_tpl->tpl_vars['_MSGS']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['thismsg'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['thismsg']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['thismsg']->value) {
$_smarty_tpl->tpl_vars['thismsg']->_loop = true;
$foreach_thismsg_Sav = $_smarty_tpl->tpl_vars['thismsg'];
?>
				<?php if ($_smarty_tpl->tpl_vars['thismsg']->value['type'] == 'error') {?>
					<div class="alert alert-danger" role="alert">
				<?php } elseif ($_smarty_tpl->tpl_vars['thismsg']->value['type'] == 'warning') {?>
					<div class="alert alert-warning" role="alert">
				<?php } elseif ($_smarty_tpl->tpl_vars['thismsg']->value['type'] == 'info') {?>
					<div class="alert alert-info" role="alert">
				<?php } elseif ($_smarty_tpl->tpl_vars['thismsg']->value['type'] == 'success') {?>
					<div class="alert alert-success" role="alert">
				<?php }?>
				
						<button type="button" class="close"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
						<p><?php echo $_smarty_tpl->tpl_vars['thismsg']->value['msg'];?>
</p>
					</div>
					
			<?php
$_smarty_tpl->tpl_vars['thismsg'] = $foreach_thismsg_Sav;
}
?>
		<?php }?>
		
		<?php if (!empty($_SESSION['need_to_restart'])) {?>
			<div class="alert alert-warning" role="alert">
				<button type="button" class="close"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
				
					<form method="post" action="/do/serverDetails.php">
						<input type="hidden" name="action" value="restart">
						<p>To apply recent changes to your ARK server configuration you must <input type="submit" class="btn btn-primary " value="Restart Server""></p>
					</form>
				
			</div>
		<?php }

}
}
?>