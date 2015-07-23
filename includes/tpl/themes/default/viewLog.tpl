{include file="_head.tpl"}

<h2>View Log - {$log_name}</h2>

<br>

<p><a href="/do/browseLogs.php" class="btn btn-xl btn-primary">Back to list</a> <a href="javascript: history.go(0);" class="btn btn-xl btn-info">Refresh</a></p>

<br><br>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">'{$log_name}' as of [{$smarty.session['last_act']|date_format:"%Y-%m-%d %H:%M:%S"}]</h3>
	</div>
	<div class="panel-body">
	
		<p>Showing last 300 lines, most recent at bottom:</p>
		<textarea id="log_display" style="width: 100%; height: 100%">{$logs}</textarea>

	</div>
</div>


<script>

$(document).ready(function() {
	$("#log_display").scrollTop(999999999);
});

</script>

{include file="_foot.tpl"}