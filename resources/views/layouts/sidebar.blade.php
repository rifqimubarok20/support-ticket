<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

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
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item {{ Request::is('documents') ? 'active' : '' }}">
        <a class="nav-link" href="/documents">
            <i class="fas fa-fw fa-file"></i>
            <span>Product</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item {{ Request::is('projects') ? 'active' : '' }}">
        <a class="nav-link" href="/projects">
            <i class="fa-solid fa-chart-pie"></i>
            <span>Project</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item {{ Request::is('clients') ? 'active' : '' }}">
        <a class="nav-link" href="/clients">
            <i class="fa-brands fa-dropbox"></i>
            <span>Client</span></a>
    </li>

    @can('admin')
        <li class="nav-item {{ Request::is('user') ? 'active' : '' }}">
            <a class="nav-link" href="/user">
                <i class="fas fa-fw fa-users"></i>
                <span>Users</span></a>
        </li>
    @endcan

    <!-- Nav Item - Tables -->
    {{-- <li class="nav-item {{ Request::is('ticket') ? 'active' : '' }}">
        <a class="nav-link" href="/ticket">
            <i class="fas fa-ticket-alt"></i>
            <span>Ticket</span></a>
    </li> --}}
    <li class="nav-item {{ Request::is('ticket') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-ticket-alt"></i>
            <span>Ticket</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('ticket') ? 'active' : '' }}" href="/ticket"><i
                        class="fas fa-ticket-alt mr-2"></i>Ticketing</a>
                <a class="collapse-item {{ Request::is('pengajuan') ? 'active' : '' }}" href="/ticket/pengajuan"><i
                        class="fas fa-tasks mr-2"></i>Pengajuan</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
