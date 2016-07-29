@extends('layouts.app')
@section('page-header')
	 <link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}">
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/dygraph/1.1.1/dygraph-combined.js"></script>
@endsection
@section('htmlheader_title')
	View a Device
@endsection
@section('modal')
@foreach($device->DHCP_Servers as $server)
<div class="modal fade  " id="{{$server->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">IPs Leased from {{$server->name}}</h4>
      </div>
      <div class="modal-body" id="modal-body">
      <table id="mtable{{$server->id}}" class="table table-bordered table-striped">
                <thead>
                <tr>
				   
				  <th>Hostname</th> 
				   <th>IP</th>
				  <th>Mac Address</th>
				  <th>Static</th>
				  <th>Expires</th>
                </tr>
               
                </thead>
                <tbody>
                   @foreach($server->ips as $ip)
                <tr>
				       <td>{{ $ip->name}}</td>
                 <td>{{ $ip->ip}}</td>
                  <td>{{ $ip->mac}}</td>
                  @if ($ip->static == true)
                  <td>Yes</td>
                  <td>NA</td></tr>
                  @else
                  <td>No</td>
                 <td>{{ date_format(new DateTime($ip->expires), 'n/j/y g:i A')}}</td></tr>
                 @endif

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
	View a Device
@endsection
@section('main-content')
<div class="box box-success">
<div class="box-header with-border">
            <h4>Basic Device Info</h4>
            </div>
            <div class="box-body">
            	
            	<span style="float:left; width:40%;">
            		<h4>Device Manufacturer:</h4>
            		<h4>{{$device->manufacturer}}</h4>
            		<h4>Device Model:</h4>
            		<h4>{{$device->model}} {{$device->revision or ''}}</h4>
            		<h4>Device Type:</h4>
            		<h4>{{$device->type or 'Not Available'}}</h4>
            		<h4>Management Interface:</h4>
            		<h4><a href="{{$webaddress}}">{{$webaddress}}</a></h4>
            		@if($device->type == 'Radio')
            		<h4>Radio Frequency:</h4>
            		<h4>{{$frequency}}</h4>
            		<h4>TX Power:</h4>
            		<h4>{{$txpower}}</h4>
            		@endif
            		
            	</span>
            	
            	 <img src="{{$image}}" class="img-responsive" alt="Device" style="float:right; width:52%;">

            	</div>
            	</div>
            	
            	@if($device->type == 'Router')
            	
            	<div class="box box-danger">
<div class="box-header with-border">
            <h4>DHCP Server's</h4>
            </div>
            <div class="box-body">
            	
            	<table id="table2" class="table table-bordered table-striped">
                <thead>
                <tr>
				  <th>Name</th> 
				   <th>Subnet</th>
				  <th>Pool Start</th>
                  <th>Pool End</th>
				  <th>Gateway</th> 
				 <th>DNS 1</th>
				 <th>DNS 2</th>
                 <th>Leased</th>
                 <th>Leases</th>
                </tr>
                </thead>
                <tbody>
             @foreach($device->DHCP_Servers as $server)
                <tr>
				       <td>{{ $server->name}}</td>
			        	<td>{{ $server->subnet}}</td>
                <td>{{ $server->start}}</td>
			        	<td>{{ $server->stop}}</td>
                 <td>{{ $server->router}}</td>
				          <td>{{ $server->dns1}}</td>
                <td>{{ $server->dns2 or 'Not Set'}}</td>
				        <td>{{ $server->leased}}</td>
                 <td>
		   <button type='button' class='btn btn-block btn-success btn-sm' data-toggle='modal' data-target='#{{$server->id}}'>View Leases</button>
		</td></tr>
             @endforeach
              </tbody>
                <tfoot>
                <tr>
				  <th>Name</th> 
				   <th>Subnet</th>
				  <th>Pool Start</th>
                  <th>Pool End</th>
				  <th>Gateway</th> 
				 <th>DNS 1</th>
				 <th>DNS 2</th>
                 <th>Leased</th>
                 <th>Leases</th>
                </tr>
               
                </tfoot>
              </table>

            	</div>
            	</div>
            	
            	@elseif ($device->type == 'Radio')
            	
            		<div class="box" style="padding-bottom: 2em;">
                <div class="box-header with-border">
            <h4>Signal</h4>
            <p>Zoom: click-drag, Pan: shift-click-drag, Restore: double-click</p>
            </div>
            <div class="box-body" id="signalgraphdiv{{$device->id}}" style="height:300px;">

            	</div>
            	</div>
            	
            	<div class="box" style="padding-bottom: 2em;">
                <div class="box-header with-border">
            <h4>Noise</h4>
            <p>Zoom: click-drag, Pan: shift-click-drag, Restore: double-click</p>
            </div>
            <div class="box-body" id="noisegraphdiv{{$device->id}}" style="height:300px;">

            	</div>
            	</div>
            	
            		<div class="box" style="padding-bottom: 2em;">
                <div class="box-header with-border">
            <h4>CCQ</h4>
            <p>Zoom: click-drag, Pan: shift-click-drag, Restore: double-click</p>
            </div>
            <div class="box-body" id="ccqgraphdiv{{$device->id}}" style="height:300px;">

            	</div>
            	</div>
            	
            	<div class="box" style="padding-bottom: 2em;">
                <div class="box-header with-border">
            <h4>Latency	</h4>
            <p>Zoom: click-drag, Pan: shift-click-drag, Restore: double-click</p>
            </div>
            <div class="box-body" id="latencygraphdiv{{$device->id}}" style="height:300px;">

            	</div>
            	</div>
            	
            	@else
            	
            	@endif
            	
            	<div class="box box-warning" >
