@extends('layouts.app')

@section('htmlheader_title')
	Create Plan
@endsection

@section('contentheader_title')
	Create A Plan
@endsection

@section('main-content')
	<!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
              <form role="form" action="/newplan" method="post">
                <!-- text input -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
				  
				  
                <div class="form-group">
					<label>Plan Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                </div>
      
                  <div class="form-group">
                  <label>Billing Frequency</label>
					
                  <select class="form-control"  name='frequency' required>
					<option value='' selected disabled>Please Select an Option</option>
                <option value='day'>Daily</option>
                <option value='week'>Weekly</option>
                <option value='month'>Monthly</option>
                <option value='year'>Yearly</option>
                  </select>
                </div>
                
                <div class="form-group">
					<label>Plan Price</label>
                  <input type="number" class="form-control" name="price" placeholder="Enter Price" min="0" required>
                </div>
                
                @if($speed == true)
                <input type="hidden" name="speed" value="true">
                <div class="form-group">
					<label>Max Upload Speed Mbps</label>
                  <input type="number" class="form-control" name="uploadrate" placeholder="Enter Upload Speed in Mbps" min="0" required>
                </div>
                <div class="form-group">
					<label>Max Download Speed Mbps</label>
                  <input type="number" class="form-control" name="downloadrate" placeholder="Enter Download Speed in Mbps" min="0" required>
                </div>
                @elseif($speed == false)
                <input type="hidden" name="speed" value="false">
                @else
                 
                @endif
                
                 @if($data == true)
                <input type="hidden" name="data" value="true">
                <div class="form-group">
					<label>Upload Cap in Gigabytes</label>
                  <input type="number" class="form-control" name="upload" placeholder="Enter Max Upload in GB" min="0" required>
                </div>
                <div class="form-group">
					<label>Download Cap in Gigabytes</label>
                  <input type="number" class="form-control" name="download" placeholder="Enter Max Download in GB" min="0" required>
                </div>
                @elseif($data == false)
                <input type="hidden" name="data" value="false">
                @else
                 
                @endif
                
                 @if($burst == true)
                <input type="hidden" name="burst" value="true">
                <h1>Bursting not Supported</h1>
                @elseif($burst == false)
                <input type="hidden" name="burst" value="false">
                @else
                 
                @endif

				<div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
     
              </form>
@endsection