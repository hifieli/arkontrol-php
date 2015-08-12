{include file="_head.tpl"}

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
						{$current_version} 
					</td>
				</tr>	
				<tr>
					<td>
						Latest Version:
					</td>
					<td>
						{$latest_version}
					</td>
				</tr>
				
				<tr>
					<td colspan="99" class="text-center">
						<form method="post">
							<input type="hidden" name="performUpdate" value="true">
							{if $current_version == $latest_version}
								<p>You are running the latest version, but you can refresh your copy if needed.</p>
								<input type="submit" class="btn btn-info btn-lg" value="Refresh my Arkontrol panel">
							{else}
								<p>You are not running the latest version, and should update at earliest convenience. The new panel was released {$latest_version - $current_version} seconds after the version you are using.</p>
								<input type="submit" class="btn btn-success btn-lg" value="Update my Arkontrol panel now!">
								<script>
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
								</script>
							{/if}
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

{include file="_foot.tpl"}