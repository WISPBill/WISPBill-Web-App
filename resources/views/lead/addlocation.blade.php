@extends('layouts.app')
@section('page-header')
	 <link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('htmlheader_title')
	Add a Location to a Lead
@endsection

@section('contentheader_title')
	Add a Location to a Lead
@endsection

@section('main-content')
	<!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
            <h4>We have {{$total}} Lead's</h4>
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
			<form role="form" action="/addleadlocation"method="post">
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
			    <div class="form-group">
                  <label>Location for Service</label>
					
                  <select class="form-control"  name='location' id="location" required>
					<option value='' selected disabled>Please Select an Option</option>
                <option value='same'>Same as Billing Address</option>
                <option value='different'>Different From Billing Address</option>
                  </select>
                </div>
				  <span id="locationfeilds" style="display:none;">
               <div class="form-group">
              <label>Street Address</label>
                  
                  <input type="text" class="form-control" name="add" placeholder="Enter Street Address" >
                </div>
               <div class="form-group">
                <label>City</label>
                  
                  <input type="text" class="form-control" name="city" placeholder="Enter City" >
                </div>
               <div class="form-group">
               <label>Zip Code</label>
                  
                  <input type="text" class="form-control" name="zip" placeholder="Enter Street Address" >
                </div>
               <div class="form-group">
                <label>State</label>
                  
                  <input type="text" class="form-control" name="state" placeholder="Enter State">
                </div>
            </span>
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
  <script>
        $(document).ready(function (){
            $("#location").change(function() {
                if ($(this).val() != "same") {
                    $("#locationfeilds").show();
                }else{
                    $("#locationfeilds").hide();
                } 
            });
        });
  </script>
@endsection 