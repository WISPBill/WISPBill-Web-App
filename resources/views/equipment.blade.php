@extends('layout')

@section('sidebar')

@stop

@section('content')
<div class="row top-row"></div>

<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-heading"><h3 class="panel-title">Antennas</h3></div>
            <div class="panel-body">
                <table class="table table-striped table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Manufacturer</th>
                            <th>Model</th>
                            <th>Available Count</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($antennas as $antenna)
                        <tr>
                            {{ Form::open(array('route' => array('updateEquipment'), 'class'=>'form-horizontal')) }}
                            <td>
                                {{ Form::label('antenna_id', null, array('class'=>'sr-only')) }}
                                {{ Form::text('antenna_id', $antenna->id, array('class'=>'form-control', 'readonly')) }}
                            </td>
                            <td>
                                {{ Form::label('antenna_mfg', null, array('class'=>'sr-only')) }}
                                {{ Form::text('antenna_mfg', $antenna->mfg, array('class'=>'form-control', 'placeholder'=>'Manufacturer')) }}
                            </td>
                            <td>
                                {{ Form::label('antenna_model', null, array('class'=>'sr-only')) }}
                                {{ Form::text('antenna_model', $antenna->model, array('class'=>'form-control', 'placeholder'=>'Model')) }}
                            </td>
                            <td>
                                {{ Form::label('antenna_total', null, array('class'=>'sr-only')) }}
                                {{ Form::text('antenna_total', $antenna->total, array('class'=>'form-control', 'placeholder'=>'Available Count')) }}
                            </td>
                            <td>{{ Form::submit('Update') }}</td>
                            {{ Form::close() }}
                        </tr>
                        @endforeach
                        <tr>
                            {{ Form::open(array('route' => array('updateEquipment'), 'class'=>'form-horizontal')) }}
                            <td>
                                {{ Form::label('new_antenna_id', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_antenna_id', null, array('class'=>'form-control', 'readonly')) }}
                            </td>
                            <td>
                                {{ Form::label('new_antenna_mfg', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_antenna_mfg', null, array('class'=>'form-control', 'placeholder'=>'Manufacturer')) }}
                            </td>
                            <td>
                                {{ Form::label('new_antenna_model', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_antenna_model', null, array('class'=>'form-control', 'placeholder'=>'Model')) }}
                            </td>
                            <td>
                                {{ Form::label('new_antenna_total', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_antenna_total', null, array('class'=>'form-control', 'placeholder'=>'Available Count')) }}
                            </td>
                            <td>{{ Form::submit('Add') }}</td>
                            {{ Form::close() }}
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-heading"><h3 class="panel-title">Radio Cards</h3></div>
            <div class="panel-body">
                <table class="table table-striped table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Manufacturer</th>
                            <th>Model</th>
                            <th>Available Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($radio_cards as $radio_card)
                        <tr>
                            {{ Form::open(array('route' => array('updateEquipment'), 'class'=>'form-horizontal')) }}
                            <td>
                                {{ Form::label('radio_card_id', null, array('class'=>'sr-only')) }}
                                {{ Form::text('radio_card_id', $radio_card->id, array('class'=>'form-control', 'readonly')) }}
                            </td>
                            <td>
                                {{ Form::label('radio_card_mfg', null, array('class'=>'sr-only')) }}
                                {{ Form::text('radio_card_mfg', $radio_card->mfg, array('class'=>'form-control', 'placeholder'=>'Manufacturer')) }}
                            </td>
                            <td>
                                {{ Form::label('radio_card_model', null, array('class'=>'sr-only')) }}
                                {{ Form::text('radio_card_model', $radio_card->model, array('class'=>'form-control', 'placeholder'=>'Model')) }}
                            </td>
                            <td>
                                {{ Form::label('radio_card_total', null, array('class'=>'sr-only')) }}
                                {{ Form::text('radio_card_total', $radio_card->total, array('class'=>'form-control', 'placeholder'=>'Available Count')) }}
                            </td>
                            <td>{{ Form::submit('Update') }}</td>
                            {{ Form::close() }}
                        </tr>
                        @endforeach
                        <tr>
                            {{ Form::open(array('route' => array('updateEquipment'), 'class'=>'form-horizontal')) }}
                            <td>
                                {{ Form::label('new_radio_card_id', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_radio_card_id', null, array('class'=>'form-control', 'readonly')) }}
                            </td>
                            <td>
                                {{ Form::label('new_radio_card_mfg', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_radio_card_mfg', null, array('class'=>'form-control', 'placeholder'=>'Manufacturer')) }}
                            </td>
                            <td>
                                {{ Form::label('new_radio_card_model', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_radio_card_model', null, array('class'=>'form-control', 'placeholder'=>'Model')) }}
                            </td>
                            <td>
                                {{ Form::label('new_radio_card_total', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_radio_card_total', null, array('class'=>'form-control', 'placeholder'=>'Available Count')) }}
                            </td>
                            <td>{{ Form::submit('Add') }}</td>
                            {{ Form::close() }}
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-heading"><h3 class="panel-title">Routers</h3></div>
            <div class="panel-body">
                <table class="table table-striped table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Manufacturer</th>
                            <th>Model</th>
                            <th>Available Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($routers as $router)
                        <tr>
                            {{ Form::open(array('route' => array('updateEquipment'), 'class'=>'form-horizontal')) }}
                            <td>
                                {{ Form::label('router_id', null, array('class'=>'sr-only')) }}
                                {{ Form::text('router_id', $router->id, array('class'=>'form-control', 'readonly')) }}
                            </td>
                            <td>
                                {{ Form::label('router_mfg', null, array('class'=>'sr-only')) }}
                                {{ Form::text('router_mfg', $router->mfg, array('class'=>'form-control', 'placeholder'=>'Manufacturer')) }}
                            </td>
                            <td>
                                {{ Form::label('router_model', null, array('class'=>'sr-only')) }}
                                {{ Form::text('router_model', $router->model, array('class'=>'form-control', 'placeholder'=>'Model')) }}
                            </td>
                            <td>
                                {{ Form::label('router_total', null, array('class'=>'sr-only')) }}
                                {{ Form::text('router_total', $router->total, array('class'=>'form-control', 'placeholder'=>'Available Count')) }}
                            </td>
                            <td>{{ Form::submit('Update') }}</td>
                            {{ Form::close() }}
                        </tr>
                        @endforeach
                        <tr>
                            {{ Form::open(array('route' => array('updateEquipment'), 'class'=>'form-horizontal')) }}
                            <td>
                                {{ Form::label('new_router_id', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_router_id', null, array('class'=>'form-control', 'readonly')) }}
                            </td>
                            <td>
                                {{ Form::label('new_router_mfg', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_router_mfg', null, array('class'=>'form-control', 'placeholder'=>'Manufacturer')) }}
                            </td>
                            <td>
                                {{ Form::label('new_router_model', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_router_model', null, array('class'=>'form-control', 'placeholder'=>'Model')) }}
                            </td>
                            <td>
                                {{ Form::label('new_router_total', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_router_total', null, array('class'=>'form-control', 'placeholder'=>'Available Count')) }}
                            </td>
                            <td>{{ Form::submit('Add') }}</td>
                            {{ Form::close() }}
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-heading"><h3 class="panel-title">Poes</h3></div>
            <div class="panel-body">
                <table class="table table-striped table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Manufacturer</th>
                            <th>Model</th>
                            <th>Available Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($poes as $poe)
                        <tr>
                            {{ Form::open(array('route' => array('updateEquipment'), 'class'=>'form-horizontal')) }}
                            <td>
                                {{ Form::label('poe_id', null, array('class'=>'sr-only')) }}
                                {{ Form::text('poe_id', $poe->id, array('class'=>'form-control', 'readonly')) }}
                            </td>
                            <td>
                                {{ Form::label('poe_mfg', null, array('class'=>'sr-only')) }}
                                {{ Form::text('poe_mfg', $poe->mfg, array('class'=>'form-control', 'placeholder'=>'Manufacturer')) }}
                            </td>
                            <td>
                                {{ Form::label('poe_model', null, array('class'=>'sr-only')) }}
                                {{ Form::text('poe_model', $poe->model, array('class'=>'form-control', 'placeholder'=>'Model')) }}
                            </td>
                            <td>
                                {{ Form::label('poe_total', null, array('class'=>'sr-only')) }}
                                {{ Form::text('poe_total', $poe->total, array('class'=>'form-control', 'placeholder'=>'Available Count')) }}
                            </td>
                            <td>{{ Form::submit('Update') }}</td>
                            {{ Form::close() }}
                        </tr>
                        @endforeach
                        <tr>
                            {{ Form::open(array('route' => array('updateEquipment'), 'class'=>'form-horizontal')) }}
                            <td>
                                {{ Form::label('new_poe_id', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_poe_id', null, array('class'=>'form-control', 'readonly')) }}
                            </td>
                            <td>
                                {{ Form::label('new_poe_mfg', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_poe_mfg', null, array('class'=>'form-control', 'placeholder'=>'Manufacturer')) }}
                            </td>
                            <td>
                                {{ Form::label('new_poe_model', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_poe_model', null, array('class'=>'form-control', 'placeholder'=>'Model')) }}
                            </td>
                            <td>
                                {{ Form::label('new_poe_total', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_poe_total', null, array('class'=>'form-control', 'placeholder'=>'Available Count')) }}
                            </td>
                            <td>{{ Form::submit('Add') }}</td>
                            {{ Form::close() }}
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-heading"><h3 class="panel-title">Connectorized Radios</h3></div>
            <div class="panel-body">
                <table class="table table-striped table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Manufacturer</th>
                            <th>Model</th>
                            <th>Available Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($connectorized_radios as $connectorized_radio)
                        <tr>
                            {{ Form::open(array('route' => array('updateEquipment'), 'class'=>'form-horizontal')) }}
                            <td>
                                {{ Form::label('connectorized_radio_id', null, array('class'=>'sr-only')) }}
                                {{ Form::text('connectorized_radio_id', $connectorized_radio->id, array('class'=>'form-control', 'readonly')) }}
                            </td>
                            <td>
                                {{ Form::label('connectorized_radio_mfg', null, array('class'=>'sr-only')) }}
                                {{ Form::text('connectorized_radio_mfg', $connectorized_radio->mfg, array('class'=>'form-control', 'placeholder'=>'Manufacturer')) }}
                            </td>
                            <td>
                                {{ Form::label('connectorized_radio_model', null, array('class'=>'sr-only')) }}
                                {{ Form::text('connectorized_radio_model', $connectorized_radio->model, array('class'=>'form-control', 'placeholder'=>'Model')) }}
                            </td>
                            <td>
                                {{ Form::label('connectorized_radio_total', null, array('class'=>'sr-only')) }}
                                {{ Form::text('connectorized_radio_total', $connectorized_radio->total, array('class'=>'form-control', 'placeholder'=>'Available Count')) }}
                            </td>
                            <td>{{ Form::submit('Update') }}</td>
                            {{ Form::close() }}
                        </tr>
                        @endforeach
                        <tr>
                            {{ Form::open(array('route' => array('updateEquipment'), 'class'=>'form-horizontal')) }}
                            <td>
                                {{ Form::label('new_connectorized_radio_id', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_connectorized_radio_id', null, array('class'=>'form-control', 'readonly')) }}
                            </td>
                            <td>
                                {{ Form::label('new_connectorized_radio_mfg', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_connectorized_radio_mfg', null, array('class'=>'form-control', 'placeholder'=>'Manufacturer')) }}
                            </td>
                            <td>
                                {{ Form::label('new_connectorized_radio_model', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_connectorized_radio_model', null, array('class'=>'form-control', 'placeholder'=>'Model')) }}
                            </td>
                            <td>
                                {{ Form::label('new_connectorized_radio_total', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_connectorized_radio_total', null, array('class'=>'form-control', 'placeholder'=>'Available Count')) }}
                            </td>
                            <td>{{ Form::submit('Add') }}</td>
                            {{ Form::close() }}
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-heading"><h3 class="panel-title">Integrated Radios</h3></div>
            <div class="panel-body">
                <table class="table table-striped table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Manufacturer</th>
                            <th>Model</th>
                            <th>Available Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($integrated_radios as $integrated_radio)
                        <tr>
                            {{ Form::open(array('route' => array('updateEquipment'), 'class'=>'form-horizontal')) }}
                            <td>
                                {{ Form::label('integrated_radio_id', null, array('class'=>'sr-only')) }}
                                {{ Form::text('integrated_radio_id', $integrated_radio->id, array('class'=>'form-control', 'readonly')) }}
                            </td>
                            <td>
                                {{ Form::label('integrated_radio_mfg', null, array('class'=>'sr-only')) }}
                                {{ Form::text('integrated_radio_mfg', $integrated_radio->mfg, array('class'=>'form-control', 'placeholder'=>'Manufacturer')) }}
                            </td>
                            <td>
                                {{ Form::label('integrated_radio_model', null, array('class'=>'sr-only')) }}
                                {{ Form::text('integrated_radio_model', $integrated_radio->model, array('class'=>'form-control', 'placeholder'=>'Model')) }}
                            </td>
                            <td>
                                {{ Form::label('integrated_radio_total', null, array('class'=>'sr-only')) }}
                                {{ Form::text('integrated_radio_total', $integrated_radio->total, array('class'=>'form-control', 'placeholder'=>'Available Count')) }}
                            </td>
                            <td>{{ Form::submit('Update') }}</td>
                            {{ Form::close() }}
                        </tr>
                        @endforeach
                        <tr>
                            {{ Form::open(array('route' => array('updateEquipment'), 'class'=>'form-horizontal')) }}
                            <td>
                                {{ Form::label('new_integrated_radio_id', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_integrated_radio_id', null, array('class'=>'form-control', 'readonly')) }}
                            </td>
                            <td>
                                {{ Form::label('new_integrated_radio_mfg', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_integrated_radio_mfg', null, array('class'=>'form-control', 'placeholder'=>'Manufacturer')) }}
                            </td>
                            <td>
                                {{ Form::label('new_integrated_radio_model', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_integrated_radio_model', null, array('class'=>'form-control', 'placeholder'=>'Model')) }}
                            </td>
                            <td>
                                {{ Form::label('new_integrated_radio_total', null, array('class'=>'sr-only')) }}
                                {{ Form::text('new_integrated_radio_total', null, array('class'=>'form-control', 'placeholder'=>'Available Count')) }}
                            </td>
                            <td>{{ Form::submit('Add') }}</td>
                            {{ Form::close() }}
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop