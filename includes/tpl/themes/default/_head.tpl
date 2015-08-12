<html>
	<head>
		<title>ARKontrol - A dedicated server manager for ARK: Survival Evolved</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="/css/scheme.{$_INICONF['webscheme']}.css">
		<link rel="stylesheet" href="/includes/tpl/themes/{$_INICONF['webtheme']}/theme.css">
		
		<script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<!-- <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script> -->
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/main.js"></script>
	
		
	</head>
	
	<body>
	
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					{if empty($valid_login)}
					<a class="navbar-brand" href="/">Home</a>
					{else}
					<a class="navbar-brand" href="/do/dashboard.php">Home</a>
					{/if}
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
					
						<li class=""><a class="" href="http://arkontrol.com">ARKontrol.com</a></li>
						
						{if !empty($valid_login)}
							<li><a class="" href="/do/dashboard.php">Dashboard</a></li>
						{/if}
						
						<li><a href="http://steamcommunity.com/groups/arkontrol/">Help</a></li>
					
					{*	<li><a href="/do/help.php">Help</a></li>
						<li><a href="/do/premium.php">Premium</a></li> *}
						<li><a href="/do/about.php">About</a></li>
						
						{if empty($valid_login)}
						<li class=""><a class="" href="/do/dashboard.php">Admin</a></li>
						{else}
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Admin <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								
								<li class="dropdown-header">ARKserver</li>
								<li><a href="/do/serverDetails.php">Details</a></li>
								<li><a href="/do/serverConfig.php">Configuration</a></li>
								<li><a href="/do/serverAdmins.php">Admin List</a></li>
								<li><a href="/do/rCon.php">Server rCon</a></li>
								<li><a href="/do/browseLogs.php">Server Logs</a></li>

								
								<li class="dropdown-header">ARKontrol</li>
								<li><a href="/do/webConfig.php">Configuration</a></li>
								<li><a href="/do/webAuth.php">Change Password</a></li>
								<li><a href="/do/panelUpgrade.php">Update</a></li>
							</ul>
						</li>
						<li><a href="/do/systemDetails.php">System</a></li>
						<li class=""><a class="" href="/logout.php">Logout</a></li>						
						{/if}
						
						<li>

						</li>
						<li style="padding-left:1em;">

						</li>
					</ul>
				</div>
			</div>
		</nav>

		<!-- Begin page content -->
		<div class="container">
		
		{* handle $_MSGS *}
		
		{if !empty($_MSGS)}
			{foreach $_MSGS as $thismsg}
				{if $thismsg.type == 'error'}
					<div class="alert alert-danger" role="alert">
				{elseif $thismsg.type == 'warning'}
					<div class="alert alert-warning" role="alert">
				{elseif $thismsg.type == 'info'}
					<div class="alert alert-info" role="alert">
				{elseif $thismsg.type == 'success'}
					<div class="alert alert-success" role="alert">
				{/if}
				
						<button type="button" class="close"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
						<p>{$thismsg.msg}</p>
					</div>
					
			{/foreach}
		{/if}
		
		{if !empty($smarty.session['need_to_restart'])}
			<div class="alert alert-warning" role="alert">
				<button type="button" class="close"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
				
					<form method="post" action="/do/serverDetails.php">
						<input type="hidden" name="action" value="restart">
						<p>To apply recent changes to your ARK server configuration you must <input type="submit" class="btn btn-primary " value="Restart Server""></p>
					</form>
				
			</div>
		{/if}
