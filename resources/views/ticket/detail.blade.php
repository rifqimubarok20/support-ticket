@extends('main')

@section('title', 'Detail Tikcket')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><strong>Ticket /</strong> Detail Ticket</h1>
    </div>

    <a href="/ticket" class="btn btn-sm btn-danger" style="margin-bottom: 10px;"><i class="fa fa-arrow-left"></i>
        Kembali</a>

    <div class="container pl-0 pr-5">
        <div class="row justify-content-between">
            <div class="card shadow col-lg-7 mb-4 d-flex justify-content-start">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Ticket</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <p><b>Product</b></p>
                        </div>
                        <div class="col-lg-9">
                            {{ $ticket->product->nama }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <p><b>Client</b></p>
                        </div>
                        <div class="col-lg-9">
                            {{ $ticket->client->name }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <p><b>Issue</b></p>
                        </div>
                        <div class="col-lg-9">
                            {!! $ticket->issue !!}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <p><b>File Dokumen</b></p>
                        </div>
                        <div class="col-lg-9">
                            <a href="/ticket/download/{{ $ticket->id }}" class="btn btn-primary btn-sm"><i
                                    class="fas fa-download"></i> Download</a>
                            <a href="{{ asset('storage/' . $ticket->file) }}" class="btn btn-info btn-sm" target="_blank"><i
                                    class="fas fa-eye"></i> View</a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <p><b>Status</b></p>
                        </div>
                        <div class="col-lg-9">
                            <span style="font-size: 14px"
                                class="badge p-2 {{ $ticket->ticketStatus->status == 'to do' ? 'badge-secondary' : ($ticket->ticketStatus->status == 'on progress' ? 'badge-warning' : ($ticket->ticketStatus->status == 'testing' ? 'badge-info' : ($ticket->ticketStatus->status == 'staging' ? 'badge-primary' : ($ticket->ticketStatus->status == 'done' ? 'badge-success' : '')))) }}">
                                {{ ucfirst($ticket->ticketStatus->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @can('admin')
                <div class="card shadow col-lg-4 mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Programmer</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-lg-5">
                                <p><b>Name</b></p>
                            </div>
                            <div class="col-lg-7">
                                @if ($ticket->user_id)
                                    <p>{{ $ticket->user->name }}</p>
                                @else
                                    <p>-</p>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-5">
                                <p><b>Status</b></p>
                            </div>
                            <div class="col-lg-7">
                                <span style="font-size: 14px"
                                    class="badge p-2 {{ $ticket->ticketStatus->status == 'to do' ? 'badge-secondary' : ($ticket->ticketStatus->status == 'on progress' ? 'badge-warning' : ($ticket->ticketStatus->status == 'testing' ? 'badge-info' : ($ticket->ticketStatus->status == 'staging' ? 'badge-primary' : ($ticket->ticketStatus->status == 'done' ? 'badge-success' : '')))) }}">
                                    {{ ucfirst($ticket->ticketStatus->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-5">
                                <p><b>Description</b></p>
                            </div>
                            <div class="col-lg-7">
                                <p>{{ $ticket->description == '' ? '-' : $ticket->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>
@endsection
