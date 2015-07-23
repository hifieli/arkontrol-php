{include file="_head.tpl"}

<h2>View Configuration Profile</h2>

<p><a href="/do/serverProfiles.php" class="btn btn-xl btn-primary">Back to list</a></p>

<br /><br />


<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">{$profile}</h3>
	</div>
	<div class="panel-body">
		<form method="POST" action="/do/serverProfiles.php">
			<input type="hidden" name="action"  value="restore">
			<input type="hidden" name="type"    value="custom">
			<input type="hidden" name="profile" value="{$profile}">
			<input type="submit" class="btn btn-md btn-primary" value="Restore">
		</form>
		
		<pre>{$profile_data|print_r}</pre>
		
		<form method="POST" action="/do/serverProfiles.php">
			<input type="hidden" name="action"  value="restore">
			<input type="hidden" name="type"    value="custom">
			<input type="hidden" name="profile" value="{$profile}">
			<input type="submit" class="btn btn-md btn-primary" value="Restore">
		</form>
		
	</div>
</div>



{include file="_foot.tpl"}