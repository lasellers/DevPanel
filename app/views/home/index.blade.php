@extends('layouts.default')

@section('content')
<div class="row">
	<div class="col-md-12 panel-main">

		<table class="table table-striped">
			<tr>
				<th>file</th>
				<th>Size</th>
				<th>ServerAdmin</th>
				<th>ServerName</th>
				<th>IP</th>
				<th>DocumentRoot</th>
				<th>Engine</th>
			<!--<th>ErrorLog</th>
			<th>CustomLog</th>-->
		</tr>
		@foreach($sites_available as $file=>$data)
		<tr>
			<td>{{$file}}</td>
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

	<div class="row">
		<div class="col-md-12 panel-main">

			<table class="table table-striped">
				<tr>
					<th>file</th>
					<th>Size</th>
					<th>ServerAdmin</th>
					<th>ServerName</th>
					<th>IP</th>
					<th>DocumentRoot</th>
					<th>Engine</th>
		<!--	<th>ErrorLog</th>
		<th>CustomLog</th>-->
	</tr>
	@foreach($sites_enabled as $file=>$data)
	<tr>
		<td>{{$file}}</td>
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

@stop

@section('scripts')
<script>
</script>
@stop
