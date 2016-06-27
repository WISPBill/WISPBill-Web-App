@extends('layouts.app')
@section('page-header')
	 <link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('htmlheader_title')
	View Site Mailing List
@endsection

@section('contentheader_title')
	View Site Mailing List
@endsection

@section('main-content')
	<!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
            <h4>View Site Mailing List</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

             <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
             
				  <th>Unit</th> 
                    <th>House Number</th>
				  <th>Street</th> 
				 <th>City</th>
				 <th>Zip</th>
                </tr>
                </thead>
                <tbody>
            @foreach($data as $row)
            <tr>
                 	<td>{{ $row[4]}}</td>
                 <td>{{ $row[2]}}</td>
                 <td>{{ $row[3]}}</td>
                 <td>{{ $row[5]}}</td>
                   <td>{{ $row[8]}}</td>
                   </tr>
             @endforeach
              </tbody>
                <tfoot>
                <tr>
	  <th>Unit</th> 
                    <th>House Number</th>
				  <th>Street</th> 
				 <th>City</th>
				 <th>Zip</th>>
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