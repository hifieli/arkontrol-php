<?php /* Smarty version 3.1.27, created on 2015-07-22 22:38:10
         compiled from "/home/arkontrol/domains/bandsox.arkontrol.com/public_html/includes/tpl/themes/default/panelUpgrade.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2575106355b07dc229b563_38658693%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '490474988ce7574e1f1af6243ced5a58e06032e2' => 
    array (
      0 => '/home/arkontrol/domains/bandsox.arkontrol.com/public_html/includes/tpl/themes/default/panelUpgrade.tpl',
      1 => 1437624131,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2575106355b07dc229b563_38658693',
  'variables' => 
  array (
    'current_version' => 0,
    'latest_version' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_55b07dc22c4c06_08968197',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55b07dc22c4c06_08968197')) {
function content_55b07dc22c4c06_08968197 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2575106355b07dc229b563_38658693';
echo $_smarty_tpl->getSubTemplate ("_head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<h2>Update Arkontrol-php</h2>

<br><br>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Update</h3>
	</div>
	<div class="panel-body">
		<table class="table">
			<tbody>
				<tr>
					<td>
						Current Version: 
					</td>
					<td>
						<?php echo $_smarty_tpl->tpl_vars['current_version']->value;?>
 
					</td>
				</tr>	
				<tr>
					<td>
						Latest Version:
					</td>
					<td>
						<?php echo $_smarty_tpl->tpl_vars['latest_version']->value;?>

					</td>
				</tr>
				
				<tr>
					<td colspan="99" class="text-center">
						<form method="post">
							<input type="hidden" name="performUpdate" value="true">
							<?php if ($_smarty_tpl->tpl_vars['current_version']->value == $_smarty_tpl->tpl_vars['latest_version']->value) {?>
								<p>You are running the latest version, but you can refresh your copy if needed.</p>
								<input type="submit" class="btn btn-info btn-lg" value="Refresh my Arkontrol panel">
							<?php } else { ?>
								<p>You are not running the latest version, and should update at earliest convenience.</p>
								<input type="submit" class="btn btn-success btn-lg" value="Update my Arkontrol panel now!">
								<?php echo '<script'; ?>
>
								$(document).ready(function() {
									setInterval(
										function () {
											if ( document.hasFocus() ) {
												window.location.href = "/do/panelUpgrade.php";
											}
										},
										15000
									);
								});
								<?php echo '</script'; ?>
>
							<?php }?>
						</form>
					</td>
				</tr>

			</tbody>
		</table>
	</div>
</div>



<div class="alert alert-info" role="alert">
	<button type="button" class="close"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
	<p>The update will process in the background. If you have any trouble, remember to hard-refresh (CTRL+F5 for most users.)</p>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("_foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>