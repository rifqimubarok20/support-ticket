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
                                <input type="text" class="form-control" value="{{ $ticket->product->nama }}" disabled>
                                {{-- <select class="custom-select mr-sm-2" name="product_id" id="product" disabled>
                                    <option value="{{ old('product_id', $ticket->product_id) }}" selected hidden>
                                        {{ $ticket->product->nama }}</option>
                                    @foreach ($product as $prd)
                                        <option value="{{ $prd->id }}">{{ $prd->nama }}</option>
                                    @endforeach
                                </select> --}}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="form-group">
                                    <label for="client">Client</label>
                                    <input type="text" class="form-control" value="{{ $ticket->client->name }}" disabled>
                                    {{-- <select class="custom-select mr-sm-2" name="client_id" id="client" disabled>
                                        <option value="">{{ $ticket->client->name }}</option>
                                    </select> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="issue">Issue</label>
                                <div
                                    style="border: 1px solid #d1d3e2; border-radius: 0.35rem; background-color: rgb(234, 236, 244); padding: 0.375rem 0.75rem; height: calc(3.3em + 3.75rem + 12px)">
                                    {!! $ticket->issue !!}</div>
                                {{-- <textarea class="form-control" name="issue" id="issue" rows="5" disabled>{!! $ticket->issue !!}</textarea> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="row mb-3">
                            <div class="col-lg-2">
                                <p><b>File Dokumen</b></p>
                            </div>
                            <div class="col-lg-10">
                                <a href="/ticket/download/{{ $ticket->id }}" class="btn btn-primary btn-sm"><i
                                        class="fas fa-download"></i> Download</a>
                                <a href="{{ asset('storage/' . $ticket->file) }}" class="btn btn-info btn-sm"
                                    target="_blank"><i class="fas fa-eye"></i> View</a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                @can('admin')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="programmer">Assign Programmer</label>
                                    <select class="custom-select mr-sm-2" name="user_id" id="programmer">
                                        @if ($ticket->user_id)
                                            <option value="{{ $ticket->user_id }}" selected hidden>{{ $ticket->user->name }}
                                            </option>
                                        @else
                                            <option selected hidden>Pilih Programmer</option>
                                        @endif
                                        @foreach ($programmer as $pro)
                                            <option value="{{ $pro->id }}">{{ $pro->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
                <input type="hidden" value="{{ $ticket->status_id }}" name="status_id">
                <hr>
                @can('programmer')
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="status">Status</label>
                                    <select class="custom-select mr-sm-2" name="status_id" id="status">
                                        <option value="{{ $ticket->status_id }}" selected hidden>
                                            {{ ucfirst($ticket->ticketStatus->status) }}
                                        </option>
                                        @foreach ($status as $st)
                                            <option value="{{ $st->id }}">{{ ucfirst($st->status) }}</option>
                                        @endforeach
                                        {{-- <option value="on progress">On Progress</option>
                                        <option value="testing">Testing</option>
                                        <option value="staging">Staging</option>
                                        <option value="done">Done</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="desc">Description</label>
                                    <textarea class="form-control" name="description" id="summernote" rows="5" placeholder="Masukkan Deskripsi..">{{ $ticket->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
                <div class="form-row">
                    <a href="/ticket" class="btn btn-danger my-3 mr-2">Kembali</a>
                    <button type="submit" class="btn btn-primary my-3">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
