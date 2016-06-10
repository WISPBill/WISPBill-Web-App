@extends('layouts.app')
@section('page-header')
	 <link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('htmlheader_title')
	Add a note to a Site
@endsection

@section('contentheader_title')
	Add a note to a Site
@endsection

@section('main-content')
	<!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
            <h4>Select a Site to Create a Note</h4>
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
			<form role="form" action="/site/newnote"method="post">
                <!-- text input -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
               
             <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
                	<th>Select</th>
				  <th>Name</th> 
                    <th>Type</th>
				  <th>Latitude</th> 
				 <th>Longitude</th>
                </tr>
                </thead>
                <tbody>
             @foreach($sites as $site)
                 <tr><td><input type='radio' name='siteid' value='{{$site->id}}' unchecked></td>
                 	<td>{{ $site->name}}</td>
                 <td style="text-transform: capitalize;">{{ $site->type}}</td>
                 <td>{{ $site->latitude}}</td>
                 <td>{{ $site->longitude}}</td>
             @endforeach
              </tbody>
                <tfoot>
                <tr>
                	<th>Select</th>
               <th>Name</th> 
               <th>Type</th>
				  <th>Latitude</th> 
				 <th>Longitude</th>
                </tr>
                </tfoot>
              </table>
              <br></br>
        <div class="form-group">
               <label>Note</label>
			
                  <textarea class="form-control" rows="5" placeholder="Enter your note" name="note"></textarea>
                </div>
				<div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
     
              </form>
            <!-- /.box-body -->
          </div>
               </div>
@endsection
@section('page-scripts')
    {{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}
<script src="{{ asset ('/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset ('/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

<script>
  $(function () {
    $('#table').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
</script>
@endsection 