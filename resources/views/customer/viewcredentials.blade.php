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
            <h4>Select a Customer</h4>
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
			<form role="form" action="/viewcredentials"method="post">
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
             @foreach($customers as $customer)
                 <tr><td><input type='radio' name='id' value='{{$customer->id}}' unchecked onclick="handleClick(this);"></td>
				 <td>{{ $customer->name}}</td>
                 <td>{{ $customer->tel}}</td>
                 <td>{{ $customer->email}}</td>
                 <td style="text-transform: capitalize;">{{ $customer->type}}</td>
                 <td>{{ $customer->add}}</td>
                 <td>{{ $customer->city}}</td>
                 <td>{{ $customer->zip}}</td></tr>
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
                    <h4>Select a Location Once you Select a Customer</h4>
					  <table id="table2" class="table table-bordered table-striped">
                <thead>
                <tr>
				<th>Select</th>
				  <th>Address</th> 
				  <th>City</th>
                  <th>State</th>
                    <th>Zip</th>
				  <th>Status</th> 
				 <th>Added On</th>
                 <th>Updated On</th>
                </tr>
                </thead>
                <tbody>
            
              </tbody>
                <tfoot>
                <tr>
					<th>Select</th>
				  <th>Address</th> 
				  <th>City</th>
                  <th>State</th>
                    <th>Zip</th>
				  <th>Status</th> 
				 <th>Added On</th>
                 <th>Updated On</th>
                </tr>
                </tfoot>
              </table>
                  
                </div>
                
                <br></br>

                
           @if ($verifypin == true)
           <div class="form-group has-feedback">
	<label>Pin</label>
                    <input type="password" class="form-control" placeholder="Pin" name="pin"/>
                    
                </div>
          @elseif ($verifypin == false)
          
          @else
          
          @endif 
				 
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
    $(function () {
    $('#table2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
      $(function () {
    $('#table3').DataTable({
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
  var id = 0;
function handleClick(myRadio) {

    id = myRadio.value;

    $(document).ready(function() {
    $('#table2').DataTable({
    	"destroy": true,
  		"paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "ajax": {
        "url":	"/customerlocationdata/"+id+"/radius/data.txt",
      	"dataSrc": '',
      },
      
      "columns": [
            { "data":  "id" },
            { "data": "add" },
            { "data": "city" },
            { "data": "state" },
            { "data": "zip" },
            { "data": "status" },
            { "data": "created_at" },
            { "data": "updated_at" },
        ]
    });
} );

}
      
  </script>

@endsection 