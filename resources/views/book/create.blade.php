<!-- resources/views/Book/create.blade.php -->
@extends('book.layouts')

@section('title', 'Tambah Buku')

@section('content')
    <h1>Tambah Buku</h1>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul Buku</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="date_of_publication" class="form-label">Tanggal Terbit</label>
            <input type="date" name="date_of_publication" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="author_id" class="form-label">Penulis</label>
            <select name="author_id" class="form-control" required>
                <!-- Assumsi daftar penulis ada di variable authors -->
                @foreach($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
@endsection
