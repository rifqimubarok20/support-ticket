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

    <div class="col-lg-8">
        <form action="/editprofile/{{ $user->id }}" method="POST" enctype="multipart/form-data">
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
                    value="{{ old('email', $user->email) }}" placeholder="Masukkan email Perusahaan..." required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
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
                <button type="submit" class="btn bg-gradient-primary text-white">Update</button>
                <a href="/dashboard" class="btn bg-gradient-danger text-white">Kembali</a>
            </div>
        </form>
    </div>
@endsection
