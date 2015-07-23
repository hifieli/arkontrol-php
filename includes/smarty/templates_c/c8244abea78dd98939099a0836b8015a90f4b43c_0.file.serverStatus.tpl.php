<?php /* Smarty version 3.1.27, created on 2015-07-22 22:38:16
         compiled from "/home/arkontrol/domains/bandsox.arkontrol.com/public_html/includes/tpl/themes/default/serverStatus.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:103188898455b07dc8edf8e5_37621518%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c8244abea78dd98939099a0836b8015a90f4b43c' => 
    array (
      0 => '/home/arkontrol/domains/bandsox.arkontrol.com/public_html/includes/tpl/themes/default/serverStatus.tpl',
      1 => 1436813281,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '103188898455b07dc8edf8e5_37621518',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_55b07dc8ee2914_95963053',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55b07dc8ee2914_95963053')) {
function content_55b07dc8ee2914_95963053 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '103188898455b07dc8edf8e5_37621518';
?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">ARK Server Status</h3>
				</div>
				<div class="panel-body">
					
					<h3 id="server_status" style="margin-top:0;">Fetching ...</h3>
					<p  id="server_status_raw"></p>
					<p  id="server_status_time" class="text-muted"></p>
					<p  id="server_uptime" class="text-muted"></p>
					
				</div>
			</div>
			<?php echo '<script'; ?>
>
			$(document).ready(function() {
				setInterval(
					function () {
						if ( document.hasFocus() ) {
							ajax_request('ark-status', {});
						}
					},
					10000
				);
				ajax_request('ark-status', {});
			});

			function callback_ark_status(data) {
				var rightnow = new Date();
				$("#server_status").html(data.server_status);
				$("#server_status_time").html('as of ' + rightnow);
				$("#server_status_raw").html(data.server_status_raw);
				$("#server_uptime").html('Operating System Up '+data.uptime);
			}
			<?php echo '</script'; ?>
><?php }
}
?>