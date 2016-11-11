@extends('layouts.map')

@section('htmlheader_title')
	Tower Coverage Heat Map
@endsection

@section('contentheader_title')
	Tower Coverage Heat Map
@endsection

@section('map-data')

  <script>
            
    var heat = L.heatLayer([
      @foreach($data as $row)
      
    [{{$row[1]}}, {{$row[0]}},1], // lat, lng, intensity
    
   @endforeach
], {radius: 30}).addTo(map);
</script>


@endsection