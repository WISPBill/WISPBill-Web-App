@extends('layouts.app')

@section('htmlheader_title')
	Create Lead
@endsection

@section('contentheader_title')
	Create A Lead
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
              <form role="form" action="/newlead"method="post">
                <!-- text input -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
				  <div class="form-group">
                  <label>Lead Type</label>
                  <select class="form-control"  name='type' required>
					<option value='' selected disabled>Please Select an Option</option>
                <option value='residential'>Residential</option>
                <option value='business'>Business</option>
                  </select>
                </div>
				  
                <div class="form-group">
					<label>Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                </div>
                             
               <div class="form-group">
               <label>Email</label>
                  
                  <input type="text" class="form-control" name="email" placeholder="Enter Email" required>
                </div>
               
               <div class="form-group">
                <label>Telephone Number</label>
                   
                  <input type="text" class="form-control" name="tel" placeholder="Enter Telephone Number 000-000-0000" required>
                   
                   </div>
               <div class="form-group">
              <label>Street Address</label>
                  
                  <input type="text" class="form-control" name="add" placeholder="Enter Street Address" required>
                </div>
               <div class="form-group">
                <label>City</label>
                  
                  <input type="text" class="form-control" name="city" placeholder="Enter City" required>
                </div>
               <div class="form-group">
               <label>Zip Code</label>
                  
                  <input type="text" class="form-control" name="zip" placeholder="Enter Street Address" required>
                </div>
               <div class="form-group">
                <label>State</label>
                  
                  <input type="text" class="form-control" name="state" placeholder="Enter State"required>
                </div>
			                 
                  <div class="form-group">
                  <label>Lead Source</label>
					
                  <select class="form-control"  name='source' required>
					<option value='' selected disabled>Please Select an Option</option>
                <option value='tel'>Phone Call</option>
                <option value='friend'>Referred by a Friend</option>
                <option value='d2d'>Door to Door</option>
                <option value='email'>Email</option>
                <option value='booth'>Show Booth</option>
                <option value='other'>Other</option>
                  </select>
                </div>

				<div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
     
              </form>
@endsection