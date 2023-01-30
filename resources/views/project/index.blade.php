@extends('main')

@section('title', 'Project')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Projects</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Data List Projects</h6>
        </div>
        <div class="card-body">
            @can('admin')
                <div class="d-flex mb-3">
                    <a class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#tambahProject">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah Project</span>
                    </a>
                </div>
            @endcan
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Products</th>
                            @foreach ($documents as $item)
                                <th class="text-center">{{ $item->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Client</th>
                            <th>Products</th>
                            @foreach ($documents as $item)
                                <th class="text-center">{{ $item->name }}</th>
                            @endforeach
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($project as $item)
                            @php
                                $projectDocuments = $item->documents->pluck('pivot.file', 'id');
                            @endphp
                            <tr>
                                <td>{{ $item->client->name }}</td>
                                <td>{{ $item->product->nama }}</td>
                                @foreach ($documents as $doc)
                                    @php
                                        $ownDocument = $projectDocuments[$doc->id] ?? null;
                                    @endphp
                                    <td class="text-center">
                                        @if (empty($ownDocument))
                                            <p><i class="fas fa-file-excel text-secondary" style="font-size: 20px"></i></p>
                                        @else
                                            <a href="{{ asset('storage/' . $ownDocument) }}"
                                                target="_blank"><i class="fas fa-file-download text-primary" style="font-size: 20px"></i></a>
                                        @endif
                                        <form action="{{ route('projects.upload') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="project_id" value="{{ $item->id }}">
                                            <input type="hidden" name="document_id" value="{{ $doc->id }}">
                                            <div class="mt-3">
                                                @can ('admin')
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            id="inputGroupFile04 file" name="file">
                                                        <label class="custom-file-label" for="inputGroupFile04">Choose
                                                            File</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-success" type="submit"
                                                            id="inputGroupFileAddon04">
                                                            <i class="fa-solid fa-upload"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                @endcan
                                        </form>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Project -->
    @can ('admin')
    <div class="modal fade" id="tambahProject" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Project</h5>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endcan
@endsection
