@extends('layouts.app')

@section('htmlheader_title')
	Add a Network
@endsection

@section('contentheader_title')
	Add a Network
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
              <form role="form" action="/newnetwork"method="post">
                <!-- text input -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                 
            <div class="form-group">
<label>Enter IP Network</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <input name="IP" type="text" class="form-control" data-inputmask="'alias': 'ip'" data-mask required>
                </div>
                <!-- /.input group -->
              </div>
              
                <div class="form-group">
                <label>Enter CIDR (8 thru 32)</label>

                <div class="input-group">
               
                  <input name="CIDR" type="number" class="form-control"  min="8" max="32" required>
                </div>
                <!-- /.input group -->
              </div>

				<div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
     
              </form>
@endsection
@section('page-scripts')
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
<!-- Select2 -->
<script src="{{ asset('/plugins/select2/select2.full.min.js')}}"></script>
<!-- InputMask -->
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    
  });
</script>

@endsection 