@extends('layout')

@section('sidebar')

<label class="btn btn-default col-sm-12" for="btn1_input">Add</label>

@stop

@section('content')
<div class="row top-row"></div>



{{ Form::open(array('route' => 'userAdd', 'class'=>'form-horizontal')) }}
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
            {{ Form::select('payment_type_id', $payment_type_list->toArray(), null, array('class'=>'form-control')) }}
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
<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">New Service Location</h3></div>
        <div class="panel-body">
            <div class="col-sm-6">
                <div class="form-group">
                    {{ Form::label('new_active', 'Active:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-1 checkbox">
                        {{ Form::checkbox('new_active', '1', '1') }}
                    </div>
                    {{ Form::label('new_blocked', 'Blocked:', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-1 checkbox">
                        {{ Form::checkbox('new_blocked', '1', '0') }}
                    </div>
                    {{ Form::label('new_main_location', 'Same location as billing:', array('class'=>'col-sm-4 control-label')) }}
                    <div class="col-sm-1 checkbox">
                        {{ Form::checkbox('new_main_location', 'true', 'true') }}
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
                        {{ Form::select('new_service', ([''=>''] + $service_list->toArray()), '', array('class'=>'form-control')) }}
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
        </div>
    </div>
</div>
<input type="submit" name="btn1_input" id="btn1_input" class="hidden" />
<!-- <input type="submit" name="operation" id="btn1_input" onClick="document.pressed = this.value" value="update" class="hidden"> -->
{{ Form::close() }}
@stop
