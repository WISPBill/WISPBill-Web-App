@extends('layouts.app')

@section('htmlheader_title')
	Create Site
@endsection
  @section('page-header')
	  <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
   <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-geocoder-mapzen/1.4.0/leaflet-geocoder-mapzen.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-geocoder-mapzen/1.4.0/leaflet-geocoder-mapzen.js"></script>
  <style>
    #map{ min-width: inherit; min-height: 550px; }
  </style>
@endsection
@section('contentheader_title')
	Create A Site
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
              <form role="form" action="/newsite"method="post">
                <!-- text input -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
				  <div class="form-group">
                  <label>Site Type</label>
                  <select class="form-control"  name='type' id="site" required>
					<option value='' selected disabled>Please Select an Option</option>
                <option value='micro'>Micro Pop</option>
				<option value='tower'>Tower</option>
				  <option value='other'>Other</option>
                  </select>
                </div>
				  
				   <div class="form-group" style="display:none;" id="other">
              <label>If Other</label>
                  
                  <input type="text" class="form-control" name="other" placeholder="Enter Site Type">
                </div>
				  
                <div class="form-group" >
					<label>Site Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                </div>
				  
                <input type="hidden" name="lat" id="lat" value="">
				<input type="hidden" name="lon" id="lon" value="">
				<label>Site Location</label>
				 <div id="map"></div>
				<div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
     
              </form>
@endsection
@section('page-scripts')

  <script>
        $(document).ready(function (){
            $("#site").change(function() {
                if ($(this).val() == "other") {
                    $("#other").show();
                }else{
                    $("#other").hide();
                } 
            });
        });
  </script>
	             <script>
  // initialize the map

  var map = L.map('map').setView([{{$mapsettings['lat']}}, {{$mapsettings['lon']}}], {{$mapsettings['zoom']}});

  // load a tile layer
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
      
    }).addTo(map);

    var geocoder = L.control.geocoder('{{$key}}').addTo(map);
    var tower = L.marker([{{$mapsettings['lat']}}, {{$mapsettings['lon']}}],{
	 draggable: true,
	 title: 'Drag Me to the Location'
	 }).addTo(map).bindPopup('Drag Me to the Location');
	 
	 function getExtent(e) {
              var lat = tower.getLatLng().lat;
              var lng = tower.getLatLng().lng;
		  
		  document.getElementById('lat').value = lat;
          document.getElementById('lon').value = lng;
        }
        map.on('mouseout', getExtent);
     
  </script>
@endsection 