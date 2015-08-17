{include file="_head.tpl"}

<h2>Browse Steam Logs</h2>

<br /><br />


<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Available Logs</h3>
	</div>
	<div class="panel-body">
		{if !empty($logfiles)}
			<table class="table">
			{foreach $logfiles as $thislog}
				{if ($thislog != '.') && ($thislog != '..')}
				<tr><td><a href="/do/steamLogView.php?logfile={$thislog}">{$thislog}</a></td></tr>
				{/if}
			{/foreach}
			</table>
		{else}
			<p>No logs available.</p>
		{/if}
	</div>
</div>



{include file="_foot.tpl"}