@extends('layouts.default')

@section('nav')

@stop

@section('content')
<!--
<div ng-app="">
	<p>Name: <input type="text" ng-model="name"></p>
	<p ng-bind="name"></p>
</div>
-->

<main>
	<div class="jumbotron">
		<h1>DevPanel</h1>
		<p>Development Server Panel (DevPanel) is a <em>PHP/Laravel</em> project meant to be placed in the default folder (/var/www) of your LAMP style dev server.</p>
		<!--p><a class="btn btn-primary btn-lg" role="button">Learn more</a></p-->
	</div>

	<details>
		<summary>by Intrafoundation Software 2014.</summary>
		<p>DevPanel is open-sourced software licensed under the [MIT license] (<a href="http://opensource.org/licenses/MIT">http://opensource.org/licenses/MIT</a>)</p>
	</details>

	<article>
		<!--
		<?php
		$ip = gethostbyname('localhost');
		echo $ip;
		?>
	-->
	</article>

</main>
@stop

@section('scripts')
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

<script>
var sites_available;
$(document).ready(function(){
	console.log("Loading apis...");
	$.ajax({
		type: "GET",
		url: "/api/get_sites_available"
	}).done(function( msg ) {

		$("#status_dialog").html("<p>"+msg+"</p><p>get_sites_available</p>");
		sites_available=msg;
		console.log("Loaded get_sites_available..."+msg.data);
		console.log(msg.data);
	//	for each(var data in msg.data)
		{
			//console.log("data="+data);
		}
	});
});
</script>

<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js"></script>
@stop
