@extends('layouts.app')
@section('page-header')
  <script src="{{asset('/plugins/jQuery/jQuery-2.1.4.min.js')}}"/></script> 
	 <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
   <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-geocoder-mapzen/1.4.0/leaflet-geocoder-mapzen.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-geocoder-mapzen/1.4.0/leaflet-geocoder-mapzen.js"></script>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
	 <style>
    #map{ min-width: inherit; min-height: 500px; }
  </style>
@endsection
@section('htmlheader_title')
	Settings
@endsection

@section('contentheader_title')
	Settings

@endsection

@section('main-content')
	<!-- general form elements disabled -->
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
           
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>View User's</h3>

              
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="/viewusers" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
          </div>
          
           <div class="small-box bg-green">
            <div class="inner">
              <h3>Manage User Permissions</h3>

              
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="/manageusers" class="small-box-footer">Manage Permissions <i class="fa fa-arrow-circle-right"></i></a>
          </div>
       
			</div>
		  </div>
          <div class="box box-warning">
            <div class="box-header with-border">
			<h4>Stipe API Keys</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if (count($errors->get('publishable')) > 0 or count($errors->get('secret')) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->get('publishable') as $error)
                <li>{{ $error }}</li>
            @endforeach
			
			 @foreach ($errors->get('secret') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
              <form role="form" action="/setstripekey"method="post">
                <!-- text input -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
				
				  
                <div class="form-group">
					<label>Publishable Key</label>
                  <input type="text" class="form-control" name="publishable" placeholder="Enter Publishable Key" required>
                </div>
               
               <div class="form-group">
              <label>Secret Key</label>
                  
                  <input type="text" class="form-control" name="secret" placeholder="Enter Secret Key" required>
                </div>

				<div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
     
              </form>
			</div>
		  </div>
			
			          <div class="box box-success">
            <div class="box-header with-border">
			<h4>Geocoder</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if (count($errors->get('service')) > 0 or count($errors->get('api')) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->get('service') as $error)
                <li>{{ $error }}</li>
            @endforeach
			
			 @foreach ($errors->get('api') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
              <form role="form" action="/setgeocoder"method="post">
                <!-- text input -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
				
				  
                <div class="form-group">
					<label>Geocoding Service</label>
                    <select class="form-control" name="service" required>
					<option value='' selected disabled>Please Select a Service</option>
                    <option value="mapzen">Mapzen Search (Based on OpenAddress API Key Required)</option>
                    <option value="census">US Census Geocoder (Residential Only API Key Not Required)</option>
                     <option value="manual">Manual (Map Based API Key Not Required)</option>
					</select>
                </div>
               
               <div class="form-group">
              <label>API Key</label>
                  
                  <input type="text" class="form-control" name="api" placeholder="Enter API Key">
                </div>

				<div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
     
              </form>
			</div>
		  </div>
			   <div class="box box-danger">
            <div class="box-header with-border">
			<h4>Set Map View</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <form role="form" action="/setmapview"method="post">
                <!-- text input -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="lat" id="lat" value="">
				<input type="hidden" name="lon" id="lon" value="">
				<input type="hidden" name="zoom" id="zoom" value="">
				  <div id="map"></div>
            @yield('main-content')
            
             <script>
  // initialize the map

  var map = L.map('map').setView([38.0000, -97.0000], 4);

  // load a tile layer
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
      
    }).addTo(map);

    var geocoder = L.control.geocoder('{{$key}}').addTo(map);
     
     function getExtent(e) {
              var lat = map.getCenter().lat;
              var lng = map.getCenter().lng;
              var zoom =  map.getZoom();
		  
		  document.getElementById('lat').value = lat;
          document.getElementById('lon').value = lng;
		  document.getElementById('zoom').value = zoom;
        }
        map.on('mouseout', getExtent);
  </script>
               
				<div class="box-footer">
                <button type="submit" class="btn btn-primary">Save View</button>
              </div>
     
              </form>
			</div>
		  </div>
		  
		   <div class="box box-warning">
            <div class="box-header with-border">
			<h4>General Settings</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
         
              <form role="form" action="/togglesettings"method="post">
                <!-- text input -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
		
                <div class="checkbox">
          <h4>
          <input type="checkbox" name="pin" 
          @if ($verifypin == true)
          checked
          @elseif ($verifypin == false)
          
          @else
          
          @endif 
          data-toggle="toggle" data-size="large">
            Customer PIN Verification Required for Actions done by Technicians and Agents
          </h4>
            </div>
            
              <div class="checkbox">
          <h4>
          <input type="checkbox" name="speed" 
          @if ($speed == true)
          checked
          @elseif ($speed == false)
          
          @else
          
          @endif 
          data-toggle="toggle" data-size="large">
            Rate Limiting for Service Plans
          </h4>
            </div>
            
              <div class="checkbox">
          <h4>
          <input type="checkbox" name="data" 
          @if ($data == true)
          checked
          @elseif ($data == false)
          
          @else
          
          @endif 
          data-toggle="toggle" data-size="large">
            Data Limits for Service Plans
          </h4>
            </div>
            
                          <div class="checkbox">
          <h4>
          <input type="checkbox" name="burst" 
          @if ($burst == true)
          checked
          @elseif ($burst == false)
          
          @else
          
          @endif 
          data-toggle="toggle" data-size="large">
            Rate Limit Bursting for Service Plans
          </h4>
            </div>


				<div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
     
              </form>
			</div>
		  </div>
		  
		       <div class="box box-success">
            <div class="box-header with-border">
			<h4>Open-Mail-Marketing</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if (count($errors->get('url')) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->get('url') as $error)
                <li>{{ $error }}</li>
            @endforeach
		
        </ul>
    </div>
