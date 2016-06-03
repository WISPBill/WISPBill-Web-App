@extends('layouts.map')

@section('htmlheader_title')
	Map Sites
@endsection

@section('contentheader_title')
	Map Sites
@endsection

@section('map-data')

  @foreach($sites as $site)
  <script>
  
 var marker = L.marker([{{$site->latitude}}, {{$site->longitude}}])
        .addTo(map)
            .bindPopup('{{$site->name}} Type: {{$site->type}}');
</script>
@endforeach
@endsection