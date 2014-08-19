@extends('layouts.default')

@section('nav')
@stop

@section('content')
<h2>Plugins</h2>
<div class="row">
	<div class="col-md-12 panel-main">
		<table class="table table-striped">
			<?php $ob='plugins'; ?>
			<?php MySQLObject::print_obj_database($ob,count($plugins)-1); ?>
			<?php MySQLObject::print_obj_header($plugins[0],$ob); ?>
			<?php MySQLObject::print_obj($plugins,$ob); ?>
		</table>
	</div>
	<div>


		<h2>Process lists</h2>
		<div class="row">
			<div class="col-md-12 panel-main">
				<table class="table table-striped">
			<?php $ob='processlists'; ?>
					<?php MySQLObject::print_obj_database($ob,count($processlists)-1); ?>
					<?php MySQLObject::print_obj_header($processlists[0],$ob); ?>
					<?php MySQLObject::print_obj($processlists,$ob); ?>
				</table>
			</div>
			<div>



				<h2>Engines</h2>
				<div class="row">
					<div class="col-md-12 panel-main">
						<table class="table table-striped">
			<?php $ob='engines'; ?>
							<?php MySQLObject::print_obj_database($ob,count($engines)-1); ?>
							<?php MySQLObject::print_obj_header($engines[0],$ob); ?>
							<?php MySQLObject::print_obj($engines,$ob); ?>
						</table>
					</div>
					<div>

						<h2>Show Open Tables</h2>
						<div class="row">
							<div class="col-md-12 panel-main">
								<table class="table table-striped">
				<?php $ob='opentables'; ?>
								<?php MySQLObject::print_obj_database($ob,count($opentables)-1); ?>
									<?php MySQLObject::print_obj_header($opentables[0],$ob); ?>
									<?php MySQLObject::print_obj($opentables,$ob); ?>
								</table>
							</div>
							<div>

								<h2>Show Variables</h2>
								<div class="row">
									<div class="col-md-12 panel-main">
										<table class="table table-striped">
					<?php $ob='variables'; ?>
									<?php MySQLObject::print_obj_database($ob,count($variables)-1); ?>
											<?php MySQLObject::print_obj_header($variables[0],$ob); ?>
											<?php MySQLObject::print_obj($variables,$ob); ?>
										</table>
									</div>
									<div>

										<h2>Status</h2>
										<div class="row">
											<div class="col-md-12 panel-main">
												<table class="table table-striped">
						<?php $ob='logs'; ?>
										<?php MySQLObject::print_obj_database($ob,count($logs)-1); ?>
													<?php MySQLObject::print_obj_header($logs[0],$ob); ?>
													<?php MySQLObject::print_obj($logs,$ob); ?>
												</table>
											</div>
											<div>
<!--
	//$pdo = DB::connection()->getPdo();
	// $PDO->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
show events;
 SELECT CURRENT_USER(), SCHEMA();

SHOW VARIABLES LIKE 'max_join_size';
SHOW SESSION VARIABLES LIKE 'max_join_size';
To get a list of variables whose name match a pattern, use the “%” wildcard character in a LIKE clause:
 SELECT VERSION()\G
SHOW VARIABLES LIKE '%size%';
SHOW GLOBAL VARIABLES LIKE '%size%';-->
@stop

@section('scripts')
<script>

 $(document).ready(function(){
  console.log("ready");
   // add_open_close();

   $(document).on("click", ".hide-database", function(e) {
    console.log("hide database");
    e.preventDefault();
     $(".database-header").hide();
     $(".database-body").hide();
   //$("#database-"+id+"-header").hide();
   //$("#database-"+id+"-body").hide();
 });

   $(".show-database").click(function(e){
    console.log("show database");
    e.preventDefault();
    var id=$(this).data("id");
    console.log("id="+id);
    $("#database-"+id+"-header").show();
    $("#database-"+id+"-body").show();
  });

 });
</script>
@stop
