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
                            <th>Status</th>
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
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($ticket as $item)
                            <tr>
                                <td>
                                    @if($item->expired_at >= Carbon\Carbon::now())
                                        <span class="badge badge-warnig">New</span>
                                    @endif
                                    {{ $loop->iteration }}
                                </td>
                                <td>{{ $item->product->nama }}</td>
                                <td>{{ $item->client->name }}</td>
                                <td>{{ $item->issue }}</td>
                                <td class="text-center">
                                    <a href="{{ asset('storage/' . $item->file) }}" target="_blank">
                                        <i class="fas fa-file-alt"></i>
                                    </a>
                                </td>
                                <td class="text-center"><span
                                        class="badge p-2 {{ $item->status == 'to do' ? 'badge-secondary' : ($item->status == 'on progress' ? 'badge-warning' : ($item->status == 'testing' ? 'badge-info' : ($item->status == 'staging' ? 'badge-primary' : ($item->status == 'done' ? 'badge-success' : '')))) }}">{{ ucfirst($item->status) }}</span>
                                </td>
                                <td class="text-center px-0">
                                    <a href="/ticket/{{ $item->id }}" class="btn btn-circle btn-sm btn-primary"
                                        data-toggle="tooltip" data-placement="bottom" title="Detail"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="/ticket/{{ $item->id }}/edit" class="btn btn-circle btn-sm btn-warning"
                                        data-toggle="tooltip" data-placement="top" title="Edit"><i
                                            class="fa fa-edit"></i></a>
                                    <button class="btn btn-circle btn-sm btn-danger" data-toggle="modal"
                                        data-placement="top" title="Hapus" data-target="#staticBackdrop"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Hapus</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-6 d-flex justify-content-center">
                                                    <img src="{{ asset('temp/img/tanya.png') }}"
                                                        style="width: 200px; heigth: 300px">
                                                </div>
                                                <div class="col-6 d-flex justify-content-center align-items-center">
                                                    <h1 class="text-center"><strong>Yakin Mau Dihapus? 🤔</strong></h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="/ticket/{{ $item->id }}" method="POST" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Yakin</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
