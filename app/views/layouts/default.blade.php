<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>{{$meta_title}} - Intrafoundation Software</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="vi wport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="{{$meta_title}}">
  <meta name="author" content="">

  <!-- the styles -->
  {{ HTML::style('/bootstrap/css/bootstrap.css') }}
  {{ HTML::style('/css/ui.css?ver=12032014') }}
  
  <link rel="shortcut icon" href="/ico/favicon.png">
</head>

<body>
  <div class="navbar navbar-default navbar-fixed-top" role="navigation">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mast-collapse">
       <span class="sr-only">Toggle navigation</span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
     </button>
     <a class="navbar-brand" href="/">DevPanel</a>
   </div>

   <div class="collapse navbar-collapse" id="mast-collapse">
    <ul class="nav navbar-nav">
      <li class="active"><a href="/">Home</a></li>
      <li><a href="/databases">Databases</a></li>
      <li><a href="http://github.com/lasellers">Github</a></li>
    </ul>

  </div>

</div>

<div id="blank_nav">
</div>

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

@yield('content')

<hr>

<div class="row" id="status-dialog">
  <img src="/images/spinner.gif">
</div>

<nav id="footer" class="navbar navbar-default navbar-fixed-bottom" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#footer-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#"><small>by Intrafoundation Software 2014</small></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="footer-collapse">
    <ul class="nav navbar-nav">

    </ul>
  </div><!-- /.navbar-collapse -->
</nav>


<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/js/ui.js?ver=12032013"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script src="http://google-maps-utility-library-v3.googlecode.com/svn/tags/markerwithlabel/1.1.3/src/markerwithlabel.js"></script>

<!--script src="/jquery/ui/js/jquery-1.9.1.js"></script-->
<!--script src="/jquery/ui/js/jquery-ui-1.10.3.min.js"></script-->
<!--script src="/jquery/jquery.cookie.js?ver=20140509"></script-->
<!--script src="/bootstrap/js/bootstrap.min.js"></script-->
@yield('scripts')
</body>
</html>
