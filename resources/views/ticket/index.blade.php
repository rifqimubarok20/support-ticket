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
            @if (Auth::user()->role == 'client')
                <div class="d-flex mb-3">
                    <a href="/ticket/create" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah Ticket</span>
                    </a>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Product</th>
                            <th>Client</th>
                            <th>Issue</th>
                            <th class="text-center">File</th>
                            <th class="text-center">Status</th>
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
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($ticket as $item)
                            <tr>
                                <td style="vertical-align: middle">
                                    @if ($item->created_at->diffInDays() < 2)
                                        <span class="badge badge-warning">New</span>
                                    @endif
                                    {{ $loop->iteration }}
                                </td>
                                <td style="vertical-align: middle">{{ $item->product->nama }}</td>
                                <td style="vertical-align: middle">{{ $item->client->name }}</td>
                                <td>{{-- {{ $item->issue }} --}}{!! $item->issue !!}</td>
                                <td class="text-center" style="vertical-align: middle">
                                    @if ($item->file)
                                        <a class="text-primary" href="{{ asset('storage/' . $item->file) }}"
                                            target="_blank">
                                            <i class="fas fa-file-alt"></i>
                                        </a>
                                    @else
                                        <p>-</p>
                                    @endif
                                </td>
                                <td class="text-center" style="vertical-align: middle">
                                    @if ($item->ticketStatus)
                                        <span
                                            class="badge p-2 {{ $item->ticketStatus()->where('ticket_id', $item->id)->latest()->first()->status == 'to do'? 'badge-secondary': ($item->ticketStatus()->where('ticket_id', $item->id)->latest()->first()->status == 'on progress'? 'badge-warning': ($item->ticketStatus()->where('ticket_id', $item->id)->latest()->first()->status == 'testing'? 'badge-info': ($item->ticketStatus()->where('ticket_id', $item->id)->latest()->first()->status == 'staging'? 'badge-primary': ($item->ticketStatus()->where('ticket_id', $item->id)->latest()->first()->status == 'done'? 'badge-success': '')))) }}">{{ ucfirst($item->ticketStatus()->where('ticket_id', $item->id)->latest()->first()->status) }}</span>
                                    @else
                                        <span>-</span>
                                    @endif
                                    {{-- <span
                                        class="badge p-2 {{ $status->status == 'to do' ? 'badge-secondary' : ($status->status == 'on progress' ? 'badge-warning' : ($status->status == 'testing' ? 'badge-info' : ($status->status == 'staging' ? 'badge-primary' : ($status->status == 'done' ? 'badge-success' : '')))) }}">{{ ucfirst($status->status) }}</span> --}}
                                </td>
                                <td class="text-center px-0" style="vertical-align: middle">
                                    <a href="/ticket/{{ $item->id }}" class="btn btn-circle btn-sm btn-primary"
                                        data-toggle="tooltip" data-placement="bottom" title="Detail"><i
                                            class="fas fa-eye"></i></a>
                                    @if (Auth::user()->can('programmer'))
                                        <a href="/ticket/status/{{ $item->id }}"
                                            class="btn btn-circle btn-sm btn-success" data-toggle="tooltip"
                                            data-placement="top" title="Status"><i class="fas fa-plus"></i></a>
                                    @endif
                                    @if (Auth::user()->can('admin'))
                                        <a href="/ticket/{{ $item->id }}/edit" class="btn btn-circle btn-sm btn-warning"
                                            data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                class="fa fa-edit"></i></a>
                                    @endif
                                    @can('admin')
                                        <form action="/ticket/{{ $item->id }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-circle btn-sm btn-danger"
                                                onclick="return confirm('Yakin Mau Di Hapus?')"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
