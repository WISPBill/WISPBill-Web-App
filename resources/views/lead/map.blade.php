@extends('layouts.map')

@section('htmlheader_title')
	Map Lead's
@endsection

@section('contentheader_title')
	Map Lead's
@endsection

@section('map-data')

@if($heat == false)

  @foreach($geoleads as $geolead)
  <script>
  
 var marker = L.marker([{{$geolead->latitude}}, {{$geolead->longitude}}])
        .addTo(map)
            .bindPopup('Name: {{$geolead->customer->name}} Email: {{$geolead->customer->email}} Phone: {{$geolead->customer->tel}}');
</script>
  @endforeach
  
@elseif($heat == true)

  <script>
            
    var heat = L.heatLayer([
      @foreach($geoleads as $geolead)
      
    [{{$geolead->latitude}}, {{$geolead->longitude}},1], // lat, lng, intensity
    
   @endforeach
], {radius: 30}).addTo(map);
</script>

@endif
@endsection