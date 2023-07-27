@extends('main')

@section('title', 'Tambah Product')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><strong>Products /</strong> Tambah Product</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div
                class="d-flex justify-content-center flex-wrap flex-md-nowrapalign-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="text-center h2"> <b> Buat Product Baru</b></h1>
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
        <form action="/products" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                    placeholder="Masukkan Nama Product..." value="{{ old('nama') }}" required>
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="from-group mb-3">
                <label for="nama" class="form-label">Nama Kategori</label><br>
                <select class="custom-select @error('id_kategori') is-invalid @enderror" name="id_kategori" id="id_kategori"
                    aria-label="Default select example">
                    <option selected value="">- Pilih Kategori -</option>
                    @foreach ($kategori as $item)
                        <option value={{ $item->id }}>{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('id_kategori')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="from-group mb-3">
                <label for="client_id" class="form-label">Client</label><br>
                <select class="custom-select @error('client_id') is-invalid @enderror" name="client_id" id="client_id">
                    <option selected value="">- Pilih Client -</option>
                    @foreach ($client as $cli)
                        <option value={{ $cli->id }}>{{ $cli->name }}</option>
                    @endforeach
                </select>
                @error('client_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <br>
            <div class="from-group mb-5">
                <a href="/products" class="btn bg-gradient-danger text-white">Kembali</a>
                <button type="submit" class="btn bg-gradient-primary text-white">Simpan</button>
            </div>
        </form>
    </div>
@endsection
