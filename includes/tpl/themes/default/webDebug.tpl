{include file="_head.tpl"}

<h2>Debug Info</h2>


<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">INI Configuration</h3>
	</div>
	<div class="panel-body">
		<pre>{$_INICONF|print_r}</pre>
	</div>
</div>


<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Current Session</h3>
	</div>
	<div class="panel-body">
		<pre>{$smarty.session|print_r}</pre>
	</div>
</div>


<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Execution Environment</h3>
	</div>
	<div class="panel-body">
		<pre>{$smarty.server|print_r}</pre>
	</div>
</div>


{include file="_foot.tpl"}