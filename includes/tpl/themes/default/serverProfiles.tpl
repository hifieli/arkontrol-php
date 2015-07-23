{include file="_head.tpl"}

<h2>Browse Configuration Profiles</h2>

<br /><br />


<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Available Profiles</h3>
	</div>
	<div class="panel-body">
		<p>Configuration Profiles are sets of saved configuration files for the ARK dedicated server. ARKontrol can package these up, allowing you to save and restore multiple server configurations. </p>
	
		{if !empty($profiles_custom)}
			<table class="table">
			{foreach $profiles_custom as $thisprofile}
				{if ($thisprofile != '.') && ($thisprofile != '..')}
				<tr>
					<td>{$thisprofile}</td>
					<td width="1">
						<form method="POST" action="/do/serverProfiles.php">
							<input type="hidden" name="action"  value="view">
							<input type="hidden" name="type"    value="custom">
							<input type="hidden" name="profile_name" value="{$thisprofile}">
							<input type="submit" class="btn btn-xs btn-primary" value="View">
						</form>
					</td>
					<td width="1">
						<form method="POST" action="/do/serverProfiles.php">
							<input type="hidden" name="action"  value="restore">
							<input type="hidden" name="type"    value="custom">
							<input type="hidden" name="profile_name" value="{$thisprofile}">
							<input type="submit" class="btn btn-xs btn-primary" value="Restore">
						</form>
					</td>
					<td width="1">
						<form method="POST" action="/do/serverProfiles.php">
							<input type="hidden" name="action"  value="download">
							<input type="hidden" name="type"    value="custom">
							<input type="hidden" name="profile_name" value="{$thisprofile}">
							<input type="submit" class="btn btn-xs btn-primary" value="Download">
						</form>
					</td>
					<td width="1">
						<form method="POST" action="/do/serverProfiles.php">
							<input type="hidden" name="action"  value="delete">
							<input type="hidden" name="type"    value="custom">
							<input type="hidden" name="profile_name" value="{$thisprofile}">
							<input type="submit" class="btn btn-xs btn-danger btn-del" data-profile-name="{$thisprofile}" value="Delete">
						</form>
					</td>
				</tr>
				{/if}
			{/foreach}
			</table>
		{else}
			<p>No Custom profiles available.</p>
		{/if}
		
	</div>
</div>		

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Create A Profile</h3>
	</div>
	<div class="panel-body">
		<p>You can generate a new configuration profile from the current saved configuration and download or restore it at a later date.</p>
		
		<form method="POST" action="/do/serverProfiles.php">
			<input type="hidden" name="action"  value="save">
			<p>Profile Name</p>
			<input type="text" name="profile_name"><br /><br />
			<input type="submit" class="btn btn-success" value="Create Profile">
		</form>
	</div>
</div>


<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Upload A Profile</h3>
	</div>
	<div class="panel-body">
		<p>If you have a previously generated configuration profile that you have downloaded you can upload it for use.</p>
		
		<form method="POST" action="/do/serverProfiles.php">
			<input type="hidden" name="action"  value="upload">
			<input type="file" name="new_custom_profile">
			<p></p>
			<input type="submit" class="btn btn-primary" value="Upload Profile">
		</form>
	</div>
</div>


<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Profile Snapshots</h3>
	</div>
	<div class="panel-body">
		<p>ARKontrol automatically makes a backup before making any configuration changes to your server.</p>
		
		{if !empty($profiles_snapshot)}
			<table class="table">
			{foreach $profiles_snapshot as $thisprofile}
				{if ($thisprofile != '.') && ($thisprofile != '..')}
				<tr>
					<td>{$thisprofile}</td>
					<td width="1">
						<form method="POST" action="/do/serverProfiles.php">
							<input type="hidden" name="action"  value="view">
							<input type="hidden" name="type"    value="snapshot">
							<input type="hidden" name="profile_name" value="{$thisprofile}">
							<input type="submit" class="btn btn-xs btn-primary" value="View">
						</form>
					</td>
					<td width="1">
						<form method="POST" action="/do/serverProfiles.php">
							<input type="hidden" name="action"  value="restore">
							<input type="hidden" name="type"    value="snapshot">
							<input type="hidden" name="profile_name" value="{$thisprofile}">
							<input type="submit" class="btn btn-xs btn-primary" value="Restore">
						</form>
					</td>
					<td width="1">
						<form method="POST" action="/do/serverProfiles.php">
							<input type="hidden" name="action"  value="download">
							<input type="hidden" name="type"    value="snapshot">
							<input type="hidden" name="profile_name" value="{$thisprofile}">
							<input type="submit" class="btn btn-xs btn-primary" value="Download">
						</form>
					</td>
					<td width="1">
						<form method="POST" action="/do/serverProfiles.php">
							<input type="hidden" name="action"  value="delete">
							<input type="hidden" name="type"    value="snapshot">
							<input type="hidden" name="profile_name" value="{$thisprofile}">
							<input type="submit" class="btn btn-xs btn-danger btn-del" data-profile-name="{$thisprofile}" value="Delete">
						</form>
					</td>
				</tr>
				{/if}
			{/foreach}
			</table>
		{else}
			<p>No Snapshots available.</p>
		{/if}		

		
	</div>
</div>

<script>

$(document).ready(function() {
	

	$('.btn-del').each(function () {
		$(this).click( function () {
		
			var profname	= $(this).attr('data-profile-name');
			
			return confirm('Remove '+profname+'? This action is irreversable. Would you like to proceed?');

		});
	});


});


</script>



{include file="_foot.tpl"}