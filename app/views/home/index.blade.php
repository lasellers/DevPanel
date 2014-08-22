<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="utf-8">
	<title>{{$meta_title}} - DevPanel</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="vi wport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="DevPanel">
	<meta name="author" content="">

	<link media="all" type="text/css" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link media="all" type="text/css" rel="stylesheet" href="/css/ui.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.22/angular.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.22/angular-route.js"></script>

	<script src="/js/devPanelCtrl.js?ver=08022014"></script>

	<link rel="shortcut icon" href="/ico/favicon.png">
</head>

<body ng-app="devpanel">

	<header ng-controller="Tabs">
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="/">DevPanel</a>
				</div>

				<ul class="nav navbar-nav navbar-right">
					<li ng-repeat="tab in tabs"><a href="#/@{{tab.id}}" ng-click="active='@{{tab.id}}'" class="@{{tab.id}}">@{{tab.title}}</a></li>
				</ul>
			</div>
		</nav>
		
	</header>

	<div class="container">
		<?php
/* Session::reflash();
*/ ?>
@if(Session::has('info'))
<div class="alert alert-info">{{ Session::get('info') }}</div>
@endif

@if(Session::has('success'))
<div class="alert alert-success">{{ Session::get('success') }}</div>
@endif

@if(Session::has('error'))
<div class="alert alert-error">{{ Session::get('error') }}</div>
@endif

@if(Session::has('message'))
<div class="alert">{{ Session::get('message') }}</div>
@endif

<main>
	<div ng-view></div>
</main>

<hr>

<div class="row" id="status-dialog" style="display:block">
	<!--img src="/images/spinner.gif"-->
</div>

<details>
	<summary>by Intrafoundation Software 2014.</summary>
	<p>DevPanel is open-sourced software licensed under the [MIT license] (<a href="http://opensource.org/licenses/MIT">http://opensource.org/licenses/MIT</a>)</p>
</details>

<nav id="footer" class="navbar navbar-default navbar-fixed-bottom" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#footer-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#"><small>by Intrafoundation Software 2014 v 0.0.6 alpha</small></a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="footer-collapse">
		<ul class="nav navbar-nav">
			<li class="pull-right"><a href="http://github.com/lasellers/DevPanel">Github</a></li>
		</ul>
	</div><!-- /.navbar-collapse -->
</nav>

<script>
/*
function supports_html5_storage() {
	try {
		return 'localStorage' in window && window['localStorage'] !== null;
	} catch (e) {
		return false;
	}
}

if(supports_html5_storage())
{
	var sites_available = localStorage.getItem("sites_available");
	console.log("sites_available="+sites_available);
// ...
localStorage.setItem("sites_available", "sites_available");
//
foo = localStorage.getItem("bar");
console.log("sites_available="+sites_available);
}
*/
</script>

</body>
</html>
