@extends('layouts.app')
@section('page-header')
	 <link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}">
	 
	   <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
   <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>

  <style>
    #map{ min-width: inherit; min-height: 550px; }
  </style>
@endsection
@section('htmlheader_title')
	View PPPOE Credentials
@endsection

@section('contentheader_title')
	View PPPOE Credentials
@endsection

@section('main-content')
	<!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">

            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <!-- text input -->
               
            <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>

				  <th>Username</th> 
				  <th>Password</th>
                  <th>Plan</th>
                </tr>
                </thead>
                <tbody>
             @foreach($results as $result)
                 <tr>
				 <td>{{ $result['username']}}</td>
                 <td>{{ $result['password']}}</td>
                 <td>{{ $result['name']}}</td></tr>
             @endforeach
              </tbody>
                <tfoot>
                <tr>
				  <th>Username</th> 
				  <th>Password</th>
                  <th>Plan</th>
                </tr>
                </tfoot>
              </table>

            <!-- /.box-body -->
          </div>
               </div>
@endsection
@section('page-scripts')
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