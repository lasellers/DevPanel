@extends('layouts.default')

@section('nav')
  <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Go to Database <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">

         @foreach($databases as $database)
         <li><a href="#{{$database}}">{{$database}}</a></li>
         @endforeach
          </ul>
        </li>
@stop


@section('content')
<div class="row">
	<div class="col-md-12 panel-main">


<!--
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Databases</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link</a></li>
    
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Databases <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">

         @foreach($databases as $database)
         <li><a href="#{{$database}}">{{$database}}</a></li>
         @endforeach
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
     
    </div>
  </div>
</nav>
-->

    @foreach($databases as $database)
<?php
$tables=$datas[$database];
if(count($tables)>0)
{
//print_r($tables);exit;
?>
     <table class="table table-striped table-hover table-responsive">
  <caption>{{$database}}</caption>
    <?php MySQLObject::print_obj_header($tables[0]); ?>
        
 @foreach($tables as $table)
  <?php
//print_r($table);//exit;
?>
    <?php MySQLObject::print_obj($table); ?>
        <!--
      <tr>
            <td>{{$database}}</td>
            <td>{{$table->Name}}</td>
            <td>{{$table->Engine}}</td>
            <td>{{$table->Version}}</td>
            <td>{{$table->Rows}}</td>
        </tr>
-->
 @endforeach
    </table>
<?php } ?>
    @endforeach

</div>

</div>
@stop

@section('scripts')
<script>
</script>
@stop
