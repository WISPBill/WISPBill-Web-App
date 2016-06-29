@extends('layouts.map')

@section('htmlheader_title')
	Map Coverage
@endsection

@section('contentheader_title')
	Map Coverage
@endsection

@section('map-data')

  @foreach($sites as $site)
  <script>
  
 var marker = L.marker([{{$site->latitude}}, {{$site->longitude}}])
        .addTo(map)
            .bindPopup('{{$site->name}} Type: {{$site->type}}');
            
  var geo = {!! $site->coverage !!};
            L.geoJson(geo, {   
        }).addTo(map)
            .bindPopup('{{$site->name}}: Coverage');
</script>
@endforeach
@endsection