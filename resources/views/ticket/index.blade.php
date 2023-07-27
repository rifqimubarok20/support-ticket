@extends('main')

@section('title', 'Ticketing')

@section('content')
    @php
        use Illuminate\Support\Str;
    @endphp
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ticket</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-info alert-dismissible col-lg-12" role='alert'>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h5><i class="icon fa fa-check-square"></i> Berhasil!!!</h5>
            {{ session('success') }}
        </div>
    @elseif (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible col-lg-12" role='alert'>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h6>{{ session('delete') }}</h6>
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
                        <span class="text">Ajukan Ticket</span>
                    </a>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nomor Tiket</th>
                            <th>Produk</th>
                            <th>Klien</th>
                            <th>Isu</th>
                            {{-- <th class="text-center">File</th> --}}
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Nomor Tiket</th>
                            <th>Produk</th>
                            <th>Klien</th>
                            <th>Isu</th>
                            {{-- <th class="text-center">File</th> --}}
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($ticket as $item)
                            <tr>
                                <td style="vertical-align: middle">
                                    {{ $loop->iteration }}
                                    @if ($item->created_at->diffInDays() < 2)
                                        <span class="badge badge-warning">New</span>
                                    @endif
                                </td>
                                <td style="vertical-align: middle">{{ $item->no_ticket }}</td>
                                <td style="vertical-align: middle">{{ $item->product->nama }}</td>
                                <td style="vertical-align: middle">{{ $item->client->name }}</td>
                                <td>{!! Str::limit($item->issue, 51, '...') !!}</td>
                                {{-- <td class="text-center" style="vertical-align: middle">
                                    @if ($item->file)
                                        <a class="text-primary" href="{{ asset('storage/' . $item->file) }}"
                                            target="_blank">
                                            <i class="fas fa-file-alt"></i>
                                        </a>
                                    @else
                                        <p>-</p>
                                    @endif
                                </td> --}}
                                <td class="text-center" style="vertical-align: middle">
                                    @php
                                        $latestStatus = $item
                                            ->ticketStatus()
                                            ->where('ticket_id', $item->id)
                                            ->latest()
                                            ->first();
                                    @endphp
                                    @if ($latestStatus)
                                        @php
                                            $status = $latestStatus->status;
                                        @endphp
                                        <span
                                            class="badge p-2
                                        {{ $status == 'pending' ? 'badge-secondary' : ($status == 'to do' ? 'badge-dark' : ($status == 'on progress' ? 'badge-warning' : ($status == 'testing' ? 'badge-info' : ($status == 'staging' ? 'badge-primary' : ($status == 'done' ? 'badge-success' : ''))))) }}">
                                            {{ ucfirst($status) }}
                                        </span>
                                        @if (Auth::user()->can('admin') || Auth::user()->can('programmer'))
                                            @if ($item->status == 'close')
                                                <hr class="mt-2 mb-2">
                                                <sup class="text-danger">*Tiket di Tutup oleh Klien</sup>
                                            @endif
                                        @endif
                                        @can('client')
                                            @if ($item->status == 'open')
                                                -
                                                <a href="/ticket/close/{{ $item->id }}"
                                                    class="btn btn-circle btn-sm btn-danger" data-toggle="tooltip"
                                                    data-placement="top" title="Close Ticket"><i
                                                        class="fas fa-lock-open"></i></a>
                                            @elseif ($item->status == 'close')
                                                -
                                                <a href="/ticket/open/{{ $item->id }}"
                                                    class="btn btn-circle btn-sm btn-danger" data-toggle="tooltip"
                                                    data-placement="top" title="Open Ticket"><i class="fas fa-lock"></i></a>
                                            @endif
                                        @endcan
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                                <td class="text-center px-0" style="vertical-align: middle">
                                    <a href="/ticket/{{ $item->id }}" class="btn btn-circle btn-sm btn-primary"
                                        data-toggle="tooltip" data-placement="bottom" title="Detail"><i
                                            class="fas fa-eye"></i></a>
                                    @if (Auth::user()->can('programmer') && $item->status !== 'close')
                                        <a href="/ticket/status/{{ $item->id }}"
                                            class="btn btn-circle btn-sm btn-success" data-toggle="tooltip"
                                            data-placement="top" title="Edit Status"><i class="fas fa-plus"></i></a>
                                    @endif
                                    @if (Auth::user()->can('admin') && $latestStatus && $latestStatus->status != 'done' && $item->status !== 'close')
                                        <a href="/ticket/{{ $item->id }}/edit"
                                            class="btn btn-circle btn-sm btn-warning" data-toggle="tooltip"
                                            data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                    @endif
                                    @can('admin')
                                        @if (!$latestStatus || ($latestStatus->status != 'done' && $item->status !== 'close'))
                                            <form action="/ticket/{{ $item->id }}" method="POST" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-circle btn-sm btn-danger" title="Hapus"
                                                    onclick="return confirm('Yakin Mau Di Hapus?')"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
                                        @endif
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
