@extends('main')

@section('title', 'Edit Client')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><strong>Clients /</strong> Edit Client</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div
                class="d-flex justify-content-center flex-wrap flex-md-nowrapalign-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="text-center h2"> <b> Update Client Baru</b></h1>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <form action="/clients/{{ $client->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="from-group mb-3">
                <label for="nama" class="form-label">Nama Perusahaan</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                    value="{{ old('nama', $client->nama) }}" placeholder="Masukkan Nama Perusahaan..." required autofocus>
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="from-group mb-3">
                <label for="kontak" class="form-label">Kontak Perusahaan</label>
                <input type="text" class="form-control @error('kontak') is-invalid @enderror" id="kontak"
                    kontak="kontak" value="{{ old('kontak', $client->kontak) }}" placeholder="Masukkan kontak Perusahaan..."
                    required>
                @error('kontak')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="from-group mb-3">
                <label for="image" class="form-label">Logo Perusahaan</label>
                <input type="hidden" name="oldImage" value="{{ $client->image }}">
                @if ($client->image)
                    <img class="img-fluid d-block my-3" src="{{ asset('storage/' . $client->image) }}">
                @else
                    <img class="img-fluid" src="">
                @endif
                <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image"
                    name="image" placeholder="Masukkan Logo Perusahaan...">
            </div>
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div class="from-group mb-3">
                <label for="alamat" class="form-label">Alamat Perusahaan</label>
                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" cols="30"
                    rows="5" placeholder="Masukkan Alamat Perusahaan..." required>{{ old('kontak', $client->alamat) }}</textarea>
                @error('semester')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <br>
            <div class="from-group">
                <button type="submit" class="btn bg-gradient-primary text-white">Update</button>
                <a href="/clients" class="btn bg-gradient-danger text-white">Kembali</a>
            </div>
        </form>
    </div>
@endsection
