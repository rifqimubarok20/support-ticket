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

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="list-unstyled mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Pesan sukses -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="col-lg-8">
        <form action="/clients/{{ $client->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="from-group mb-3">
                <label for="nama" class="form-label">Nama Perusahaan</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="nama" name="name"
                    value="{{ old('name', $client->name) }}" placeholder="Masukkan Nama Perusahaan..." required autofocus>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="from-group mb-3">
                <label for="kontak" class="form-label">Kontak Perusahaan</label>
                <input type="text" class="form-control @error('kontak') is-invalid @enderror" id="kontak"
                    kontak="contact" value="{{ old('contact', $client->contact) }}"
                    placeholder="Masukkan kontak Perusahaan..." required>
                @error('contact')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="from-group mb-2">
                <label for="linkedin" class="form-label">Linkedin</label>
                <input type="text" class="form-control @error('linkedin') is-invalid @enderror" id="linkedin"
                    name="linkedin" value="{{ old('linkedin', $client->linkedin) }}"
                    placeholder="Masukkan Link Linkedin...">
                <sup class="text-danger ml-3">Jika Tidak Ada Isi Dengan Tanda " - ".</sup>
                @error('linkedin')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="from-group mb-2">
                <label for="instagram" class="form-label">Instagram</label>
                <input type="text" class="form-control @error('instagram') is-invalid @enderror" id="instagram"
                    name="instagram" value="{{ old('instagram', $client->instagram) }}"
                    placeholder="Masukkan Link Instagram...">
                <sup class="text-danger ml-3">Jika Tidak Ada Isi Dengan Tanda " - ".</sup>
                @error('instagram')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="from-group mb-2">
                <label for="website" class="form-label">Website</label>
                <input type="text" class="form-control @error('website') is-invalid @enderror" id="website"
                    name="website" value="{{ old('website', $client->website) }}" placeholder="Masukkan Link Website...">
                <sup class="text-danger ml-3">Jika Tidak Ada Isi Dengan Tanda " - ".</sup>
                @error('website')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="from-group mb-3">
                <label for="image" class="form-label">Logo Perusahaan</label>
                <input type="hidden" name="oldImage" value="{{ $client->image }}">
                @if ($client->image)
                    <img class="img-fluid d-block my-3" style="width: 80px; height: 80px"
                        src="{{ asset('storage/' . $client->image) }}">
                @else
                    <img class="img-fluid d-block my-3" src="{{ asset('temp') }}/img/build.png"
                        style="width: 80px; height: 80px">
                @endif
                <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image"
                    name="image" placeholder="Masukkan Logo Perusahaan...">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="from-group mb-3">
                <label for="alamat" class="form-label">Alamat Perusahaan</label>
                <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="summernote" cols="30"
                    rows="5" placeholder="Masukkan Alamat Perusahaan..." required>{{ old('kontak', $client->address) }}</textarea>
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <br>
            <div class="from-group">
                <a href="/clients" class="btn bg-gradient-danger text-white">Kembali</a>
                <button type="submit" class="btn bg-gradient-primary text-white">Simpan</button>
            </div>
        </form>
    </div>
@endsection
