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


    <div class="col-lg-8">
        <form action="/products" method="POST">
            @csrf
            <div class="from-group mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                    placeholder="Masukkan Nama Product..." name="nama" required>
            </div>
            @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div class="from-group mb-3">
                <label for="nama" class="form-label">Nama Kategori</label><br>
                <select class="custom-select @error('kategori') is-invalid @enderror" name="kategori" id="kategori" aria-label="Default select example">
                    <option selected disabled>- Pilih -</option>
                    @foreach ($kategori as $item)
                        <option value={{ $item->id }}>{{ $item->name }}</option>
                    @endforeach
                  </select>
            </div>
            @error('kategori')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <br>
            <div class="from-group mb-5">
                <button type="submit" class="btn bg-gradient-primary text-white">Simpan</button>
                <a href="/products" class="btn bg-gradient-danger text-white">Kembali</a>
            </div>
        </form>
    </div>
@endsection
