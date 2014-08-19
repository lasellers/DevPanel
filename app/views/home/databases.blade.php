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

@foreach($databases as $database)
<?php
$tables=$datas[$database];
if(count($tables)>0)
{
  MySQLObject::print_obj_all($database,$tables);
} ?>
@endforeach

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
/*
 function add_open_close()
 {
  $('<div class="pull-right"><a href="" class="open-database">Open</a> <span class="glyphicon glyphicon-edit"></span></a></div>').prependTo('.database');
  //  $('<p><img src="/images/spinner.gif"></p>').appendTo('#status_dialog');

  $('<div class="pull-right"><a href="" class="close-database">Close</a></div>').prependTo(".database");
}
*/
/*
function add_open_content()
{
  $('<div class="pull-right"><a href="?" class="close_status_dialog">Close</a> <span class="glyphicon glyphicon-edit"></span></a></div>').prependTo('#status_dialog');
  $('<p><img src="/images/spinner.gif"></p>').appendTo('#status_dialog');
}

function add_close_content()
{
  $('<div class="pull-right"><a href="?" class="close_database">Close</a> <a href="" class="close_database"><span class="glyphicon glyphicon-edit"></span></a></div>').prependTo("#status_dialog");
}
*/
</script>
@stop
