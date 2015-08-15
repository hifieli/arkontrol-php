{include file="_head.tpl"}


<h2>Change Web Password</h2>

<br><br>
<div class="col-md-6">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Password</h3>
		</div>
		<div class="panel-body">
			<form method="post">
				<table class="table">
					<tr><td>Old Password</td><td><input name="oldpass"  type="password" value=""></td></tr>
					<tr><td>New Password</td><td><input name="newpass"  type="password" value=""></td></tr>
					<tr><td>Confirm</td><td><input name="newpass2" type="password" value=""></td></tr>
					<tr><td colspan="2"><input type="submit" class="btn btn-info" value="Change Password">
				</table>
			</form>
		</div>
	</div>
</div>



<div class="alert alert-info" role="alert">
	<button type="button" class="close"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
	<p>If successful, you will be logged out automatically and must use the new password to regain access to the control panel.</p>
</div>


{include file="_foot.tpl"}