{include file="_head.tpl"}

<h2>ARK Dedicated Server Configuration</h2>

{*
	engram_combined
	<pre>{$engram_combined|print_r}</pre>

	engram_alreadyini
	<pre>{$engram_alreadyini|print_r}</pre>

	engram_defaults
	<pre>{$engram_defaults|print_r}</pre>
*}

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Engram Configuration</h3>
	</div>
	<div class="panel-body">
		{*
		<form method="POST" action="/do/serverConfigEngrams.php" class="form">
			<input type="hidden" name="reset_emgrams" value="1">
			<input type="submit" class="btn btn-xl btn-warning" value="Reset Defaults">
		</form>
		*}
		
		
		<form method="POST" action="/do/serverConfigEngrams.php" class="form">
		<input type="submit" class="btn btn-xl btn-primary" value="Save Engram Config">
		<input type="button" class="btn btn-xl btn-warning" value="Reset Defaults" onclick="resetAllDefaults();">
		<table class="table">
			<thead>
				<tr>
					<th><br></th>
					<th class="text-center"><span data-toggle="tooltip" data-placement="right" title="Minimum Level Required to learn this Engram.">Min Level</span><br><input type="button" class="btn btn-xs mass-ctrl" data-ctrl-group="mass-level" value="1" data-toggle="tooltip" data-placement="right" title="Set level requirement to 1 for all Engrams."> <input type="button" class="btn btn-xs mass-ctrl" data-ctrl-group="mass-level" value="65" data-toggle="tooltip" data-placement="right" title="Set level requirement to 65 for all Engrams."></th>
					<th class="text-center"><span data-toggle="tooltip" data-placement="right" title="EngramPoint Cost for to learn this Engram.">EP Cost</span><br><input type="button" class="btn btn-xs mass-ctrl" data-ctrl-group="mass-cost" value="1" data-toggle="tooltip" data-placement="right" title="Set EP Cost to 1 for all Engrams."> <input type="button" class="btn btn-xs mass-ctrl" data-ctrl-group="mass-cost" value="10" data-toggle="tooltip" data-placement="right" title="Set EP Cost to 10 for all Engrams."> <input type="button" class="btn btn-xs mass-ctrl" data-ctrl-group="mass-cost" value="99" data-toggle="tooltip" data-placement="right" title="Set EP Cost to 99 for all Engrams."></th>
					<th class="text-center"><span data-toggle="tooltip" data-placement="right" title="Hide this Engram in players' Engram panels">Hidden?</span><br><input type="button" class="btn btn-xs mass-ctrl" data-ctrl-group="mass-hide" value=" Y " data-toggle="tooltip" data-placement="right" title="Set all Engrams as Hidden."> <input type="button" class="btn btn-xs mass-ctrl" data-ctrl-group="mass-hide" value=" N " data-toggle="tooltip" data-placement="right" title="Set all Engrams as Not Hidden."></th>
					<th class="text-left"><span data-toggle="tooltip" data-placement="right" title="If checked, the required spells must be learned prior to learning this Engram.">Enable Prerequisites?</span><br><input type="button" class="btn btn-xs mass-ctrl" data-ctrl-group="mass-prereq" value=" Y " data-toggle="tooltip" data-placement="right" title="Remove PreRequisites for all Engrams"> <input type="button" class="btn btn-xs mass-ctrl" data-ctrl-group="mass-prereq" value=" N "  data-toggle="tooltip" data-placement="right" title="Require PreRequisites for all Engrams."></th>
				</tr>
			</thead>
			<tbody>
				{foreach $engram_combined as $key => $info}
				<tr>
					<td class="col-xs-2" id="{$info.name|replace:' ':'_'}">
						<table>
							<tr>
								<td>
									<img src="/img/engrams/{$info.thumbnail}" alt="{$info.name}">
								</td>
								<td>
									<b><a href="http://ark.gamepedia.com/{urlencode($info.name|replace:' ':'_')}" target="_new">{$info.name}</a></b>
								</td>
							</tr>
						</table>
						</td>
					<td class="col-xs-2  col-md-1"><input class="col-xs-12 form-control mass-level" type="text" name="EngramLevelRequirement_{$info.EngramClassName}" id="EngramLevelRequirement_{$info.EngramClassName}" value="{$info.EngramLevelRequirement}" data-defval="{$engram_defaults[$key].EngramLevelRequirement}" data-toggle="tooltip" data-placement="right" title="Minimum player level required to learn this Engram ({$info.name}). Default: {$engram_defaults[$key].EngramLevelRequirement}"></td>
					<td class="col-xs-2  col-md-1"><input class="col-xs-12 form-control mass-cost" type="text" name="EngramPointsCost_{$info.EngramClassName}" id="EngramPointsCost_{$info.EngramClassName}" value="{$info.EngramPointsCost}" data-defval="{$engram_defaults[$key].EngramPointsCost}" data-toggle="tooltip" data-placement="right" title="EP (Engram Point) Cost to learn this Engram ({$info.name}). Default: {$engram_defaults[$key].EngramPointsCost}"></td>
					<td class="col-xs-2  col-md-1"><input class="col-xs-12 mass-hide" type="checkbox" name="EngramHidden_{$info.EngramClassName}" id="EngramHidden_{$info.EngramClassName}" {if (!empty($info.EngramHidden) && $info.EngramHidden == 'true')}checked{/if} data-defval="false" data-toggle="tooltip" data-placement="right" title="Hide this Engram ({$info.name}) in players' Engram Panels."></td>
					<td class="col-xs-4">
						<input class="mass-prereq" type="checkbox" name="RemoveEngramPreReq_{$info.EngramClassName}" id="RemoveEngramPreReq_{$info.EngramClassName}" {if (!empty($info.RemoveEngramPreReq) && $info.RemoveEngramPreReq == 'false')}checked{/if} {if empty($info.prereq1)}disabled="disabled"{/if} data-defval="true" data-toggle="tooltip" data-placement="right" title="Enable PreRequisites for this Engram ({$info.name})">
						<span  data-toggle="tooltip" data-placement="right" title="These Engrams ({if !empty($info.prereq1)}{$info.prereq1}{if !empty($info.prereq2)}, {$info.prereq2}{/if}{/if}) are required in order to learn this one ({$info.name}).">
						{if !empty($info.prereq1)}<a href="#{$info.prereq1|replace:' ':'_'}">{$info.prereq1}</a>{if !empty($info.prereq2)}, <a href="#{$info.prereq2|replace:' ':'_'}">{$info.prereq2}</a>{/if}{/if}
						</span>
					</td>
				</tr>
				{/foreach}
			</tbody>
		</table>
		<input type="submit" class="btn btn-xl btn-primary" value="Save Engram Config">
		</form>
		
	</div>
