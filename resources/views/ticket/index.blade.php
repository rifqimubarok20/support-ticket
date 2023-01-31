@extends('main')

@section('title', 'Ticketing')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ticket</h1>
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

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data List Ticket</h6>
        </div>
        <div class="card-body">
            @can('admin')
                <div class="d-flex mb-3">
                    <a href="/ticket/create" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah Ticket</span>
                    </a>
                </div>
            @endcan
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Product</th>
                            <th>Client</th>
                            <th>Issue</th>
                            <th class="text-center">File</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Product</th>
                            <th>Client</th>
                            <th>Issue</th>
                            <th class="text-center">File</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($ticket as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->product->nama }}</td>
                                <td>{{ $item->client->name }}</td>
                                <td>{{ $item->issue }}</td>
                                <td class="text-center"><a href="{{ asset('storage/'. $item->file) }}" target="_blank"><i class="fas fa-file-alt"></i></a></td>
                                <td class="text-center">
                                    <a href="/clients/" class="btn btn-circle btn-sm btn-success" data-toggle="tooltip"
                                        data-placement="bottom" title="Ajukan"><i class="fas fa-paper-plane"></i></a>
                                    <a href="/clients//edit" class="btn btn-circle btn-sm btn-warning" data-toggle="tooltip"
                                        data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                    <form action="/ticket/{{ $item->id }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-circle btn-sm btn-danger" data-toggle="tooltip"
                                            data-placement="top" title="Hapus"
                                            onclick="return confirm('Yakin Mau Di Hapus?')"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        {{-- @foreach ($client as $cli)
                            <tr>
                                <td>{{ $cli->name }}</td>
                                <td>{{ $cli->contact }}</td>
                                <td>{{ $cli->address }}</td>
                                @can('admin')
                                    <td class="text-center">
                                        <a href="/clients/{{ $cli->id }}" class="btn btn-circle btn-sm btn-primary"><i
                                                class="fa fa-eye"></i></a>
                                        <a href="/clients/{{ $cli->id }}/edit" class="btn btn-circle btn-sm btn-warning"><i
                                                class="fa fa-edit"></i></a>
                                        <form action="/clients/{{ $cli->id }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-circle btn-sm btn-danger"
                                                onclick="return confirm('Yakin Mau Di Hapus?')"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
