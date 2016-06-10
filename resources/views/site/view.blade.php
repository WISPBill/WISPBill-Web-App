@extends('layouts.app')
@section('page-header')
	 <link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('htmlheader_title')
	View Sites
@endsection
@section('modal')
@foreach($sites as $site)
<div class="modal fade  " id="{{$site->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Contacts Associated With {{$site->name}}</h4>
      </div>
      <div class="modal-body" id="modal-body">
      <table id="mtable{{$site->id}}" class="table table-bordered table-striped">
                <thead>
                <tr>
				   
				  <th>Name</th> 
				   <th>Organization</th>
				  <th>Phone</th>
                  <th>Email</th>
				  <th>Address</th> 
				 <th>City</th>
                 <th>Zip</th>
                </tr>
               
                </thead>
                <tbody>
                @foreach($site->contacts as $contact)
            
				       <td>{{ $contact->name}}</td>
				         <td>{{ $contact->organization}}</td>
                 <td>{{ $contact->tel}}</td>
                 <td>{{ $contact->email}}</td>
                 <td>{{ $contact->add}}</td>
                 <td>{{ $contact->city}}</td>
                 <td>{{ $contact->zip}}</td></tr>

                @endforeach
      
              </tbody>
                <tfoot>
                
                 <tr>
				   
				  <th>Name</th> 
				   <th>Organization</th>
				  <th>Phone</th>
                  <th>Email</th>
				  <th>Address</th> 
				 <th>City</th>
                 <th>Zip</th>
                </tr>
                
                </tfoot>
              </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade  " id="note{{$site->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Notes Associated With {{$site->name}}</h4>
      </div>
      <div class="modal-body" id="modal-body">
      <table id="mnotetable{{$site->id}}" class="table table-bordered table-striped">
                <thead>
                <tr>
				   
				  <th>Note</th> 
				   <th>Created By</th>
				  <th>Creation Date</th>
                </tr>
               
                </thead>
                <tbody>
                   @foreach($site->notes as $note)
                <tr>
				       <td>{{ $note->note}}</td>
                 <td>{{$note->creator->name}}</td>
                 <td>{{ date_format($note->created_at, 'n/j/y g:i A')}}</td></tr>

                @endforeach
               
      
              </tbody>
                <tfoot>
                
                 <tr>
				   <th>Note</th> 
				   <th>Created By</th>
				  <th>Creation Date</th>
                </tr>
                </tr>
                
                </tfoot>
              </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection
@section('contentheader_title')
	View Sites
@endsection

@section('main-content')
	<!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
            <h4>We have {{$total}} Sites</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
				  <th>Name</th> 
                    <th>Type</th>
				  <th>Latitude</th> 
				 <th>Longitude</th>
				  	 <th>Contacts</th>
				  	 <th>Notes</th>
                </tr>
                </thead>
                <tbody>
             @foreach($sites as $site)
                 <tr><td>{{ $site->name}}</td>
                 <td style="text-transform: capitalize;">{{ $site->type}}</td>
                 <td>{{ $site->latitude}}</td>
                 <td>{{ $site->longitude}}</td>
                 <td>
		   <button type='button' class='btn btn-block btn-success btn-sm' data-toggle='modal' data-target='#{{$site->id}}'>Show Contacts</button>
		</td>
		    <td>
		   <button type='button' class='btn btn-block btn-success btn-sm' data-toggle='modal' data-target='#note{{$site->id}}'>Show Notes</button>
		</td>
		</tr>
             @endforeach
              </tbody>
                <tfoot>
                <tr>
               <th>Name</th> 
               <th>Type</th>
				  <th>Latitude</th> 
				 <th>Longitude</th>
				 	 <th>Contacts</th>
				 	  <th>Notes</th>
                </tr>
                </tfoot>
              </table>
			
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
  @foreach($sites as $site)
    $(function () {
    $('#mtable{{$site->id}}').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
  $(function () {
    $('#mnotetable{{$site->id}}').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
  @endforeach
</script>
@endsection 