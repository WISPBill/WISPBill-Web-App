@extends('layout')

@section('sidebar')
<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#deviceModal">New Device</button>
<button type="button" class="btn btn-info btn-lg pull-right" data-toggle="modal" data-target="#locationModal">New Location</button>
<label class="btn btn-default col-sm-12" for="updateUser">Update</label>
<label class="btn btn-default col-sm-12" for="btn2_input">Delete</label>

<div id="uptime"></div>
@stop

@section('content')
<div class="row top-row"></div>

{{ Form::model($user, array('route' => array('userUpdate', 'id'=>$user->id), 'class'=>'form-horizontal')) }}
<div class="col-sm-12"><h2>Billing Information</h2></div>
<div class="col-sm-6">
    <div class="form-group">
        {{ Form::label('id', 'User#', array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-10">
            {{ Form::text('id', null, array('class'=>'form-control','readonly')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('first_name', 'First Name:', array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-10">
            {{ Form::text('first_name', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('last_name', 'Last Name:', array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-10">
            {{ Form::text('last_name', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('business_name', 'Business:', array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-10">
            {{ Form::text('business_name', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('email', 'Email:', array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-10">
            {{ Form::email('email', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('phone_1', 'Phone:', array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-4">
            {{ Form::text('phone_1', null, array('class'=>'form-control')) }}
        </div>
        {{ Form::label('phone_2', 'Phone:', array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-4">
            {{ Form::text('phone_2', null, array('class'=>'form-control')) }}
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="form-group">
        {{ Form::label('payment_type_id', 'Pay Type:', array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-10">
            {{ Form::select('payment_type_id', $payment_type_list, $user->payment_type_id, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('billing_street_address_1', 'Address:', array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-10">
            {{ Form::text('billing_street_address_1', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('billing_street_address_2', 'Address:', array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-10">
            {{ Form::text('billing_street_address_2', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('billing_city', 'City:', array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-10">
            {{ Form::text('billing_city', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('billing_state', 'State:', array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-4">
            {{ Form::text('billing_state', null, array('class'=>'form-control', 'size'=>'2')) }}
        </div>
        {{ Form::label('billing_zip', 'Zip:', array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-4">
            {{ Form::text('billing_zip', null, array('class'=>'form-control', 'size'=>'5')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('notes', 'Notes:', array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-10">
            {{ Form::textArea('notes', null, array('class'=>'form-control', 'rows'=>'5')) }}
        </div>
    </div>
</div>
<div class="col-sm-12"><h2>Services</h2></div>
@for ($i = 0; $i < $service_locations->count(); $i++)
<div class="col-sm-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">
                @if ($i == 0)
                Main Service
                @else
                Additional Service {{ $i }}
                @endif
            </h3>
        </div>
        <div class="panel-body">
            <div class="col-sm-6">
                <div class="form-group">
                    {{ Form::label($i.'active', 'Active:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-1 checkbox">
                        {{ Form::checkbox($i.'active', '1', $service_locations[$i]->active) }}
                    </div>
                    {{ Form::label($i.'blocked', 'Blocked:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-1 checkbox">
                        {{ Form::checkbox($i.'blocked', '1', $service_locations[$i]->blocked) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label($i.'business_name', 'Business:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-10">
                        {{ Form::text($i.'business_name', $service_locations[$i]->business_name, array('class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label($i.'street_address_1', 'Address:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-10">
                        {{ Form::text($i.'street_address_1', $service_locations[$i]->street_address_1, array('class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label($i.'street_address_2', 'Address:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-10">
                        {{ Form::text($i.'street_address_2', $service_locations[$i]->street_address_2, array('class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label($i.'city', 'City:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-10">
                        {{ Form::text($i.'city', $service_locations[$i]->city, array('class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label($i.'state', 'State:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-4">
                        {{ Form::text($i.'state', $service_locations[$i]->state, array('class'=>'form-control', 'size'=>'2')) }}
                    </div>
                    {{ Form::label($i.'zip', 'Zip:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-4">
                        {{ Form::text($i.'zip', $service_locations[$i]->zip, array('class'=>'form-control', 'size'=>'5')) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {{ Form::label($i.'company', 'Company:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-4">
                        {{ Form::select($i.'company', $company_list, $service_locations[$i]->company_id, array('class'=>'form-control')) }}
                    </div>
                    {{ Form::label($i.'service', 'Service:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-4">
                        {{ Form::select($i.'service', $service_list, $service_locations[$i]->service_id, ['optional' => ''], array('class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label($i.'install_date', 'Install Date:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-4">
                        {{ Form::date($i.'install_date', $service_locations[$i]->install_date, array('class'=>'form-control')) }}
                    </div>
                    {{ Form::label($i.'termination_date', 'Termination Date:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-4">
                        {{ Form::input('date', $i.'termination_date', $service_locations[$i]->termination_date, array('class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label($i.'notes', 'Notes:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-10">
                        {{ Form::textArea($i.'notes', $service_locations[$i]->notes, array('class'=>'form-control', 'rows'=>'5')) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endfor
<!-- Modal -->
<div class="modal fade" id="locationModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Service Location</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {{ Form::label('new_active', 'Active:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-1 checkbox">
                        {{ Form::checkbox('new_active', '1', '0') }}
                    </div>
                    {{ Form::label('new_blocked', 'Blocked:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-1 checkbox">
                        {{ Form::checkbox('new_blocked', '1', '0') }}
                    </div>
                    {{ Form::label('new_main_location', 'Same location as billing:', array('class'=>'col-sm-4 control-label')) }}
                    <div class="col-sm-1 checkbox">
                        {{ Form::checkbox('new_main_location', 'true') }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('new_business_name', 'Business:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-10">
                        {{ Form::text('new_business_name', null, array('class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('new_street_address_1', 'Address:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-10">
                        {{ Form::text('new_street_address_1', null, array('class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('new_street_address_2', 'Address:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-10">
                        {{ Form::text('new_street_address_2', null, array('class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('new_city', 'City:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-10">
                        {{ Form::text('new_city', null, array('class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('new_state', 'State:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-4">
                        {{ Form::text('new_state', null, array('class'=>'form-control', 'size'=>'2')) }}
                    </div>
                    {{ Form::label('new_zip', 'Zip:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-4">
                        {{ Form::text('new_zip', null, array('class'=>'form-control', 'size'=>'5')) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {{ Form::label('new_company', 'Company:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-4">
                        {{ Form::select('new_company', $company_list, "1", array('class'=>'form-control')) }}
                    </div>
                    {{ Form::label('new_service', 'Service:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-4">
                        {{ Form::select('new_service', ([''=>''] + $service_list->toArray()), null, array('class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('new_install_date', 'Install Date:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-4">
                        {{ Form::input('date', 'new_install_date', null, array('class'=>'form-control')) }}
                    </div>
                    {{ Form::label('new_termination_date', 'Termination Date:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-4">
                        {{ Form::input('date', 'new_termination_date', null, array('class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('new_notes', 'Notes:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-10">
                        {{ Form::textArea('new_notes', null, array('class'=>'form-control', 'rows'=>'5')) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <label class="btn btn-default col-sm-12" for="userUpdate">Update</label>
            </div>
        </div>

    </div>
</div>
<input type="submit" name="updateUser" id="updateUser" class="hidden" />
{{ Form::close() }}

<div class="col-sm-12"><h2>Equipment Information</h2></div>
@for ($i = 0; $i < $devices->count(); $i++)

<div class="col-sm-6">
    <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">Device {{ $i+1 }}</h3></div>
        {{ Form::open(array('route' => array('deviceUpdate', 'id'=>$user->id), 'class'=>'form-horizontal')) }}
        {{ Form::hidden('device_id', $devices[$i]->id) }}
        {{ Form::hidden('current_ip', key($currentIps[$i])) }}
        <div class="panel-body">
            <div class="form-group">
                {{ Form::label('device_location', 'Location:', array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-10">
                    {{ Form::select('device_location', $device_location_list, $devices[$i]->service_location_id, array('class'=>'form-control')) }}
                </div>
                {{ Form::label('ip', 'IP:', array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::select('ip', ($currentIps[$i] + [''=>'']), $currentIps[$i], array('class'=>'form-control')) }}
                </div>
                {{ Form::label('mac_address', 'Mac:', array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::text('mac_address', $devices[$i]->mac_address, array('class'=>'form-control')) }}
                </div>
                {{ Form::label('integrated_radio', 'Integrated:', array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::select('integrated_radio', ([''=>''] + $integrated_radio_list->toArray()), $devices[$i]->integrated_radio_id, array('class'=>'form-control')) }}
                </div>
                {{ Form::label('poe', 'POE:', array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::select('poe', ([''=>''] + $poe_list->toArray()), $devices[$i]->poe_id, array('class'=>'form-control')) }}
                </div>
                {{ Form::label('connectorized_radio', 'Connectorized:', array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::select('onnectorized_radio', ([''=>''] + $connectorized_radio_list->toArray()), $devices[$i]->connectorized_radio_id, array('class'=>'form-control')) }}
                </div>
                {{ Form::label('antenna', 'Antenna:', array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::select('antenna', ([''=>''] + $antenna_list->toArray()), $devices[$i]->antenna_id, array('class'=>'form-control')) }}
                </div>
                {{ Form::label('router', 'Router:', array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::select('router', ([''=>''] + $router_list->toArray()), $devices[$i]->router_id, array('class'=>'form-control')) }}
                </div>
                {{ Form::label('radio_card', 'Radio Card:', array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::select('radio_card', ([''=>''] + $radio_card_list->toArray()), $devices[$i]->radio_card_id, array('class'=>'form-control')) }}
                </div>
                {{ Form::label('device_notes', 'Notes:', array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-10">
                    {{ Form::textArea('device_notes', $devices[$i]->notes, array('class'=>'form-control', 'rows'=>'5')) }}
                </div>
            </div>
            <div class="pull-right">{{ Form::submit('Update') }}</div>
        </div>
        {{ Form::close() }}
    </div>
</div>

@endfor

<!-- Modal -->
{{ Form::model($user, array('route' => array('deviceNew', 'id'=>$user->id), 'class'=>'form-horizontal')) }}
<div class="modal fade" id="deviceModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Device</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {{ Form::label('new_device_location', 'Location:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-10">
                        {{ Form::select('new_device_location', ([''=>''] + $device_location_list->toArray()), null, array('class'=>'form-control')) }}
                    </div>
                    {{ Form::label('new_ip', 'IP:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-4">
                        {{ Form::select('new_ip', [''=>''], null, array('class'=>'form-control')) }}
                    </div>
                    {{ Form::label('new_mac_address', 'Mac:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-4">
                        {{ Form::text('new_mac_address', null, array('class'=>'form-control')) }}
                    </div>
                    {{ Form::label('new_integrated_radio', 'Integrated:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-4">
                        {{ Form::select('new_integrated_radio', ([''=>''] + $integrated_radio_list->toArray()), null, array('class'=>'form-control')) }}
                    </div>
                    {{ Form::label('new_poe', 'POE:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-4">
                        {{ Form::select('new_poe', ([''=>''] + $poe_list->toArray()), null, array('class'=>'form-control')) }}
                    </div>
                    {{ Form::label('new_connectorized_radio', 'Connectorized:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-4">
                        {{ Form::select('new_connectorized_radio', ([''=>''] + $connectorized_radio_list->toArray()), null, array('class'=>'form-control')) }}
                    </div>
                    {{ Form::label('new_antenna', 'Antenna:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-4">
                        {{ Form::select('new_antenna', ([''=>''] + $antenna_list->toArray()), null, array('class'=>'form-control')) }}
                    </div>
                    {{ Form::label('new_router', 'Router:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-4">
                        {{ Form::select('new_router', ([''=>''] + $router_list->toArray()), null, array('class'=>'form-control')) }}
                    </div>
                    {{ Form::label('new_radio_card', 'Radio Card:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-4">
                        {{ Form::select('new_radio_card', ([''=>''] + $radio_card_list->toArray()), null, array('class'=>'form-control')) }}
                    </div>
                    {{ Form::label('new_device_notes', 'Notes:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-10">
                        {{ Form::textArea('new_device_notes', null, array('class'=>'form-control', 'rows'=>'5')) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <label class="btn btn-default col-sm-12" for="newDevice">Update</label>
            </div>
        </div>

    </div>
</div>
<input type="submit" name="newDevice" id="newDevice" class="hidden" />
{{ Form::close() }}



<!-- <input type="submit" name="operation" id="btn1_input" onClick="document.pressed = this.value" value="update" class="hidden"> -->
<!-- <input type="submit" name="operation" id="btn2_input" onClick="document.pressed = this.value" value="delete" class="hidden"> -->


@stop
@section ('footer')
@stop
