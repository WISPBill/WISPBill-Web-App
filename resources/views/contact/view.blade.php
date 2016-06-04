@extends('layouts.app')
@section('page-header')
	 <link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('htmlheader_title')
	View Contacts
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