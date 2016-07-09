@extends('layouts.app')
@section('page-header')
	 <link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('htmlheader_title')
	Set SSH Credentials
@endsection

@section('contentheader_title')
	Set SSH Credentials
@endsection

@section('main-content')
	<!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
            <h4>We have {{$total}} SSH Enabled Devices Without Credentials</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			        @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	  @endif
			<form role="form" action="/addsshcredentials"method="post">
                <!-- text input -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
				<th>Select</th>
				  <th>IP</th> 
				  <th>Network</th>
                  <th>IP Discovered</th>
                </tr>
                </thead>
                <tbody>
             @foreach($servers as $server)
                 <tr><td><input type='radio' name='id' value='{{$server->id}}' unchecked></td>
				 <td>{{ $server->IP->address}}</td>
                 <td>{{ $server->IP->network->ip}}/{{$server->IP->network->CIDR}}</td>
                 <td>{{date_format($server->IP->created_at,'g:i A n/j/y')}}</td>
             @endforeach
              </tbody>
                <tfoot>
                <tr>
				<th>Select</th>
				  <th>IP</th> 
				  <th>Network</th>
                  <th>IP Discovered</th>
                </tr>
                </tfoot>
              </table>
				<br></br>
				
					<div class="form-group has-feedback">
						<label>Username</label>
                    <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('name') }}"/>
                    
                </div>
                
<div class="form-group has-feedback">
	<label>Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="password"/>
                    
                </div>
                <div class="form-group has-feedback">
                		<label>Confirm Password</label>
                    <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation"/>
                    
                </div>

				<div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
     
              </form>
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