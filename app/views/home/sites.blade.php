@extends('layouts.default')

@section('nav')
<li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Go to Site <span class="caret"></span></a>
	<ul class="dropdown-menu" role="menu">
		@foreach($sites as $name=>$site)
		<li><a href="http://{{$site}}">{{$site}} -- {{$name}}</a></li>
		@endforeach
	</ul>
</li>
@stop

@section('content')
<p>Primary Address <i>{{$ip}}</i></p>

<h2>Apache2 Sites Available</h2>
<div class="row">
	<div class="col-md-12 panel-main">

		<table class="table table-striped table-hover table-responsive">
			<tr>
				<th>filename</th>
				<th>Size</th>
				<th>ServerAdmin</th>
				<th>ServerName</th>
				<th>IP</th>
				<th>DocumentRoot</th>
				<th>Engine</th>
			<!--<th>ErrorLog</th>
			<th>CustomLog</th>-->
		</tr>
		@foreach($sites_available as $data)
		<tr>
			<td>{{$data->filename}}</td>
			<td>{{$data->Size}}</td>
			<td>{{$data->ServerAdmin}}</td>
			<td>{{$data->ServerName}}</td>
			<td><a href="http://{{$data->IP}}">{{$data->IP}}</a></td>
			<td>{{$data->DocumentRoot}}</td>
			<td>{{$data->Engine}}</td>
		<!--<td>{{$data->ErrorLog}}</td>
		<td>{{$data->CustomLog}}</td>-->
	</tr>
	@endforeach
</table>

</div>
<div>



<h2>Addresses</h2>
<div class="row">
	<div class="col-md-12 panel-main">

	@foreach($autos as $auto)
		<div class="col-md-1">{{$auto}}</div>
		@endforeach
</div>
<div>

	<h2>Apache2 Sites Enabled</h2>
	<div class="row">
		<div class="col-md-12 panel-main">

			<table class="table table-striped table-condensed">
				<tr>
					<th>filename</th>
					<th>Size</th>
					<th>ServerAdmin</th>
					<th>ServerName</th>
					<th>IP</th>
					<th>DocumentRoot</th>
					<th>Engine</th>
		<!--	<th>ErrorLog</th>
		<th>CustomLog</th>-->
	</tr>
	@foreach($sites_enabled as $data)
	<tr>
		<td>{{$data->filename}}</td>
		<td>{{$data->Size}}</td>
		<td>{{$data->ServerAdmin}}</td>
		<td>{{$data->ServerName}}</td>
		<td><a href="http://{{$data->IP}}">{{$data->IP}}</a></td>
		<td>{{$data->DocumentRoot}}</td>
		<td>{{$data->Engine}}</td>
		<!--	<td>{{$data->ErrorLog}}</td>
		<td>{{$data->CustomLog}}</td>-->
	</tr>
	@endforeach
</table>

</div>
</div>

<h2>Site Folders</h2>
<div class="row">
	<div class="col-md-12 panel-main">

		<table class="table table-striped table-condensed">
			<tr>
				<th>file</th>
				<th>size</th>
			</tr>
			@foreach($folders as $data)
			<tr>
				<td><a href="http://{$ip}/{{$data->filename}}/">{{$data->filename}}</a></td>
				<td>{{$data->size}}</td>
			</tr>
			@endforeach
		</table>

	</div>
</div>
@stop

@section('scripts')
<script>
</script>
@stop