<div class="box-header with-border">
            <h4>Device Ports</h4>
            </div>
            <div class="box-body">
 <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr><th>Description</th>
				  <th>Name</th> 
				  <th>Mac Address</th> 
				  <th>IP Address</th> 
                </tr>
                </thead>
                <tbody>
             @foreach($device->ports as $port)
                 <tr><td>{{ $port->readable_name or 'Not Set'}}</td>
                             <td>{{ $port->name}}</td>
                 <td>{{ $port->mac}}</td>
                 <td>
                 @foreach($port->ips as $ip)
                 {{ $ip->address}}
                 @break
                 @endforeach
                 </td>
                        </tr>
             @endforeach
              </tbody>
                <tfoot>
                <tr><th>Description</th>
                 	  <th>Name</th> 
		<th>Mac Address</th> 
		 <th>IP Address</th> 
                </tr>
                </tfoot>
              </table>

            	</div>
            	</div>
            	
            	@foreach($device->ports as $port)
            	
            	<div class="box" style="padding-bottom: 2em;">
<div class="box-header with-border">
            <h4>{{$port->name}} Utilization in Mbps</h4>
            <p>Zoom: click-drag, Pan: shift-click-drag, Restore: double-click</p>
            </div>
            <div class="box-body" id="graphdiv{{$port->id}}" style="height:300px;">

            	</div>
            	</div>
            	
            	@endforeach
@endsection
@section('page-scripts')
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
  
    $(function () {
    $('#table2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
    @foreach($device->DHCP_Servers as $server)
    $(function () {
    $('#mtable{{$server->id}}').DataTable({
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
@foreach($device->ports as $port)
<script type="text/javascript">
  g3 = new Dygraph(
    document.getElementById("graphdiv{{$port->id}}"),
    
    "/portdata/{{$port->id}}/{{$formatted_date}}/data.csv",
    
    {
      rollPeriod: 7,
      showRoller: false
    }
  );
</script>
@endforeach
@if($device->type == 'Radio')
<script type="text/javascript">
  g3 = new Dygraph(
    document.getElementById("signalgraphdiv{{$device->id}}"),
    
    "/radiodata/{{$device->id}}/{{$formatted_date}}/signal/data.csv",
    
    {
      rollPeriod: 7,
      showRoller: false
    }
  );
  
    g3 = new Dygraph(
    document.getElementById("noisegraphdiv{{$device->id}}"),
    
    "/radiodata/{{$device->id}}/{{$formatted_date}}/noise/data.csv",
    
    {
      rollPeriod: 7,
      showRoller: false
    }
  );
  
  g3 = new Dygraph(
    document.getElementById("ccqgraphdiv{{$device->id}}"),
    
    "/radiodata/{{$device->id}}/{{$formatted_date}}/ccq/data.csv",
    
    {
      rollPeriod: 7,
      showRoller: false
    }
  );
  
    g3 = new Dygraph(
    document.getElementById("latencygraphdiv{{$device->id}}"),
    
    "/radiodata/{{$device->id}}/{{$formatted_date}}/latency/data.csv",
    
    {
      rollPeriod: 7,
      showRoller: false
    }
  );
</script>
@endif
@endsection 