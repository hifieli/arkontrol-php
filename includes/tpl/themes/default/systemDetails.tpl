{include file="_head.tpl"}


	<h2>System Details</h2>
	<h3>{$_INICONF['hostname']}</h3>

	<br><br>
	
	<p>Well sure, expect this to improve a bit in the future.</p>
	
	
	<br><br>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Running Processes</h3>
		</div>
		<div class="panel-body">
		
			<textarea rows="15" style="width: 100%; font-family: Courier New, Courier, terminal, system;">{$top}</textarea>

		</div>
	</div>
			
	<br><br>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Memory (RAM)</h3>
		</div>
		<div class="panel-body">
			<textarea rows="6" style="width: 100%; font-family: Courier New, Courier, terminal, system;">{$freem}</textarea>	
		</div>
	</div>

	<br><br>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">ARK Disk Usage</h3>
		</div>
		<div class="panel-body">
			
			<textarea rows="15" style="width: 100%; font-family: Courier New, Courier, terminal, system;">{$du}</textarea>

		</div>
	</div>
	
	<br><br>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Disk Space Total</h3>
		</div>
		<div class="panel-body">
			
			<textarea rows="6" style="width: 100%; font-family: Courier New, Courier, terminal, system;">{$df}</textarea>

		</div>
	</div>

	<br><br>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">CPU Info</h3>
		</div>
		<div class="panel-body">
			
			<textarea rows="6" style="width: 100%; font-family: Courier New, Courier, terminal, system;">{$cpu}</textarea>

		</div>
	</div>	
	
	<br><br>
{include file="_foot.tpl"}