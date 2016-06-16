@extends('layouts.app')
@section('page-header')
	 <link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}">

@endsection
@section('htmlheader_title')
	Add an Account to a Lead
@endsection

@section('contentheader_title')
	Add an Account to a Lead
@endsection

@section('main-content')
	<!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
            <h4>We have {{$total}} Lead's without an Account</h4>
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
			<form role="form" action="/addleadaccount"method="post">
                <!-- text input -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
				<th>Select</th>
				  <th>Name</th> 
				  <th>Phone</th>
                  <th>Email</th>
                    <th>Type</th>
				  <th>Address</th> 
				 <th>City</th>
                 <th>Zip</th>
                </tr>
                </thead>
                <tbody>
             @foreach($leads as $lead)
                 <tr><td><input type='radio' name='id' value='{{$lead->id}}' unchecked></td>
				 <td>{{ $lead->name}}</td>
                 <td>{{ $lead->tel}}</td>
                 <td>{{ $lead->email}}</td>
                 <td style="text-transform: capitalize;">{{ $lead->type}}</td>
                 <td>{{ $lead->add}}</td>
                 <td>{{ $lead->city}}</td>
                 <td>{{ $lead->zip}}</td></tr>
             @endforeach
              </tbody>
                <tfoot>
                <tr>
				<th>Select</th>
                  <th>Name</th> 
				  <th>Phone</th>
                  <th>Type</th>
				  <th>Address</th> 
				 <th>City</th>
                 <th>Zip</th>
                </tr>
                </tfoot>
              </table>
				<br></br>
				
				<div class="form-group has-feedback">
						<label>Name</label>
                    <input type="text" class="form-control" placeholder="Full name" name="name" value="{{ old('name') }}"/>
                    
                </div>
                
<div class="form-group has-feedback">
	<label>Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="password"/>
                    
                </div>
                <div class="form-group has-feedback">
                		<label>Confirm Password</label>
                    <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation"/>
                    
                </div>
                  @if ($pin == true)
                  <input type="hidden" value="true"/>
          <div class="form-group has-feedback">
	<label>Pin</label>
                    <input type="password" class="form-control" placeholder="Pin" name="pin"/>
                    
                </div>
                <div class="form-group has-feedback">
                		<label>Confirm Pin</label>
                    <input type="password" class="form-control" placeholder="Retype pin" name="pin_confirmation"/>
                    
                </div>
          @elseif ($pin == false)
          <input type="hidden" value="false"/>
          @else
          
          @endif 
                    <div class="form-group has-feedback">
                    	                		<label>Theme</label>
                  <select class="form-control" name="theme" required>
					<option value='' selected disabled>Please Select a Theme</option>
                    <option value="skin-blue">Blue</option>
                    <option value="skin-blue-light">Light Blue</option>
                    <option value="skin-yellow">Yellow</option>
                    <option value="skin-yellow-light">Light Yellow</option>
                    <option value="skin-green">Green</option>
                    <option value="skin-green-light">Light Green</option>
                    <option value="skin-purple">Purple</option>
                    <option value="skin-purple-light">Light Purple</option>
                    <option value="skin-red">Red</option>
                    <option value="skin-red-light">Light Red</option>
                    <option value="skin-black">Black</option>
                    <option value="skin-black-light">White</option>
                  </select>
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