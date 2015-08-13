{include file="_head.tpl"}

<h2>ARK Dedicated Server Configuration</h2>


	taming_combined
	<pre>{$taming_combined|print_r}</pre>

	taming_alreadyini
	<pre>{$taming_alreadyini|print_r}</pre>

	taming_defaults
	<pre>{$taming_defaults|print_r}</pre>
	
	_POST
	<pre>{$smarty.post|print_r}</pre>


<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Taming Configuration</h3>
	</div>
	<div class="panel-body">
		
		
		<form method="POST" action="/do/serverConfigTaming.php" class="form">
		<input type="submit" class="btn btn-xl btn-primary" value="Save Taming Config">
		<input type="button" class="btn btn-xl btn-warning" value="Reset Defaults" onclick="resetAllDefaults();">
		<table class="table">
			<thead>
				<tr>
					<th><br></th>
					<th class="text-center">
						<span data-toggle="tooltip" data-placement="right" title="Disable Taming for the given dino.">Taming Disabled</span>
						<br><input type="button" class="btn btn-xs mass-ctrl" data-ctrl-group="mass-disable" value=" Y " data-toggle="tooltip" data-placement="right" title="Disable Taming for all dinos"> 
						<input type="button" class="btn btn-xs mass-ctrl" data-ctrl-group="mass-disable" value=" N " data-toggle="tooltip" data-placement="right" title="Enable Taming for all dinos">
					</th>
					<th><br></th>
				</tr>
			</thead>
			<tbody>
				{foreach $taming_combined as $key => $info}
				<tr>
					<td class="col-xs-2" id="{$info.name|replace:' ':'_'}">
						<table>
							<tr>
								<td>
									<img src="/img/dinos/{$info.thumbnail}" alt="{$info.name}">
								</td>
								<td>
									<b><a href="http://ark.gamepedia.com/{urlencode($info.name|replace:' ':'_')}" target="_new">{$info.name}</a></b>
								</td>
							</tr>
						</table>
						</td>
					<td class="col-xs-2  col-md-1 vert-align-mid"><input class="col-xs-12 mass-disable" type="checkbox" name="TamingDisabled_{$info.ClassName}" id="TamingDisabled_{$info.ClassName}" {if (!empty($info.TamingDisabled) && $info.TamingDisabled == 1)}checked{/if} data-defval="0" data-toggle="tooltip" data-placement="right" title="Disable Taming for this Dino ()"></td>
					<td class="col-xs-8  col-md-9"><br /></td>
				</tr>
				{/foreach}
			</tbody>
		</table>
		<input type="submit" class="btn btn-xl btn-primary" value="Save Taming Config">
		</form>
		
	</div>
</div>


<script>

$(document).ready(function() {
	

	$('.mass-ctrl').each(function () {
		$(this).click( function () {
		
			var group	= $(this).attr('data-ctrl-group');
			var setval	= $(this).val();
			
			var  askBeforeWeDoAnything = confirm('Warning. This will set the '+group+' to '+setval+' for all Tamings. Would you like to proceed?');
			if (askBeforeWeDoAnything) {
			
				$('.'+group).each(function () {
					switch (group) {
						case 'mass-disable':
							if (setval == ' Y ') {
								$(this).prop('checked', true);
							} else {
								$(this).prop('checked', false);
							}
							break;
					}
				});
			}
			
			$(this).blur();
		});
	});


});

function resetAllDefaults() {

	var askBeforeWeDoAnything = confirm('Warning. This will reset all Taming options to their defaults. Would you like to proceed?');
	if (askBeforeWeDoAnything) {

		$('.mass-disable').each(function () {
			$(this).prop('checked', false );
		});	

	}
}

</script>

{include file="_foot.tpl"}