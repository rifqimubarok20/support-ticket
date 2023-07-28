@extends('main')

@section('title', 'Client')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Clients</h1>
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
    @elseif (session()->has('update'))
        <div class="alert alert-warning alert-dismissible col-lg-12" role='alert'>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h5><i class="icon fa fa-check-square"></i> Updated</h5>
            {{ session('update') }}
        </div>
    @elseif (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible col-lg-12" role='alert'>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h5><i class="icon fa fa-check-square"></i> Deleted</h5>
            {{ session('delete') }}
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data List Client</h6>
        </div>
        <div class="card-body">
            @can('admin')
                <div class="d-flex mb-3">
                    <a href="/clients/create" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah</span>
                    </a>
                </div>
            @endcan
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">
                                <center>No</center>
                            </th>
                            <th>Nama Perusahaan</th>
                            <th>Kontak</th>
                            <th>Provinsi</th>
                            @can('admin')
                                <th class="text-center">Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th width="5%">
                                <center>No</center>
                            </th>
                            <th>Nama Perusahaan</th>
                            <th>Kontak</th>
                            <th>Provinsi</th>
                            @can('admin')
                                <th class="text-center">Aksi</th>
                            @endcan
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($client as $cli)
                            <tr>
                                <td>
                                    <center>{{ $loop->iteration }}</center>
                                </td>
                                <td>{{ $cli->name }}</td>
                                <td>{{ $cli->contact }}</td>
                                <td>{!! $cli->address !!}</td>
                                @can('admin')
                                    <td class="text-center">
                                        <a href="/clients/{{ $cli->id }}" class="btn btn-circle btn-sm btn-primary"
                                            title="Detail"><i class="fa fa-eye"></i></a>
                                        <a href="/clients/{{ $cli->id }}/edit" class="btn btn-circle btn-sm btn-warning"
                                            title="Edit"><i class="fa fa-edit"></i></a>
                                        <form action="/clients/{{ $cli->id }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-circle btn-sm btn-danger" title="Hapus"
                                                onclick="return confirm('Yakin Mau Di Hapus?')"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
