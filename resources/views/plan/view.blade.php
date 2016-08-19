@extends('layouts.app')
@section('page-header')
	 <link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('htmlheader_title')
	View Plan's
@endsection

@section('contentheader_title')
	View Plan's
@endsection

@section('main-content')
	<!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
            <h4>We have {{$total}} Plan's</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
				  <th>Name</th> 
				  <th>Price</th>
                  <th>Upload Speed</th>
                    <th>Download Speed</th>
                        <th>Upload Data Cap</th>
				  <th>Download Data Cap</th> 
                </tr>
                </thead>
                <tbody>
             @foreach($plans as $plan)
                 <tr><td>{{ $plan->name}}</td>
                 <td>{{ $plan->price}}</td>
             	<td>{{$planattributevalues[$plan->id]['uprate']}}</td>
             	<td>{{$planattributevalues[$plan->id]['downrate']}}</td>
             	<td>{{$planattributevalues[$plan->id]['upcap']}}</td>
             	<td>{{$planattributevalues[$plan->id]['downcap']}}</td>
               </tr>
               
             @endforeach
              </tbody>
                <tfoot>
               <tr>
				  <th>Name</th> 
				  <th>Price</th>
                  <th>Upload Speed</th>
                    <th>Download Speed</th>
                        <th>Upload Data Cap</th>
				  <th>Download Data Cap</th> 
                </tr>
                </tfoot>
              </table>
			
            <!-- /.box-body -->
          </div>
               </div>
@endsection
@section('page-scripts')
    {{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}
<script src="{{ asset ('/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset ('/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

<script>
  $(function () {
    $('#table').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
</script>

@endsection 