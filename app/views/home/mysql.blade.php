@extends('layouts.default')

@section('nav')
@stop

@section('content')
<h2>Plugins</h2>
<div class="row">
	<div class="col-md-12 panel-main">
		<table class="table table-striped">
			<?php MySQLObject::print_obj_header($plugins[0]); ?>
			@foreach($plugins as $plugin)
			<?php MySQLObject::print_obj($plugin); ?>
			@endforeach
		</table>
	</div>
	<div>


		<h2>Process lists</h2>
<div class="row">
	<div class="col-md-12 panel-main">
		<table class="table table-striped">
			<?php MySQLObject::print_obj_header($processlists[0]); ?>
			@foreach($processlists as $processlist)
			<?php MySQLObject::print_obj($processlist); ?>
			@endforeach
		</table>
	</div>
	<div>



				<h2>Engines</h2>
<div class="row">
	<div class="col-md-12 panel-main">
		<table class="table table-striped">
			<?php MySQLObject::print_obj_header($engines[0]); ?>
			@foreach($engines as $engine)
			<?php MySQLObject::print_obj($engine); ?>
			@endforeach
		</table>
	</div>
	<div>

						<h2>Show Open Tables</h2>
<div class="row">
	<div class="col-md-12 panel-main">
		<table class="table table-striped">
			<?php MySQLObject::print_obj_header($opentables[0]); ?>
			@foreach($opentables as $opentable)
			<?php MySQLObject::print_obj($opentable); ?>
			@endforeach
		</table>
	</div>
	<div>

						<h2>Show Variables</h2>
<div class="row">
	<div class="col-md-12 panel-main">
		<table class="table table-striped">
			<?php MySQLObject::print_obj_header($variables[0]); ?>
			@foreach($variables as $variable)
			<?php MySQLObject::print_obj($variable); ?>
			@endforeach
		</table>
	</div>
	<div>

				<h2>Status</h2>
<div class="row">
	<div class="col-md-12 panel-main">
		<table class="table table-striped">
			<?php MySQLObject::print_obj_header($logs[0]); ?>
			@foreach($logs as $log)
			<?php MySQLObject::print_obj($log); ?>
			@endforeach
		</table>
	</div>
	<div>

@stop

@section('scripts')
<script>
</script>
@stop
