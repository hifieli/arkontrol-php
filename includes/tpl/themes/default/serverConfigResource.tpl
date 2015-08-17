{include file="_head.tpl"}

<h2>ARK Dedicated Server Configuration</h2>

{*
	resource_combined
	<pre>{$resource_combined|print_r}</pre>

	resource_alreadyini
	<pre>{$resource_alreadyini|print_r}</pre>

	resource_defaults
	<pre>{$resource_defaults|print_r}</pre>
*}

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Resource Harvest Configuration</h3>
	</div>
	<div class="panel-body">
	
		
		<form method="POST" action="/do/serverConfigResource.php" class="form">
		<input type="submit" class="btn btn-xl btn-primary" value="Save Resource Config">
		<input type="button" class="btn btn-xl btn-warning" value="Reset Defaults" onclick="resetAllDefaults();">
		<table class="table">
			<thead>
				<tr>
					<th><br></th>
					<th class="text-center">
						<span data-toggle="tooltip" data-placement="right" title="Minimum Level Required to learn this Resource.">Harvest Multiplier</span>
						<br><input type="button" class="btn btn-xs mass-ctrl" data-ctrl-group="mass-multiplier" value="1" data-toggle="tooltip" data-placement="right" title="Set harvest multiplier to 1 for all Resources."> <input type="button" class="btn btn-xs mass-ctrl" data-ctrl-group="mass-multiplier" value="99" data-toggle="tooltip" data-placement="right" title="Set harvest multiplier to 99 for all Resources.">
					</th>
				</tr>
			</thead>
			<tbody>
				{foreach $resource_combined as $key => $info}
				<tr>
					<td class="col-xs-2" id="{$info.name|replace:' ':'_'}">
						<table>
							<tr>
								<td>
									<img src="/img/resources/{$info.thumbnail}" alt="{$info.name}">
								</td>
								<td>
									<b><a href="http://ark.gamepedia.com/{urlencode($info.name|replace:' ':'_')}" target="_new">{$info.name}</a></b>
								</td>
							</tr>
						</table>
						</td>
					<td class="col-xs-2  col-md-1"><input class="col-xs-12 form-control mass-multiplier" type="text" name="Multiplier_{$info.ClassName}" id="Multiplier_{$info.ClassName}" value="{$info.Multiplier}" data-defval="{$resource_defaults[$key].Multiplier}" data-toggle="tooltip" data-placement="right" title="Harvest Multiplier for this Resource ({$info.name}). Default: {$resource_defaults[$key].Multiplier}"></td>
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
			
			var  askBeforeWeDoAnything = confirm('Warning. This will set the '+group+' to '+setval+' for all Resources. Would you like to proceed?');
			if (askBeforeWeDoAnything) {
			
				$('.'+group).each(function () {
					switch (group) {
						case 'mass-multiplier':
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

	var askBeforeWeDoAnything = confirm('Warning. This will reset all Resource multipliers to their default of 1. Would you like to proceed?');
	if (askBeforeWeDoAnything) {

		$('.mass-multiplier').each(function () {
			$(this).val( $(this).attr('data-defval') );
		});
	}
}

</script>

{include file="_foot.tpl"}