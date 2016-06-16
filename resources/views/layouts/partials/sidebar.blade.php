<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/img/userimg/{{ Auth::user()->img }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    
                </div>
            </div>
        @endif


        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-tachometer'></i> <span>Home</span></a></li>
           <li class="treeview">
                <a href="#"><i class='fa fa-user'></i> <span>Lead Management</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/newlead">Create a Lead</a></li>
                    <li><a href="/addleadlocation">Add a Location to a Lead</a></li>
                    <li><a href="/viewlead">View Lead's</a></li>
                    <li><a href="/maplead">Map Lead's</a></li>
                    <li><a href="/addleadaccount">Add an Account to a Lead</a></li>
                    <li><a href="/addleadbilling">Add Billing Info to a Lead</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-location-arrow'></i> <span>Site Management</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="treeview">
          <a href="#"><i class="fa fa-user"></i> <span>Contact Management</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="/newcontact">Create a Contact</a></li>
            <li><a href="/addcontactsite">Add Contact to Site</a></li>
            <li><a href="/viewcontacts">View Contacts</a></li>
            <li><a href="/contact/newnote">Create a Note about a Contact</a></li>
          </ul></li>
                    <li><a href="/newsite">Create a Site</a></li>
                    <li><a href="/editcoverage">Edit Site Coverage</a></li>
                    <li><a href="/mapsites">Map Sites</a></li>
                     <li><a href="/viewsites">View Sites</a></li>
                     <li><a href="/site/newnote">Create a Note about a Site</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
