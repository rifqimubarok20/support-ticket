@extends('main')

@section('title', 'Dashboard')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'client')
        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                                    Client</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jml_client->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm font-weight-bold text-success text-uppercase mb-1">
                                    Product</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jml_product->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-brands fa-dropbox fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm font-weight-bold text-info text-uppercase mb-1">Project
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jml_project->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-chart-pie fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (Auth::user()->role == 'admin')
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">Users
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jml_user->count() }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-users fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">Ticketing
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jml_ticket->count() }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-ticket-alt fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @else
        <div class="row">
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                                    Client</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jml_client->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">Ticketing
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jml_ticket->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-ticket-alt fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-center">Support Ticket</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center rotate-n-15 mb-3">
                        {{-- <img class="img-profile rounded-circle justify-content-center" width="10%"
                            src="{{ asset('temp') }}/img/undraw_profile.svg"> --}}
                        <i class="fas fa-headset fa-4x text-primary"></i>
                    </div>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste eveniet optio soluta impedit
                        dolorum. Corporis impedit perspiciatis, voluptatem natus vel doloremque sequi praesentium
                        quod a odit, quia ex illo officiis fugiat, animi vero rem est expedita tenetur eos ratione
                        nulla nisi iure molestias? At fugiat reprehenderit temporibus. Vel, alias vitae.</p>
                    <p class="mb-0">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Autem voluptate
                        itaque repudiandae rem enim deleniti, quae optio magnam dignissimos, molestias, inventore
                        nam iusto iste sit. Maiores id inventore doloremque? Numquam?</p>
                </div>
            </div>
        </div>
    </div>
@endsection
