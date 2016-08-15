@extends('layouts.app')
@section('page-header')
	 <link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}">

@endsection
@section('htmlheader_title')
	Add a NAS to Radius
@endsection

@section('contentheader_title')
	Add a NAS to Radius
@endsection

@section('main-content')
	<!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
           
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
			<form role="form" name="form" action="/newnas"method="post">
                <!-- text input -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
			    <div class="form-group">
                  <label>Manual or Automatic Configuration</label>
					
                  <select class="form-control"  name='configuration' id="configuration" required>
					<option value='' selected disabled>Please Select an Option</option>
                <option value='auto'>Automatic</option>
                <option value='manual'>Manual</option>
                  </select>
                </div>
				  <span id="manual" style="display:none;">
               <div class="form-group">
<label>NAS IP Address</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <input name="IP" type="text" class="form-control" data-inputmask="'alias': 'ip'" data-mask >
                </div>
                <!-- /.input group -->
              </div>
              
               <div class="form-group">
					<label>NAS Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Enter NAS Name" >
                </div>
                
                <div class="form-group">
					<label>NAS Type</label>
                  <input type="text" class="form-control" name="type" value="other" >
                </div>
                
                  <div class="form-group">
					        
                  <input type="button"  value="Generate Secret" onClick="generate();" class="btn btn-primary">
                </div>
                
                <div class="form-group has-feedback">
	<label>Secret</label>
                    <input type="password" class="form-control" placeholder="Secret" name="secret"/>
                    
                </div>
                <div class="form-group has-feedback">
                		<label>Confirm Secret</label>
                    <input type="password" class="form-control" placeholder="Retype Secret" name="secret_confirmation"/>
                    
                </div>
                
            </span>
       
       <span id="auto" style="display:none;">
         
         <h4>Select Router to add as a NAS</h4>
               <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
                   <th>Select</th> 
				  <th>Name</th> 
				  <th>Type</th>
                  <th>Manufacturer</th>
                    <th>Model</th>
                        <th>Software</th>
				  <th>Mac Address</th> 
				 <th>Serial Number</th>
                 <th>Added to Inventory</th>
                </tr>
                </thead>
                <tbody>
             @foreach($devices as $device)
                 <tr><td><input type='radio' name='id' value='{{$device->id}}' unchecked></td>
                   <td>{{ $device->name or 'Not Set' }}</td>
                 <td>{{ $device->type}}</td>
                 <td>{{ $device->manufacturer}}</td>
                 <td>{{ $device->model}} {{ $device->revision or '' }}</td>
                 <td>{{ $device->os}} {{$device->version}}</td>
                 <td>{{ $device->mac}}</td>
                 <td>{{ $device->serial_number or 'NA' }}</td>
                 <td>{{ date_format($device->created_at, 'n/j/y g:i A')}}</td></tr>
             @endforeach
              </tbody>
                <tfoot>
                <tr>
                   <th>Select</th> 
                 <th>Name</th> 
				  <th>Type</th>
                  <th>Manufacturer</th>
                    <th>Model</th>
                        <th>Software</th>
				  <th>Mac Address</th> 
				 <th>Serial Number</th>
                 <th>Added to Inventory</th>
                </tr>
                </tfoot>
              </table>
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
<script src="{{ asset ('/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset ('/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

<script src="{{ asset('/plugins/select2/select2.full.min.js')}}"></script>
<!-- InputMask -->
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
  <script>
        $(document).ready(function (){
            $("#configuration").change(function() {
                if ($(this).val() != "auto") {
                    $("#manual").show();
                    $("#auto").hide();
                }else{
                    $("#auto").show();
                    $("#manual").hide();
                } 
            });
        });
  </script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    
  });
</script>
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
function randomPassword(length) {
    var chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    var pass = "";
    for (var x = 0; x < length; x++) {
        var i = Math.floor(Math.random() * chars.length);
        pass += chars.charAt(i);
    }
    return pass;
}

function generate() {
    var password;
    
    password = randomPassword(8);
    
    form.secret.value = password;
    form.secret_confirmation.value = password;
    
}
</script>


@endsection 