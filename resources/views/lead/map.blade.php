@extends('layouts.map')

@section('htmlheader_title')
	Map Lead's
@endsection

@section('contentheader_title')
	Map Lead's
@endsection

@section('map-data')

  @foreach($geoleads as $geolead)
  <script>
  
 var marker = L.marker([{{$geolead->latitude}}, {{$geolead->longitude}}])
        .addTo(map)
            .bindPopup('Name: {{$geolead->customer->name}} Email: {{$geolead->customer->email}} Phone: {{$geolead->customer->tel}}');
</script>
@endforeach
@endsection