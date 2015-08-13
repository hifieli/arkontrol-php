{include file="_head.tpl"}

<h2>ARK server Admin List</h2>

<br /><br />


<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Admin Whitelist</h3>
	</div>
	<div class="panel-body">
		<p>Text about the whitelist and how it works. Use the STEAM64 id, one per line, for each player that should be automatically granted admin access upon joining the server.</p>
			<form method="POST" action="/do/serverWhitelist.php">
			
			<textarea name="new_whitelist" style="width: 90%; height: 90%">{$whitelist_contents}</textarea>
						
			<input type="submit" class="btn btn-md btn-primary" value="Save Whitelist">
		</form>
		
	</div>
</div>



{include file="_foot.tpl"}