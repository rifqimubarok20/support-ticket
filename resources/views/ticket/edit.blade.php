@extends('main')

@section('title', 'Edit Ticket')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><strong>Ticket /</strong> Edit Ticket</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-info alert-dismissible col-lg-12" role='alert'>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{-- <button type="button" class="close" data-disniss="alert" aria-hidden="true">&times;</button> --}}
            <h5><i class="icon fa fa-check-square"></i> Berhasil!!!</h5>
            {{ session('success') }}
        </div>
    @endif

    <div class="container card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Support Ticket</h6>
        </div>
        <div class="card-body">
            <form action="/ticket/{{ $ticket->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="product">Product</label>
                                <select class="custom-select mr-sm-2" name="product_id" id="product">
                                    <option value="{{ old('product_id', $ticket->product_id) }}" selected hidden>
                                        {{ $ticket->product->nama }}</option>
                                    @foreach ($product as $prd)
                                        <option value="{{ $prd->id }}">{{ $prd->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="form-group">
                                    <label for="client">Client</label>
                                    <select class="custom-select mr-sm-2" name="client_id" id="client" disabled>
                                        <option value="{{ Auth::user()->id }}" selected hidden>
                                            {{ ucfirst(Auth::user()->name) }}</option>
                                        {{-- @foreach ($client as $cli)
                                            <option value="{{ $cli->id }}">{{ $cli->name }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="hidden" name="oldFile" class="form-control-file" value="{{ $ticket->file }}">
                                <label for="fileInput">File input</label>
                                <input type="file" class="form-control-file" name="file" id="fileInput">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="issue">Issue</label>
                                <textarea class="form-control" name="issue" id="issue" rows="5">{{ $ticket->issue }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="programmer">Assign Programmer</label>
                                <select class="custom-select mr-sm-2" id="programmer">
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="status">Status</label>
                                <select class="custom-select mr-sm-2" id="status">
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="status">Description</label>
                                <textarea class="form-control" id="issue" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="form-row justify-content-end">
                    <a href="/ticket" class="btn btn-danger my-3 mr-2">Back</a>
                    <button type="submit" class="btn btn-primary my-3">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
