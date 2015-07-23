<?php /* Smarty version 3.1.27, created on 2015-07-22 22:38:08
         compiled from "/home/arkontrol/domains/bandsox.arkontrol.com/public_html/includes/tpl/themes/default/login.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:49924957555b07dc0567388_44382073%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '91a6a863fe2b962bdc809874bcf8628e2e5854ef' => 
    array (
      0 => '/home/arkontrol/domains/bandsox.arkontrol.com/public_html/includes/tpl/themes/default/login.tpl',
      1 => 1436941509,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '49924957555b07dc0567388_44382073',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_55b07dc058a811_30238047',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55b07dc058a811_30238047')) {
function content_55b07dc058a811_30238047 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '49924957555b07dc0567388_44382073';
echo $_smarty_tpl->getSubTemplate ("_head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>



<h2>Authentication Required</h2>

<br><br>

<div class="col-md-6">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Login</h3>
		</div>
		<div class="panel-body">
			<form method="post">
				<table class="table">
					<tr><td>Username</td><td><input name="username" value="admin"></td></tr>
					<tr><td>Password</td><td><input name="password" type="password" value=""></td></tr>
					<tr><td colspan="2"><input type="submit" class="btn btn-info" value="login"></td></tr>
				</table>
			</form>
		</div>
	</div>
</div>


<?php echo $_smarty_tpl->getSubTemplate ("_foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>