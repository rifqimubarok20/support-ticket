@extends('main')

@section('title', 'Tambah Client')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><strong>Clients /</strong> Tambah Client</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div
                class="d-flex justify-content-center flex-wrap flex-md-nowrapalign-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="text-center h2"> <b> Buat Client Baru</b></h1>
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
        <form action="/clients" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="from-group mb-3">
                <label for="name" class="form-label">Nama Perusahaan</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name') }}" placeholder="Masukkan Nama Perusahaan..." required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="from-group mb-3">
                <label for="contact" class="form-label">Kontak Perusahaan</label>
                <input type="text" class="form-control @error('kontak') is-invalid @enderror" id="contact"
                    name="contact" value="{{ old('contact') }}" placeholder="Masukkan Kontak Perusahaan...">
                @error('kontak')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="from-group mb-2">
                <label for="linkedin" class="form-label">Linkedin</label>
                <input type="text" class="form-control @error('linkedin') is-invalid @enderror" id="linkedin"
                    name="linkedin" value="{{ old('linkedin') }}" placeholder="Masukkan Link Linkedin...">
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
                    name="instagram" value="{{ old('instagram') }}" placeholder="Masukkan Link Instagram...">
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
                    name="website" value="{{ old('website') }}" placeholder="Masukkan Link Website...">
                <sup class="text-danger ml-3">Jika Tidak Ada Isi Dengan Tanda " - ".</sup>
                @error('website')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="from-group mb-3">
                <label for="image" class="form-label">Logo Perusahaan</label>
                <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image"
                    name="image" placeholder="Masukkan Logo Perusahaan...">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="from-group mb-3">
                <label for="address" class="form-label">Alamat Perusahaan</label>
                <textarea name="address" class="form-control @error('alamat') is-invalid @enderror" id="summernote" cols="30"
                    rows="5" placeholder="Masukkan Alamat Lengkap Perusahaan..." required>{{ old('address') }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <br>
            <div class="from-group mb-5">
                <a href="/clients" class="btn bg-gradient-danger text-white">Kembali</a>
                <button type="submit" class="btn bg-gradient-primary text-white">Simpan</button>
            </div>
        </form>
    </div>
@endsection
