@extends('main')

@section('title', 'Tambah User')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><strong>User /</strong> Tambah User</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div
                class="d-flex justify-content-center flex-wrap flex-md-nowrapalign-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="text-center h2"> <b> Buat User Baru</b></h1>
            </div>
        </div>
    </div>


    <div class="col-lg-8">
        <form action="/user" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="from-group mb-3">
                <label for="name" class="form-label">Nama User</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    placeholder="Masukkan Nama User..." required>
            </div>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div class="from-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" placeholder="Masukkan Email...">
            </div>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div class="from-group mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" placeholder="Masukkan Password...">
            </div>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div class="from-group mb-3">
                <label for="image" class="form-label">Foto</label>
                <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image"
                    name="image" placeholder="Masukkan Foto...">
            </div>
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div class="from-group mb-3">
                <label for="role" class="form-label">Role</label>
                {{-- <input type="text" class="form-control @error('role') is-invalid @enderror" id="role" name="role"
                    placeholder="Masukkan Role..."> --}}
                <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                    <option value="" selected hidden>Pilih Role User</option>
                    <option value="admin">Admin</option>
                    <option value="operator">Operator</option>
                    <option value="client">Client</option>
                </select>
            </div>
            @error('role')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <br>
            <div class="from-group mb-5">
                <button type="submit" class="btn bg-gradient-primary text-white">Simpan</button>
                <a href="/user" class="btn bg-gradient-danger text-white">Kembali</a>
            </div>
        </form>
    </div>
@endsection
