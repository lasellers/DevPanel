@extends('layouts.default')

@section('content')
<div class="row">
	<div class="col-md-12 panel-main">

        <table class="table table-striped">
          @foreach($datas as $dbname=>$tables)

          @foreach($tables as $table)
          <tr>
            <td>{{$dbname}}</td>
            <td>{{$table->Name}}</td>
            <td>{{$table->Engine}}</td>
            <td>{{$table->Version}}</td>
            <td>{{$table->Rows}}</td>
        </tr>
        @endforeach

        @endforeach
    </table>

</div>

</div>
@stop

@section('scripts')
<script>
</script>
@stop
