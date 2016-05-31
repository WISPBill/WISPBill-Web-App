@extends('layouts.map')

@section('htmlheader_title')
	Edit Site Coverage
@endsection

@section('contentheader_title')
	Edit Site Coverage by Double Clicking
@endsection
@section('main-content')
   <form role="form" action="/editcoverage" method="post">
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
   <input type="hidden" id="data" name= "data" value="">
   <input type="hidden" id="site" name= "site" value="">
   
      <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>   
  	    </form>
@endsection
@section('map-data')
<script>
  
    var drawnItems = new L.FeatureGroup();
		  
map.addLayer(drawnItems);

var drawControlFull = new L.Control.Draw({
    edit: {
        featureGroup: drawnItems
    },
    draw: {
         polyline: false,
        marker: false,
        rectangle: false,        
        circle: false
    }
});


var drawControlEditOnly = new L.Control.Draw({
    edit: {
        featureGroup: drawnItems
    },
    draw: false
    
});

map.addControl(drawControlFull);

map.on("draw:created", function (e) {
    var layer = e.layer;
    layer.addTo(drawnItems);
    drawControlFull.removeFrom(map);
    drawControlEditOnly.addTo(map)
    
    
});

map.on("draw:deleted", function(e) {
   check =  Object.keys(drawnItems._layers).length;
   console.log(check);
    if (check === 0){
        drawControlEditOnly.removeFrom(map);
        drawControlFull.addTo(map);
    };
});

</script>
  @foreach($sites as $site)
  <script>
 function on2Click{{$site->id}}(e) {
        
        @foreach($sites as $site2)
        map.removeLayer(marker{{$site2->id}});
        @endforeach
        
         var marker = L.marker([{{$site->latitude}}, {{$site->longitude}}])
        .addTo(map).bindPopup('Name: {{$site->name}} ');
        
        document.getElementById('site').value = {{$site->id}};
        
        L.geoJson({!! $site->coverage or 'a ' !!}, {
  onEachFeature: function (feature, layer) {
    drawnItems.addLayer(layer);
  }
});
}
 
 
 var marker{{$site->id}} = L.marker([{{$site->latitude}}, {{$site->longitude}}])
        .addTo(map).on('dblclick', on2Click{{$site->id}}).bindPopup('Name: {{$site->name}} ');

            
            
</script>
@endforeach
<script>
  
    
        map.on('draw:created', function (e) {
        var type = e.layerType;
        var layer = e.layer;

        var shape = layer.toGeoJSON()
        var shape_for_db = JSON.stringify(shape);
        document.getElementById('data').value = shape_for_db;
        });
        
        map.on('draw:edited', function (e) {
        var layers = e.layers;
        layers.eachLayer(function (layer) {
        var shape = layer.toGeoJSON()
        var shape_for_db = JSON.stringify(shape);
        document.getElementById('data').value = shape_for_db;
        });
        });
        
</script>
@endsection