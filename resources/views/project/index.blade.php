@extends('main')

@section('title', 'Project')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Projects</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="list-unstyled mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session()->has('success'))
        <div class="alert alert-info alert-dismissible col-lg-12" role='alert'>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h5><i class="icon fa fa-check-square"></i> Berhasil!!!</h5>
            {{ session('success') }}
        </div>
    @elseif (session()->has('message'))
        <div class="alert alert-danger alert-dismissible col-lg-12" role='alert'>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h5><i class="icon fa fa-check-square"></i> Berhasil!!!</h5>
            {{ session('message') }}
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
            <h6 class="m-0 font-weight-bold text-primary">Data List Projects</h6>
        </div>
        <div class="card-body">
            @can('admin')
                <div class="d-flex mb-3">
                    <a class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#tambahProject">
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
                            <th>Klien</th>
                            <th>Produk</th>
                            <th class="text-center">Mulai</th>
                            <th class="text-center">Berakhir</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th>Klien</th>
                            <th>Produk</th>
                            <th class="text-center">Mulai</th>
                            <th class="text-center">Berakhir</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($project as $item)
                            @php
                                $projectDocuments = $item->documents->pluck('pivot.file', 'id');
                                $tanggal_mulai = \Carbon\Carbon::parse($item->start_project);
                                $tanggal_akhir = \Carbon\Carbon::parse($item->finish_project);
                                $tanggal_mulai->locale('id');
                                $tanggal_akhir->locale('id');
                            @endphp
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->client->name }}</td>
                                <td>{{ $item->product->nama }}</td>
                                <td class="text-center">
                                    {{ $item->start_project == '' ? '-' : $tanggal_mulai->isoFormat('dddd, D MMMM YYYY') }}
                                </td>
                                <td class="text-center">
                                    {{ $item->finish_project == '' ? '-' : $tanggal_akhir->isoFormat('dddd, D MMMM YYYY') }}
                                </td>
                                <td class="text-center" style="vertical-align: middle">
                                    <a href="#" class="btn btn-circle btn-sm btn-warning" title="Perpanjang Kontrak"
                                        data-toggle="modal" data-target="#editModal{{ $item->id }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="/projects/{{ $item->id }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-circle btn-sm btn-danger " title="Hapus"
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

    <!-- Modal Tambah Project -->
    @can('admin')
        <div class="modal fade" id="tambahProject" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Tambah</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('projects.store') }}" method="POST">
                            @csrf
                            <div class="from-group mb-3">
                                <label for="client_id" class="form-label">Client</label>
                                <select name="client_id" id="client_id" class="form-control">
                                    <option value="" selected hidden>Pilih Client</option>
                                    @foreach ($client as $item)
                                        <option value={{ $item->id }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="from-group mb-3">
                                <label for="product_id" class="form-label">Product</label>
                                <select name="product_id" id="product_id" class="form-control">
                                    <option value="" selected hidden>Pilih Product</option>
                                    @foreach ($product as $data)
                                        <option value={{ $data->id }}>{{ $data->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="from-group mb-3">
                                <label for="start_project" class="form-label">Tanggal Awal</label>
                                <input type="date" class="form-control @error('start_project') is-invalid @enderror"
                                    id="start_project" name="start_project" placeholder="Masukkan Kontak Perusahaan...">
                            </div>
                            <div class="from-group mb-3">
                                <label for="finish_project" class="form-label">Tanggal Akhir</label>
                                <input type="date" class="form-control @error('finish_project') is-invalid @enderror"
                                    id="finish_project" name="finish_project" placeholder="Masukkan Kontak Perusahaan...">
                            </div>
                            <button type="button" class="btn bg-gradient-danger text-white"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn bg-gradient-primary text-white">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($project as $item)
            <!-- Modal -->
            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Kontrak Project</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/projects/{{ $item->id }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="modal-body">
                                <div class="from-group mb-3">
                                    <label for="start_project" class="form-label">Tanggal Awal</label>
                                    <input type="date" class="form-control @error('start_project') is-invalid @enderror"
                                        id="start_project" name="start_project" value="{{ $item->start_project }}"
                                        placeholder="Masukkan Kontak Perusahaan...">
                                </div>
                                <div class="from-group mb-3">
                                    <label for="finish_project" class="form-label">Tanggal Akhir</label>
                                    <input type="date" class="form-control @error('finish_project') is-invalid @enderror"
                                        id="finish_project" name="finish_project" value="{{ $item->finish_project }}"
                                        placeholder="Masukkan Kontak Perusahaan...">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn bg-gradient-danger text-white"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn bg-gradient-primary text-white">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endcan
@endsection
