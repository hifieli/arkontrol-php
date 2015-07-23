{include file="_head.tpl"}

<h2>ARK Dedicated Server Configuration</h2>


<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Dino Spawn Rate Configuration</h3>
	</div>
	<div class="panel-body">
		{*
		<form method="POST" action="/do/serverConfigDinos.php" class="form">
			<input type="hidden" name="reset_emgrams" value="1">
			<input type="submit" class="btn btn-xl btn-warning" value="Reset Defaults">
		</form>
		*}
		
		
		<form method="POST" action="/do/serverConfigSpawn.php" class="form">
		<input type="submit" class="btn btn-xl btn-primary" value="Save Spawn Config">
		<input type="button" class="btn btn-xl btn-warning" value="Reset Defaults" onclick="resetAllDefaults();">
		<table class="table">
			<thead>
				<tr>
					<th><br></th>
					<th class="text-center"><span data-toggle="tooltip" data-placement="right" title="Spawn weight multiplier for this dino">Weight</span><br><input type="button" class="btn btn-xs mass-ctrl" data-ctrl-group="mass-weight" value="1" data-toggle="tooltip" data-placement="right" title="Set Spawn Weight Multiplier to 1 for all Dinos."> <input type="button" class="btn btn-xs mass-ctrl" data-ctrl-group="mass-weight" value="10" data-toggle="tooltip" data-placement="right" title="Set Spawn Weight Multiplier to 10 for all Dinos."></th>
					<th class="text-center"><span data-toggle="tooltip" data-placement="right" title="Override the maximum spawn percentage">Override?</span><br><input type="button" class="btn btn-xs mass-ctrl" data-ctrl-group="mass-override" value=" Y " data-toggle="tooltip" data-placement="right" title="Set Override for all Dinos to true."> <input type="button" class="btn btn-xs mass-ctrl" data-ctrl-group="mass-override" value=" N " data-toggle="tooltip" data-placement="right" title="Set Override for all Dinos to false."></th>
					<th class="text-center"><span data-toggle="tooltip" data-placement="right" title="If Override is checked, this is the maximum percent at which this dino can spawn. {*Percent expressed as a number between 0.00 and 1.00*}">Max Percent</span><br><input type="button" class="btn btn-xs mass-ctrl" data-ctrl-group="mass-limit" value="1" data-toggle="tooltip" data-placement="right" title="Set maximum to 1% for all Dinos."> <input type="button" class="btn btn-xs mass-ctrl" data-ctrl-group="mass-limit" value="10" data-toggle="tooltip" data-placement="right" title="Set maximum to 10% for all Dinos."> <input type="button" class="btn btn-xs mass-ctrl" data-ctrl-group="mass-limit" value="99" data-toggle="tooltip" data-placement="right" title="Set maximum to 99% for all Dinos."></th>
					<td class="text-left"><br></td>
				</tr>
			</thead>
			<tbody>
				{foreach $dino_combined as $key => $info}
				<tr>
					<td class="col-xs-2" id="{$info.name|replace:' ':'_'}" style="vertical-align: middle">
						<table>
							<tr>
								<td>
									<img class="hidden-xs hidden-sm" src="/img/dinos/186px-Dossier_{$info.name|ucwords|replace:' ':'_'|replace:'-':'_'}.png" alt="{$info.name}">
								</td>
								<td>
									<b>&nbsp;&nbsp;&nbsp;<a href="http://ark.gamepedia.com/{urlencode($info.name|replace:' ':'_')}" target="_new">{$info.name}</a></b>
								</td>
							</tr>
						</table>
					</td>
					<td class="col-xs-2 col-md-1" style="vertical-align: middle"><input class="col-xs-12 form-control mass-weight" type="text" name="SpawnWeightMultiplier_{$info.DinoNameTag}" id="SpawnWeightMultiplier_{$info.DinoNameTag}" value="{$info.SpawnWeightMultiplier}" data-defval="{$dino_defaults[$key].SpawnWeightMultiplier}" data-toggle="tooltip" data-placement="right" title="SpawnWeightMultiplier for this Dino ({$info.name}). Default: {$dino_defaults[$key].SpawnWeightMultiplier}"></td>
					<td class="col-xs-2 col-md-1" style="vertical-align: middle"><input class="col-xs-12 mass-override" type="checkbox" name="OverrideSpawnLimitPercentage_{$info.DinoNameTag}" id="OverrideSpawnLimitPercentage_{$info.DinoNameTag}" {if (!empty($info.OverrideSpawnLimitPercentage) && $info.OverrideSpawnLimitPercentage == 'true')}checked{/if} data-defval="false" data-toggle="tooltip" data-placement="right" title="Override this dino's ({$info.name}) spawn percentage"></td>
					<td class="col-xs-2 col-md-1" style="vertical-align: middle"><input class="col-xs-12 form-control mass-limit text-right" type="text" name="SpawnLimitPercentage_{$info.DinoNameTag}" id="SpawnLimitPercentage_{$info.DinoNameTag}" value="{$info.SpawnLimitPercentage * 100}" data-defval="{$dino_defaults[$key].SpawnLimitPercentage  * 100}" data-toggle="tooltip" data-placement="right" title="SpawnLimitPercentage ({$info.name}). Default: {$dino_defaults[$key].SpawnLimitPercentage * 100}%"></td>
					<td class="col-xs-4" style="vertical-align: middle"><br></td>
				</tr>
				{/foreach}
			</tbody>
		</table>
		<input type="submit" class="btn btn-xl btn-primary" value="Save Spawn Config">
		<input type="button" class="btn btn-xl btn-warning" value="Reset Defaults" onclick="resetAllDefaults();">
		</form>
		
	</div>
</div>


<script>

$(document).ready(function() {
	

	$('.mass-ctrl').each(function () {
		$(this).click( function () {
		
			var group	= $(this).attr('data-ctrl-group');
			var setval	= $(this).val();
			
			var  askBeforeWeDoAnything = confirm('Warning. This will set the '+group+' to '+setval+' for all Dinos. Would you like to proceed?');
			if (askBeforeWeDoAnything) {
			
				$('.'+group).each(function () {
					switch (group) {
						case 'mass-weight':
						case 'mass-limit':
							$(this).val(setval);
							break;
						case 'mass-override':
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

	var askBeforeWeDoAnything = confirm('Warning. This will reset all Dino Spawn Weights to their defaults. Would you like to proceed?');
	if (askBeforeWeDoAnything) {

		$('.mass-weight').each(function () {
			$(this).val( $(this).attr('data-defval') );
		});
		$('.mass-limit').each(function () {
			$(this).val( $(this).attr('data-defval') );
		});

		$('.mass-override').each(function () {
			$(this).prop('checked', false );
		});
	}
}

</script>

{include file="_foot.tpl"}