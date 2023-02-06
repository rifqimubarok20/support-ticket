@extends('main')

@section('title', 'Detail Client')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><strong>Clients /</strong> Detail Client</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div
                class="d-flex justify-content-center flex-wrap flex-md-nowrapalign-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="text-center h2"> <b> Detail Client</b></h1>
            </div>
        </div>
    </div>

    <a href="/clients" class="btn btn-sm btn-danger" style="margin-bottom: 10px;"><i class="fa fa-arrow-left"></i>
        Kembali</a>

    <div class="card col-lg-10 shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Information Client</h6>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-sm-3 rounded-left py-3 overflow-hidden">
                        @if ($client->image)
                            <img style="width: 180px; height: 180px" src="{{ asset('storage/' . $client->image) }}">
                        @else
                            <img style="width: 180px; height: 180px" src="{{ asset('temp') }}/img/undraw_profile.svg">
                        @endif
                    </div>
                    <div class="col-sm-8 rounded-right">
                        <div class="row">
                            <div class="col-sm-8">
                                <span class="mb-2"><strong>Nama Perusahaan</strong> : </span>
                                <p class="mb-3" style="font-size: 20px;margin-left: 50%">{{ $client->name }}</p>
                                <span class="mb-2"><strong>Kontak Perusahaan</strong> : </span>
                                <p class="mb-3" style="font-size: 20px;margin-left: 50%">{{ $client->contact }}</p>
                                <span class="mb-2"><strong>Alamat Perusahaan</strong> : </span>
                                <p class="mb-3" style="font-size: 20px;margin-left: 50%">{{ $client->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-center">
                <a href="#facebook" target="_blank" class="mr-3"><i class="fa-brands fa-facebook fa-xl"></i></a>
                <a href="#instagram" target="_blank" class="mr-3"><i class="fa-brands fa-instagram fa-xl"></i></a>
                <a href="#website" target="_blank"><i class="fa-sharp fa-solid fa-globe fa-xl"></i></a>
            </div>
        </div>
    </div>
    {{-- <div class="card-body">
        <div class="table-responsive col-lg-8">
            <a href="/clients" class="btn btn-sm btn-danger" style="margin-bottom: 10px;"><i class="fa fa-arrow-left"></i>
                Kembali</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="250px">Nama Perusahaan</th>
                        <td>{{ $client->nama }}</td>
                    </tr>
                    <tr>
                        <th width="250px">Kontak Perusahaan</th>
                        <td>{{ $client->kontak }}</td>
                    </tr>
                    <tr>
                        <th width="250px">Alamat Perusahaan</th>
                        <td>{{ $client->alamat }}</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div> --}}
@endsection
