@extends('main')

@section('title', 'Dashboard')

@section('content')
    @php
        use App\Models\TicketStatus;
    @endphp
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        {{-- <h1 class="h3 mb-0 text-gray-800">
            @foreach ($jml_ticket as $tkt)
                @if (Auth::user()->role === 'programmer')
                    <p>Jumlah tiket client:
                        {{ TicketStatus::where('ticket_id', $tkt->id)->latest()->first()->status === 'on progress' ||TicketStatus::where('ticket_id', $tkt->id)->latest()->first()->status === 'testing'? Auth::user()->tickets_count + 1: Auth::user()->tickets_count }}
                    </p>
                @elseif (Auth::user()->role === 'client')
                    <p>Jumlah tiket programmer:
                        {{ TicketStatus::where('ticket_id', $tkt->id)->latest()->first()->status === 'staging'? Auth::user()->tickets_count + 1: Auth::user()->tickets_count }}
                    </p>
                @endif
            @endforeach
        </h1> --}}
    </div>

    @if (Auth::user()->role == 'admin')
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
                                <i class="fa-solid fa-user-circle fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif (Auth::user()->role == 'client')
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
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

            <div class="col-xl-4 col-md-6 mb-4">
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
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">Ticketing
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    @foreach ($jml_ticket as $tkt)
                                        @if (Auth::user()->role === 'programmer')
                                            {{ TicketStatus::where('ticket_id', $tkt->id)->latest()->first()->status === 'on progress' ||TicketStatus::where('ticket_id', $tkt->id)->latest()->first()->status === 'testing'? Auth::user()->tickets_count + 1: Auth::user()->tickets_count }}
                                        @elseif (Auth::user()->role === 'client')
                                            {{ TicketStatus::where('ticket_id', $tkt->id)->latest()->first()->status === 'staging'? Auth::user()->tickets_count + 1: Auth::user()->tickets_count }}
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-ticket-alt fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="col-xl-6 col-md-6 mb-4 mx-auto">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">Ticketing
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @foreach ($jml_ticket as $tkt)
                                    @if (Auth::user()->role === 'programmer')
                                        {{ TicketStatus::where('ticket_id', $tkt->id)->latest()->first()->status === 'on progress' ||TicketStatus::where('ticket_id', $tkt->id)->latest()->first()->status === 'testing'? Auth::user()->tickets_count + 1: Auth::user()->tickets_count }}
                                    @elseif (Auth::user()->role === 'client')
                                        {{ TicketStatus::where('ticket_id', $tkt->id)->latest()->first()->status === 'staging'? Auth::user()->tickets_count + 1: Auth::user()->tickets_count }}
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-ticket-alt fa-2x text-warning"></i>
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
                    <p align="justify">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Support ticket adalah sistem layanan pelanggan yang digunakan untuk melacak dan mengelola permintaan
                        bantuan atau masalah pelanggan. Dalam sistem ini, pelanggan dapat membuat tiket dengan mengirimkan
                        permintaan bantuan atau masalah yang mereka hadapi, dan tim dukungan dapat memantau dan menangani
                        tiket tersebut sampai selesai. </p>
                    <p align="justify" class="mb-0">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Support ticket biasanya digunakan oleh perusahaan untuk memastikan bahwa permintaan
                        pelanggan diterima dan ditangani dengan efisien dan tepat waktu.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