</div>


<script>

$(document).ready(function() {
	

	$('.mass-ctrl').each(function () {
		$(this).click( function () {
		
			var group	= $(this).attr('data-ctrl-group');
			var setval	= $(this).val();
			
			var  askBeforeWeDoAnything = confirm('Warning. This will set the '+group+' to '+setval+' for all Engrams. Would you like to proceed?');
			if (askBeforeWeDoAnything) {
			
				$('.'+group).each(function () {
					switch (group) {
						case 'mass-level':
						case 'mass-cost':
							$(this).val(setval);
							break;
						case 'mass-hide':
							if (setval == ' Y ') {
								$(this).prop('checked', true);
							} else {
								$(this).prop('checked', false);
							}
							break;
						case 'mass-prereq':
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

	var askBeforeWeDoAnything = confirm('Warning. This will reset all Engram options to their defaults. Would you like to proceed?');
	if (askBeforeWeDoAnything) {

		$('.mass-level').each(function () {
			$(this).val( $(this).attr('data-defval') );
		});
		$('.mass-cost').each(function () {
			$(this).val( $(this).attr('data-defval') );
		});

		$('.mass-hide').each(function () {
			$(this).prop('checked', false );
		});	
		$('.mass-prereq').each(function () {
			$(this).prop('checked', true );
		});
	}
}

</script>

{include file="_foot.tpl"}