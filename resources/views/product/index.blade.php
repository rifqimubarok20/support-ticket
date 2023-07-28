@extends('main')

@section('title', 'Product')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Products</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-info alert-dismissible col-lg-12" role='alert'>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
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
            <h6 class="m-0 font-weight-bold text-primary">Data List Products</h6>
        </div>
        <div class="card-body">
            @can('admin')
                <div class="d-flex mb-3">
                    <a href="/products/create" class="btn btn-success btn-icon-split">
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
                            <th class="text-center" width="5%">No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Klien</th>
                            @can('admin')
                                <th class="text-center">Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Klien</th>
                            @can('admin')
                                <th class="text-center">Aksi</th>
                            @endcan
                        </tr>
                    </tfoot>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($product as $data)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->kategori->name }}</td>
                                <td>{{ $data->client->name }}</td>
                                @can('admin')
                                    <td class="text-center">
                                        <a href="/products/{{ $data->id }}/edit" class="btn btn-circle btn-sm btn-warning"
                                            title="Edit"><i class="fa fa-edit"></i></a>
                                        <form action="/products/{{ $data->id }}" method="POST" class="d-inline">
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
