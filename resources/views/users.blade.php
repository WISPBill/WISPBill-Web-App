@extends('layout')
@section('head')
<link href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css" rel="stylesheet">
@stop
@section('sidebar')

<div id="searchWrapper"></div>
<div id="lengthWrapper"></div>
<div id="resultsWrapper"></div>
<div id="pagesWrapper"></div>


<div class="col-sm-12">
    {!! link_to_route('userNew', 'Add New User', null, ['class' => 'btn btn-primary']) !!}
</div>


@stop

@section('content')
<table id='users' class="table table-striped table-condensed table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Business</th>
            <th>Service Address</th>
            <th>Email</th>
            <th>Phone</th>
            <th>IP</th>
            <th>Blocked</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>
                <a href="{{ URL::route('userDetails', array('id'=>$user->id)) }}">
                    {{ $user->last_name . ',' . $user->first_name }}
                </a>
            </td>
            <td>{{ $user->business_name }}</td>
            <td>
                @foreach($user->serviceLocation as $locations)
                <a href="http://maps.google.com/?q={{ $locations->street_address_1 . ' ' . $locations->street_address_2 . ' ' . $locations->city . ' ' . $locations->state . ' ' . $locations->zip }}" target="_blank">
                    {{ $locations->street_address_1 }}
                    <br>
                    @if ($locations->street_address_2 != '')
                    {{ $locations->street_address_2 }}
                    <br>
                    @endif
                    {{ $locations->city . ' ' . $locations->state . ' ' . $locations->zip }}
                </a>
                {!! ''; break; !!}
                @endforeach
            </td>
            <td>{{ $user->email }}</td>
            <td>
                {{ $user->phone_1 }}
                <br>
                {{ $user->phone_2 }}
            </td>
            <td>
                @foreach($user->serviceLocation as $locations)
                @foreach($locations->ip as $ip)
                <a href="http://{{ long2ip($ip->address) }}" target="_blank">
                    {{ long2ip($ip->address) }}
                </a>
                {!! ''; break; !!}
                @endforeach
                {!! ''; break; !!}
                @endforeach
            </td>
            <td>{{ $user->blocked }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop

@section('footer')
<script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>
<script type='text/javascript'>
$(document).ready(function () {
    $('#users').DataTable({
        "dom": '<"#results"i><"#search"f><"#pages"p>l',
        "order": [[1, "desc"]]
    });
    $('#resultsWrapper').append($('#results'));
    $('#searchWrapper').append($('#search'));
    $('#pagesWrapper').append($('#pages'));
});
</script>
@stop
