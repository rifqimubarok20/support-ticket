<!-- Sidebar -->
@if (Auth::user()->role == 'admin')
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    @elseif (Auth::user()->role == 'programmer')
        <ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">
        @else
            <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
@endif

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-headset"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Support Ticket</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
    <a class="nav-link" href="/dashboard">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider mb-2">

<li class="nav-item {{ Request::is('ticket*') ? 'active' : '' }}">
    <a class="nav-link" href="/ticket">
        <i class="fas fa-fw fa-ticket-alt"></i>
        <span>Ticketing</span></a>
</li>
{{-- <li class="nav-item {{ Request::is('reporting') ? 'active' : '' }}">
    <a class="nav-link" href="/reporting">
        <i class="fas fa-fw fa-chart-line"></i>
        <span>Reporting</span></a>
</li> --}}

@if (Auth::user()->role == 'admin' || Auth::user()->role == 'client')
    <li class="nav-item {{ Request::is('products*', 'projects*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data Management</span>
        </a>
        <div id="collapseOne" class="collapse {{ Request::is('products*', 'projects*') ? 'show' : '' }}"
            aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Management:</h6>
                <a class="collapse-item {{ Request::is('products*') ? 'active' : '' }}" href="/products">Products</a>
                <a class="collapse-item {{ Request::is('projects*') ? 'active' : '' }}" href="/projects">Projects</a>
                {{-- <a class="collapse-item {{ Request::is('servicelevelagreement') ? 'active' : '' }}"
                    href="/servicelevelagreement">Service Level Agreement</a> --}}
            </div>
        </div>
    </li>
@endif

@can('admin')
    <li class="nav-item {{ Request::is('user*', 'clients*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-users"></i>
            <span>User Management</span>
        </a>
        <div id="collapseTwo" class="collapse {{ Request::is('user*', 'clients*') ? 'show' : '' }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">User Management:</h6>
                <a class="collapse-item {{ Request::is('user*') ? 'active' : '' }}" href="/user">Users</a>
                <a class="collapse-item {{ Request::is('clients*') ? 'active' : '' }}" href="/clients">Perusahaan Client</a>
            </div>
        </div>
    </li>

    {{-- <li class="nav-item {{ Request::is('activity-log') ? 'active' : '' }}">
        <a class="nav-link" href="/activity-log">
            <i class="fas fa-fw fa-chart-pie"></i>
            <span>Activity Log</span></a>
    </li> --}}
@endcan

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->
