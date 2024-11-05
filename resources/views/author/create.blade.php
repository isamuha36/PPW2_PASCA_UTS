<!-- resources/views/Book/create.blade.php -->
@extends('author.layouts')

@section('title', 'Tambah Author')

@section('content')
    <h1>Tambah Author</h1>

    <form action="{{ route('authors.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Nama</label>
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
            <label for="phone" class="form-label">Nomor Telepon</label>
            <input type="number" name="phone" class="form-control" required>
            @if ($errors->has('phone'))
                <span class="text-danger">{{ $errors->first('phone') }}</span>
            @endif
        </div>

        <div class="mb-3">
            <label for="birth_date" class="form-label">Tanggal Lahir</label>
            <input type="date" name="birth_date" class="form-control" required>
            @if ($errors->has('birth_date'))
                <span class="text-danger">{{ $errors->first('birth_date') }}</span>
            @endif
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <input type="text" name="address" class="form-control" required>
            @if ($errors->has('address'))
                <span class="text-danger">{{ $errors->first('address') }}</span>
            @endif
        </div>

        <div class="mb-3">
            <label for="photo">Foto</label>
            <input type="file" name="photo" class="form-control">
            @if ($errors->has('photo'))
                <span class="text-danger">{{ $errors->first('photo') }}</span>
            @endif
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
@endsection
