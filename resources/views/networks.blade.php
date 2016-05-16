@extends('layout')

@section('sidebar')
@if (isset($_GET['error']))
<div class='alert alert-danger'>IPs in that network in use</div>
@endif
@stop

@section('content')
 <div class="panel-heading"><h3 class="panel-title">Networks</h3></div>
            <div class="panel-body">
                <table class="table table-striped table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>Network</th>
                            <th>Cidr</th>
                            <th>Tower</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($networks as $network)
                        <tr>
                            {{ Form::open(array('route' => array('updateNetwork'), 'class'=>'form-horizontal')) }}
                                {{ Form::hidden('network_id', $network->id) }}
                            <td>
                                {{ Form::label('network_address', null, array('class'=>'sr-only')) }}
                                {{ Form::text('network_address', long2ip($network->address), array('class'=>'form-control', 'placeholder'=>'Network')) }}
                            </td>
                            <td>
                                {{ Form::label('network_cidr', null, array('class'=>'sr-only')) }}
                                {{ Form::selectRange('network_cidr', 0, 32, $network->cidr, array('class'=>'form-control')) }}
                            </td>
                            <td>
                                {{ Form::label('network_twrid', null, array('class'=>'sr-only')) }}
                                {{ Form::select('network_twrid', $towers, $network->tower_id, array('class'=>'form-control', 'placeholder'=>'Tower')) }}
                            </td>
                            <td>{{ Form::submit('Update') }}</td>
                            {{ Form::close() }}
                        </tr>
                        @endforeach
                        <tr>
                            {{ Form::open(array('route' => array('addNetwork'), 'class'=>'form-horizontal')) }}
                            <td>
                                {{ Form::label('network_adress', null, array('class'=>'sr-only')) }}
                                {{ Form::text('network_address', null, array('class'=>'form-control', 'placeholder'=>'Network')) }}
                            </td>
                            <td>
                                {{ Form::label('network_cidr', null, array('class'=>'sr-only')) }}
                                {{ Form::selectRange('network_cidr', 0, 32, null, array('class'=>'form-control')) }}
                            </td>
                            <td>
                                {{ Form::label('network_twrid', null, array('class'=>'sr-only')) }}
                                {{ Form::select('network_twrid', $towers, null, array('class'=>'form-control', 'placeholder'=>'Tower')) }}
                            </td>
                            <td>{{ Form::submit('Add') }}</td>
                            {{ Form::close() }}
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
@stop