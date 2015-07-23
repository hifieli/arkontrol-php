{include file="_head.tpl"}

<div class="row">
	<div class="col-xs-12">
		<h1>{$smarty.server['SERVER_NAME']}</h1>
		<h4>ARK: Survival Evolved dedicated server - <a href="steam://rungameid/{$_INICONF['steamappid']}?+connect={$smarty.server['SERVER_ADDR']}:20715">{$smarty.server['SERVER_ADDR']}:20715</a></h4>
		<p><br /></p>
		<p><br /></p>
		<p>Powered by <a href="http://arkontrol.com">ARKontrol</a></p>
	</div>
</div>

{include file="_foot.tpl"}