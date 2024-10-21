@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Register</div>
            <div class="card-body">
                <form action="{{ route('store') }}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                        <div class="col-md-6">
                            {{-- @error('name') is-invalid @enderror: Ini adalah directive Blade dari Laravel yang menambahkan kelas is-invalid jika ada kesalahan pada input name. --}}
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}"> {{-- value="{{ old('name') }}": Menggunakan fungsi old('name') untuk menampilkan nilai sebelumnya dari field name setelah form di-submit, jika terjadi kesalahan. Ini memungkinkan pengguna untuk tidak perlu mengetik ulang data yang sudah mereka masukkan saat ada kesalahan validasi. --}}
                            @if ($errors->has('name')) {{--  Mengecek apakah ada kesalahan validasi untuk field name. --}}
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email Address</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="password" class="col-md-4 col-form-label text-md-end text-start">Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="password_confirmation" class="col-md-4 col-form-label text-md-end text-start">Confirm Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-6 offset-md-5">
                            <input type="submit" class="col-md-3 btn btn-primary" value="Register">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
