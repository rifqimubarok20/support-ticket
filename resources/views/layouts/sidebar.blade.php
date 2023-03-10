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


    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'client')
        <!-- Nav Item - Tables -->
        <li class="nav-item {{ Request::is('products') ? 'active' : '' }}">
            <a class="nav-link" href="/products">
                <i class="fas fa-fw fa-file"></i>
                <span>Product</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item {{ Request::is('projects') ? 'active' : '' }}">
            <a class="nav-link" href="/projects">
                <i class="fa-solid fa-chart-pie"></i>
                <span>Project</span></a>
        </li>
    @endif

    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'programmer')
        <!-- Nav Item - Tables -->
        <li class="nav-item {{ Request::is('clients') ? 'active' : '' }}">
            <a class="nav-link" href="/clients">
                <i class="fa-brands fa-dropbox"></i>
                <span>Client</span></a>
        </li>
    @endif

    <!-- Nav Item - Tables -->
    <li class="nav-item {{ Request::is('ticket') ? 'active' : '' }}">
        <a class="nav-link" href="/ticket">
            <i class="fas fa-ticket-alt"></i>
            <span>Ticket</span></a>
    </li>

    @can('admin')
        <li class="nav-item {{ Request::is('user') ? 'active' : '' }}">
            <a class="nav-link" href="/user">
                <i class="fas fa-fw fa-users"></i>
                <span>Users</span></a>
        </li>
    @endcan

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