@endif
              <form role="form" action="/setmailmarketingurl"method="post">
                <!-- text input -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
				
               
               <div class="form-group">
              <label>URL</label>
                  
                  <input type="url" class="form-control" name="url" placeholder="Enter URL">
                </div>

				<div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
     
              </form>
			</div>
		  </div>
		  
		           <div class="box box-success">
            <div class="box-header with-border">
			<h4>SSH Port</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if (count($errors->get('ssh')) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->get('ssh') as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>
    </div>
@endif
              <form role="form" action="/setssh"method="post">
                <!-- text input -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
           
               <div class="form-group">
              <label>SSH Port</label>
                  
                  <input type="number" min="1" class="form-control" name="ssh" placeholder="Enter SSH Port">
                </div>

				<div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
     
              </form>
			</div>
		  </div>
		  
		   <div class="box box-warning">
            <div class="box-header with-border">
			<h4>Radius Settings</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
         
              <form role="form" action="/setradius"method="post">
                <!-- text input -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
		
                <div class="checkbox">
          <h4>
          <input type="checkbox" name="radius" id="radius" onchange ="checkradius(this)"
          @if ($radius == true)
          checked
          @elseif ($radius == false)
          
          @else
          
          @endif 
          data-toggle="toggle" data-size="large">
            Radius Billing
          </h4>
            </div>
      <span id="radiusfeilds" 
      
      @if($radius == true)
      
      @else
      
      style="display:none;"
      
      @endif
      
      >
        <br></br>
        <div class="form-group">
<label>Database IP </label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <input name="IP" type="text" class="form-control" data-inputmask="'alias': 'ip'" data-mask required>
                </div>
                <!-- /.input group -->
              </div>
        
        
         <div class="form-group">
              <label>Datebase Port</label>
                  
                  <input type="number" min="1" class="form-control" name="port" value="3306">
                </div>
                
                <div class="form-group">
              <label>Database Username</label>
                  
                  <input type="text" class="form-control" name="username" placeholder="Enter Username for Database">
                </div>
        
        <div class="form-group has-feedback">
	<label>Database Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="password"/>
                    
                </div>
                <div class="form-group has-feedback">
                		<label>Confirm Database Password</label>
                    <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation"/>
                    
                </div>
      </span>
      
           </div>

				<div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
     
              </form>
			</div>
		  </div>
@endsection
@section('page-scripts')

  <script>

        
    function checkradius(checkbox)
    {
        if (checkbox.checked == true)
        {
          
          $("#radiusfeilds").show();

        }else{
          
          $("#radiusfeilds").hide();
          
        }
    }
  </script>
<script src="{{ asset('/plugins/select2/select2.full.min.js')}}"></script>
<!-- InputMask -->
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
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

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>
@endsection 
