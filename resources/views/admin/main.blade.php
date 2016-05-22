@extends('layouts.app')

@section('htmlheader_title')
	Settings
@endsection

@section('contentheader_title')
	Settings
@endsection

@section('main-content')
	<!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
			<h4>Stipe API Keys</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if (count($errors->get('publishable')) > 0 or count($errors->get('secret')) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->get('publishable') as $error)
                <li>{{ $error }}</li>
            @endforeach
			
			 @foreach ($errors->get('secret') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
              <form role="form" action="/setstripekey"method="post">
                <!-- text input -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
				
				  
                <div class="form-group">
					<label>Publishable Key</label>
                  <input type="text" class="form-control" name="publishable" placeholder="Enter Publishable Key" required>
                </div>
               
               <div class="form-group">
              <label>Secret Key</label>
                  
                  <input type="text" class="form-control" name="secret" placeholder="Enter Secret Key" required>
                </div>

				<div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
     
              </form>
			</div>
		  </div>
			
			          <div class="box box-success">
            <div class="box-header with-border">
			<h4>Geocoder</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if (count($errors->get('service')) > 0 or count($errors->get('api')) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->get('service') as $error)
                <li>{{ $error }}</li>
            @endforeach
			
			 @foreach ($errors->get('api') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
              <form role="form" action="/setgeocoder"method="post">
                <!-- text input -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
				
				  
                <div class="form-group">
					<label>Geocoding Service</label>
                    <select class="form-control" name="service" required>
					<option value='' selected disabled>Please Select a Service</option>
                    <option value="mapzen">Mapzen Search</option>
					</select>
                </div>
               
               <div class="form-group">
              <label>API Key</label>
                  
                  <input type="text" class="form-control" name="api" placeholder="Enter API Key">
                </div>

				<div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
     
              </form>
			</div>
		  </div>
@endsection