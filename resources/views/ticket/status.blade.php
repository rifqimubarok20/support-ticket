@extends('main')

@section('title', 'Edit Ticket')

@section('content')
    @php
        use App\Models\TicketStatus;
    @endphp
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
            <form action="/ticket/status/{{ $ticket->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="product">Product</label>
                                <input type="text" class="form-control" value="{{ $ticket->product->nama }}" disabled>
                                {{-- <select class="custom-select mr-sm-2" name="product_id" id="product" disabled>
                                    <option value="{{ old('product_id', $ticket->product_id) }}" selected hidden>
                                        {{ $ticket->product->nama }}</option>
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
                @can('programmer')
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="status">Status</label>
                                    <select class="custom-select mr-sm-2" name="status" id="status">
                                        <option value="{{ $status->id }}" selected hidden>
                                            {{ ucfirst($status->status) }}
                                        </option>
                                        @foreach (TicketStatus::statusOptions() as $statusOptionKey => $statusOptionValue)
                                            <option value="{{ $statusOptionKey }}"
                                                {{ old('status') == $statusOptionKey ? 'selected' : '' }}>
                                                {{ $statusOptionValue }}
                                            </option>
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
                            <input type="hidden" value="{{ $ticket->id }}" name="ticket_id">
                        </div>
                    </div>
                @endcan
                <div class="form-row">
                    <a href="/ticket" class="btn btn-danger my-3 mr-2">Back</a>
                    <button type="submit" class="btn btn-primary my-3">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
