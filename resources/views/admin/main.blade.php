@extends('layouts.app')
@section('page-header')
	 <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
   <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-geocoder-mapzen/1.4.0/leaflet-geocoder-mapzen.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-geocoder-mapzen/1.4.0/leaflet-geocoder-mapzen.js"></script>
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
@endsection