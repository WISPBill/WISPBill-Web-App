@extends('layouts.app')
@section('page-header')
	 <link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('htmlheader_title')
	View User's
@endsection

@section('contentheader_title')
	View User's
@endsection

@section('main-content')
	<!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
            <h4>We have {{$total}} Users's</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
				  <th>Name</th> 
				  <th>Phone</th>
                  <th>Email</th>
                    <th>Role</th>
                </tr>
                </thead>
                <tbody>
             @foreach($users as $user)
                 <tr><td>{{ $user->name}}</td>
                 <td>{{ $user->phone}}</td>
                 <td>{{ $user->email}}</td>
                 <td style="text-transform: capitalize;">{{ $user->role}}</td></tr>
             @endforeach
              </tbody>
                <tfoot>
                <tr>
              <th>Name</th> 
				  <th>Phone</th>
                  <th>Email</th>
                    <th>Role</th>
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