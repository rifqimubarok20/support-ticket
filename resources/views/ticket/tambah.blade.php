@extends('main')

@section('title', 'Tambah Ticket')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><strong>Ticket /</strong> Tambah Ticket</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Input Support Ticket</h6>
        </div>
        <div class="card-body">
            <form action="/ticket" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="product">Product</label>
                                <select class="custom-select mr-sm-2" id="product" name="product_id">
                                    <option selected hidden>Pilih Product</option>
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
                                    <select class="custom-select mr-sm-2" id="product" name="client_id" disabled>
                                        <option value="{{ Auth::user()->id }}" selected hidden>
                                            {{ ucfirst(Auth::user()->name) }}</option>
                                        {{-- @foreach ($client as $cl)
                                            <option value="{{ $cl->id }}">{{ $cl->name }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlFile1">File input</label>
                                <input type="file" class="form-control-file" name="file" id="exampleFormControlFile1">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="issue">Issue</label>
                                <textarea class="form-control" id="issue" name="issue" rows="5" placeholder="Masukkan Issue..."></textarea>
                            </div>
                        </div>
                        <div class="form-row justify-content-end">
                            <a href="/ticket" class="btn btn-danger my-3 px-4 mr-2">Back</a>
                            <button type="submit" class="btn btn-primary my-3 px-4">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
