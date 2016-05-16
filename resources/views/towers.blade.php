@extends('layout')

@section('sidebar')

@stop

@section('content')
 <div class="panel-heading"><h3 class="panel-title">Towers</h3></div>
            <div class="panel-body">
                <table class="table table-striped table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Street Address 1</th>
                            <th>Street Address 2</th>
                            <th>City</th>
                            <th>State</th>
                            <th>ZIP</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($towers as $tower)
                        <tr>
                            {{ Form::open(array('route' => array('updateTower'), 'class'=>'form-horizontal')) }}
                            <td>
                                {{ Form::label('tower_id', null, array('class'=>'sr-only')) }}
                                {{ Form::text('tower_id', $tower->id, array('class'=>'form-control', 'readonly')) }}
                            </td>
                            <td>
                                {{ Form::label('tower_name', null, array('class'=>'sr-only')) }}
                                {{ Form::text('tower_name', $tower->name, array('class'=>'form-control', 'placeholder'=>'Name')) }}
                            </td>
                            <td>
                                {{ Form::label('tower_staddr1', null, array('class'=>'sr-only')) }}
                                {{ Form::text('tower_staddr1', $tower->street_address_1, array('class'=>'form-control', 'placeholder'=>'St Address 1')) }}
                            </td>
                            <td>
                                {{ Form::label('tower_staddr2', null, array('class'=>'sr-only')) }}
                                {{ Form::text('tower_staddr2', $tower->street_address_2, array('class'=>'form-control', 'placeholder'=>'St Address 2')) }}
                            </td>
                            <td>
                                {{ Form::label('tower_city', null, array('class'=>'sr-only')) }}
                                {{ Form::text('tower_city', $tower->city, array('class'=>'form-control', 'placeholder'=>'City')) }}
                            </td>
                            <td>
                                {{ Form::label('tower_state', null, array('class'=>'sr-only')) }}
                                {{ Form::text('tower_state', $tower->state, array('class'=>'form-control', 'placeholder'=>'State')) }}
                            </td>
                            <td>
                                {{ Form::label('tower_zip', null, array('class'=>'sr-only')) }}
                                {{ Form::text('tower_zip', $tower->zip, array('class'=>'form-control', 'placeholder'=>'Zip')) }}
                            </td>
                            <td>{{ Form::submit('Update') }}</td>
                            {{ Form::close() }}
                        </tr>
                        @endforeach
                        <tr>
                            {{ Form::open(array('route' => array('updateTower'), 'class'=>'form-horizontal')) }}
                            <td>
                                {{ Form::label('new_tower_id', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_tower_id', null, array('class'=>'form-control', 'readonly')) }}
                            </td>
                            <td>
                                {{ Form::label('new_tower_name', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_tower_name', null, array('class'=>'form-control', 'placeholder'=>'Name')) }}
                            </td>
                            <td>
                                {{ Form::label('new_tower_staddr1', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_tower_staddr1', null, array('class'=>'form-control', 'placeholder'=>'St Address 1')) }}
                            </td>
                            <td>
                                {{ Form::label('new_tower_staddr2', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_tower_staddr2', null, array('class'=>'form-control', 'placeholder'=>'St Address 2')) }}
                            </td>
                            <td>
                                {{ Form::label('new_tower_city', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_tower_city', null, array('class'=>'form-control', 'placeholder'=>'City')) }}
                            </td>
                            <td>
                                {{ Form::label('new_tower_state', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_tower_state', null, array('class'=>'form-control', 'placeholder'=>'State')) }}
                            </td>
                            <td>
                                {{ Form::label('new_tower_zip', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_tower_zip', null, array('class'=>'form-control', 'placeholder'=>'Zip')) }}
                            </td>
                            <td>{{ Form::submit('Add') }}</td>
                            {{ Form::close() }}
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
@stop