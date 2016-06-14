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
            		<form role="form" action="/manageusers"method="post">
                <!-- text input -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
                	<th>Select</th>
				  <th>Name</th> 
				  <th>Phone</th>
                  <th>Email</th>
                    <th>Role</th>
                </tr>
                </thead>
                <tbody>
             @foreach($users as $user)
                 <tr><td><input type='radio' name='userid' value='{{$user->id}}' unchecked></td>
                 	<td>{{ $user->name}}</td>
                 <td>{{ $user->phone}}</td>
                 <td>{{ $user->email}}</td>
                 <td style="text-transform: capitalize;">{{ $user->role}}</td></tr>
             @endforeach
              </tbody>
                <tfoot>
                <tr>
             	<th>Select</th>
				  <th>Name</th> 
				  <th>Phone</th>
                  <th>Email</th>
                    <th>Role</th>
                </tr>
                </tfoot>
              </table>
              <br></br>
			<div class="form-group has-feedback">
				<label>New Role</label>
                  <select class="form-control" name="role" required>
					<option value='' selected disabled>Please Select a New Role for the User</option>
                    <option value="admin">Admin</option>
                    <option value="nonadmin">Non Admin</option>
                  </select>
                </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
     
              </form>
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