@extends('layouts.app')
@section('page-header')
	 <link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('htmlheader_title')
	View Lead's
@endsection

@section('contentheader_title')
	View Lead's
@endsection

@section('main-content')
	<!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
            <h4>We have {{$total}} Device's</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
				  <th>Name</th> 
				  <th>Type</th>
                  <th>Manufacturer</th>
                    <th>Model</th>
                        <th>Software</th>
				  <th>Mac Address</th> 
				 <th>Serial Number</th>
                 <th>More Info</th>
                 <th>Added to Inventory</th>
                </tr>
                </thead>
                <tbody>
             @foreach($devices as $device)
                 <tr><td>{{ $device->name or 'Not Set' }}</td>
                 <td>{{ $device->type}}</td>
                 <td>{{ $device->manufacturer}}</td>
                 <td>{{ $device->model}} {{ $device->revision or '' }}</td>
                 <td>{{ $device->os}} {{$device->version}}</td>
                 <td>{{ $device->mac}}</td>
                 <td>{{ $device->serial_number or 'NA' }}</td>
                 <td> <a href="/viewdevices/{{$device->id}}"><button type='button' class='btn btn-block btn-success btn-sm'>View Device</button></a></td>
                 <td>{{ date_format($device->created_at, 'n/j/y g:i A')}}</td></tr>
             @endforeach
              </tbody>
                <tfoot>
                <tr>
                 <th>Name</th> 
				  <th>Type</th>
                  <th>Manufacturer</th>
                    <th>Model</th>
                        <th>Software</th>
				  <th>Mac Address</th> 
				 <th>Serial Number</th>
                 <th>More Info</th>
                 <th>Added to Inventory</th>
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