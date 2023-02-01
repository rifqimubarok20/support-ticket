@extends('main')

@section('title', 'Detail Tikcket')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><strong>Ticket /</strong> Detail Ticket</h1>
    </div>

    <a href="/ticket" class="btn btn-sm btn-danger" style="margin-bottom: 10px;"><i class="fa fa-arrow-left"></i>
        Kembali</a>

    <div class="row justify-content-around">
        <div class="card shadow col-lg-7 mb-4">
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
                        {{ $ticket->issue }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <p><b>File Dokumen</b></p>
                    </div>
                    <div class="col-lg-9">
                        <a href="/ticket/download/{{ $ticket->id }}" class="btn btn-primary"><i
                                class="fas fa-download"></i> Download</a>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <p><b>Status</b></p>
                    </div>
                    <div class="col-lg-9">
                        <span class="badge badge-secondary p-2" style="font-size: 14px">
                            {{ $ticket->status }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow col-lg-4 mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Programmer</h6>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-lg-5">
                        <p><b>Nama</b></p>
                    </div>
                    <div class="col-lg-7">
                        <p>{{ $ticket->user_id }}</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-5">
                        <p><b>Status</b></p>
                    </div>
                    <div class="col-lg-7">
                        <span class="badge badge-secondary p-2" style="font-size: 14px">
                            {{ $ticket->status }}
                        </span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-5">
                        <p><b>Description</b></p>
                    </div>
                    <div class="col-lg-7">
                        <p>{{ $ticket->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
