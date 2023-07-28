@extends('main')

@section('title', 'Edit Profile')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><strong>Profile /</strong> Edit Profile</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div
                class="d-flex justify-content-center flex-wrap flex-md-nowrapalign-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="text-center h2"> <b> Update Profile</b></h1>
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
        <form action="/user/{{ $user->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="from-group mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $user->name) }}" placeholder="Masukkan Nama Anda..." required autofocus>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="from-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" value="{{ old('email', $user->email) }}" placeholder="Masukkan email Perusahaan..."
                    required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- <div class="from-group mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" value="{{ old('password') }}" placeholder="Masukkan password Baru..." required>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div> --}}
            @if ($user->role == 'client')
                <div class="from-group mb-3">
                    <label for="role" class="form-label">Unit</label>
                    <select name="client_id" id="unit" class="form-control @error('unit') is-invalid @enderror">
                        <option value="{{ $user->client ? $user->client->id : '' }}" selected>
                            {{ $user->client ? $user->client->name : '- Pilih Perusahaan -' }}</option>
                        @foreach ($client as $cl)
                            <option value="{{ $cl->id }}">{{ $cl->name }}</option>
                        @endforeach
                    </select>
                    @error('unit')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endif
            <div class="from-group mb-3">
                <label for="image" class="form-label">Foto Profile</label>
                <input type="hidden" name="oldImage" value="{{ $user->image }}">
                @if ($user->image)
                    <img style="width: 80px; height: 80px" class="img-fluid d-block my-3"
                        src="{{ asset('storage/' . $user->image) }}">
                @else
                    <img style="width: 80px; height: 80px" class="img-fluid d-block my-3"
                        src="{{ asset('temp') }}/img/undraw_profile.svg">
                @endif
                <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image"
                    name="image" placeholder="Masukkan Foto Profile...">
            </div>
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <br>
            <div class="from-group">
                <a href="/user" class="btn bg-gradient-danger text-white">Kembali</a>
                <button type="submit" class="btn bg-gradient-primary text-white">Simpan</button>
            </div>
        </form>
    </div>
@endsection
