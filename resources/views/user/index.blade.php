@extends('main')

@section('title', 'Users')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Data List Users</h6>
        </div>
        <div class="card-body">
            <div class="d-flex mb-3">
                <a href="/user/create" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah</span>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">
                                <center>No</center>
                            </th>
                            <th>
                                <center>Gambar</center>
                            </th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Perusahaan</th>
                            <th>Role</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th width="5%">
                                <center>No</center>
                            </th>
                            <th>
                                <center>Gambar</center>
                            </th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Perusahaan</th>
                            <th>Role</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($users as $usr)
                            <tr>
                                <td>
                                    <center>{{ $loop->iteration }}</center>
                                </td>
                                @if ($usr->image)
                                    <td>
                                        <center><img class="img-profile rounded-circle" style="width: 50px; height: 50px"
                                                src="{{ asset('storage/' . $usr->image) }}"></center>
                                    </td>
                                @else
                                    <td>
                                        <center><img class="img-profile rounded-circle" style="width: 50px; height: 50px"
                                                src="{{ asset('temp') }}/img/undraw_profile.svg"></center>
                                    </td>
                                @endif
                                <td>{{ ucfirst($usr->name) }}</td>
                                <td>{{ $usr->email }}</td>
                                <td>{{ $usr->client ? $usr->client->name : '-' }}</td>
                                <td>{{ ucfirst($usr->role) }}</td>
                                <td class="text-center">
                                    {{-- <a href="/user/{{ $usr->id }}" class="btn btn-circle btn-sm btn-primary"><i
                                            class="fa fa-eye"></i></a> --}}
                                    <a href="/user/{{ $usr->id }}/edit" class="btn btn-circle btn-sm btn-warning"
                                        title="Edit"><i class="fa fa-edit"></i></a>
                                    <form action="/user/{{ $usr->id }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-circle btn-sm btn-danger" title="Hapus"
                                            onclick="return confirm('Yakin Mau Di Hapus?')"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
