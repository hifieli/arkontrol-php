{include file="_head.tpl"}

<h2>ARK Dedicated Server Configuration</h2>

{*
	dinodamres_dmg_combined
	<pre>{$dinodamres_dmg_combined|print_r}</pre>
	
	dinodamres_res_combined
	<pre>{$dinodamres_res_combined|print_r}</pre>

	damages_alreadyini
	<pre>{$damages_alreadyini|print_r}</pre>
	
	resistances_alreadyini
	<pre>{$resistances_alreadyini|print_r}</pre>

	dinodamres_dmg_defaults
	<pre>{$dinodamres_dmg_defaults|print_r}</pre>
	
	dinodamres_res_defaults
	<pre>{$dinodamres_res_defaults|print_r}</pre>
*}

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Wild Creature Tuning</h3>
	</div>
	<div class="panel-body">
	
		
		<form method="POST" action="/do/serverConfigTuningWild.php" class="form">
		<input type="submit" class="btn btn-xl btn-primary" value="Save Resource Config">
		<input type="button" class="btn btn-xl btn-warning" value="Reset Defaults" onclick="resetAllDefaults();">
		<table class="table">
			<thead>
				<tr>
					<th><br></th>
					<th class="text-center">
						<span data-toggle="tooltip" data-placement="right" title="Damage Multiplier for this creature.">Damage Multiplier</span>
						<br><input type="button" class="btn btn-xs mass-ctrl" data-ctrl-group="mass-multiplier-dmg" value="1" data-toggle="tooltip" data-placement="right" title="Set harvest multiplier to 1 for all Resources."> <input type="button" class="btn btn-xs mass-ctrl" data-ctrl-group="mass-multiplier-dmg" value="99" data-toggle="tooltip" data-placement="right" title="Set harvest multiplier to 99 for all Resources.">
					</th>
					
					<th class="text-center">
						<span data-toggle="tooltip" data-placement="right" title="Resistance Multiplier for this creature.">Resistance Multiplier</span>
						<br><input type="button" class="btn btn-xs mass-ctrl" data-ctrl-group="mass-multiplier-res" value="1" data-toggle="tooltip" data-placement="right" title="Set harvest multiplier to 1 for all Resources."> <input type="button" class="btn btn-xs mass-ctrl" data-ctrl-group="mass-multiplier-dmg" value="99" data-toggle="tooltip" data-placement="right" title="Set harvest multiplier to 99 for all Resources.">
					</th>
				</tr>
			</thead>
			<tbody>
				{foreach $dinodamres_dmg_combined as $key => $info}
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
					<td class="col-xs-2  col-md-1 vert-align-mid"><input class="col-xs-12 form-control mass-multiplier-dmg" type="text" name="Multiplier_dmg_{$info.ClassName}" id="Multiplier_dmg_{$info.ClassName}" value="{$info.Multiplier}" data-defval="{$dinodamres_dmg_defaults[$key].Multiplier}" data-toggle="tooltip" data-placement="right" title="Damage Multiplier for this creature ({$info.name}). Default: {$dinodamres_dmg_defaults[$key].Multiplier}"></td>
					<td class="col-xs-2  col-md-1 vert-align-mid"><input class="col-xs-12 form-control mass-multiplier-res" type="text" name="Multiplier_res_{$dinodamres_res_combined[$key].ClassName}" id="Multiplier_res_{$dinodamres_res_combined[$key].ClassName}" value="{$dinodamres_res_combined[$key].Multiplier}" data-defval="{$dinodamres_res_defaults[$key].Multiplier}" data-toggle="tooltip" data-placement="right" title="Resistance Multiplier for this creature ({$dinodamres_res_combined[$key].name}). Default: {$dinodamres_res_defaults[$key].Multiplier}"></td>
				</tr>
				{/foreach}
			</tbody>
		</table>
		<input type="submit" class="btn btn-xl btn-primary" value="Save Resource Config">
		</form>
		
	</div>
</div>


<script>

$(document).ready(function() {
	

	$('.mass-ctrl').each(function () {
		$(this).click( function () {
		
			var group	= $(this).attr('data-ctrl-group');
			var setval	= $(this).val();
			
			var askBeforeWeDoAnything = confirm('Warning. This will set the '+group+' to '+setval.replace("mass-", "")+' for all creatures. Would you like to proceed?');
			if (askBeforeWeDoAnything) {
			
				$('.'+group).each(function () {
					switch (group) {
						case 'mass-multiplier-dmg':
							$(this).val(setval);
							break;
						case 'mass-multiplier-res':
							$(this).val(setval);
							break;
					}
				});
			}
			
			$(this).blur();
		});
	});


});

function resetAllDefaults() {

	var askBeforeWeDoAnything = confirm('Warning. This will reset all Damage and Resistance multipliers to their default of 1. Would you like to proceed?');
	if (askBeforeWeDoAnything) {

		$('.mass-multiplier-dmg').each(function () {
			$(this).val( $(this).attr('data-defval') );
		});
		
		$('.mass-multiplier-res').each(function () {
			$(this).val( $(this).attr('data-defval') );
		});
	}
}

</script>

{include file="_foot.tpl"}