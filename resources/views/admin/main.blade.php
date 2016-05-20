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
			<h4>Stipe API Keys</h4>
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
@endsection