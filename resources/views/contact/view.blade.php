@extends('layouts.app')
@section('page-header')
	 <link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('htmlheader_title')
	View Contacts
@endsection
@section('modal')
@foreach($contacts as $contact)
<div class="modal fade  " id="{{$contact->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Notes Associated With {{$contact->name}}</h4>
      </div>
      <div class="modal-body" id="modal-body">
      <table id="mtable{{$contact->id}}" class="table table-bordered table-striped">
                <thead>
                <tr>
				   
				  <th>Note</th> 
				   <th>Created By</th>
				  <th>Creation Date</th>
                </tr>
               
                </thead>
                <tbody>
                   @foreach($contact->notes as $note)
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
	View Contacts
@endsection

@section('main-content')
	<!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
            <h4>We have {{$total}} Contacts</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			     
			
            <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
				
				  <th>Name</th> 
				   <th>Organization</th>
				  <th>Phone</th>
                  <th>Email</th>
				  <th>Address</th> 
				 <th>City</th>
                 <th>Zip</th>
                 <th>View Notes</th>
                </tr>
                </thead>
                <tbody>
             @foreach($contacts as $contact)
                
				 <td>{{ $contact->name}}</td>
				 <td>{{ $contact->organization}}</td>
                 <td>{{ $contact->tel}}</td>
                 <td>{{ $contact->email}}</td>
                 <td>{{ $contact->add}}</td>
                 <td>{{ $contact->city}}</td>
                 <td>{{ $contact->zip}}</td>
                 <td>
		   <button type='button' class='btn btn-block btn-success btn-sm' data-toggle='modal' data-target='#{{$contact->id}}'>View Notes</button>
		</td></tr>
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
                 <th>View Notes</th>
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
  @foreach($contacts as $contact)
    $(function () {
    $('#mtable{{$contact->id}}').DataTable({
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