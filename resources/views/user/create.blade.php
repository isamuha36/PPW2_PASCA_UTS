<!-- resources/views/Book/create.blade.php -->
@extends('user.layouts')

@section('title', 'Tambah User')

@section('content')
    <h1>Tambah User</h1>

    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" required>
            @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <div class="mb-3">
            <label for="level" class="form-label">Level</label>
            <select name="level" class="form-control" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            @if ($errors->has('level'))
                <span class="text-danger">{{ $errors->first('level') }}</span>
            @endif
        </div>        

        <div class="mb-3">
            <label for="photo">Foto</label>
            <input type="file" name="photo" id="photo" class="form-control">
            @if ($errors->has('photo'))
                <span class="text-danger">{{ $errors->first('photo') }}</span>
            @endif
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
@endsection
