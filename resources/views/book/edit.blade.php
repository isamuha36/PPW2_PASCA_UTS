<!-- resources/views/Book/edit.blade.php -->
@extends('book.layouts')

@section('title', 'Edit Buku')

@section('content')
    <h1>Edit Buku</h1>

    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Judul Buku</label>
            <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" name="price" class="form-control" value="{{ $book->price }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control">{{ $book->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="date_of_publication" class="form-label">Tanggal Terbit</label>
            <input type="date" name="date_of_publication" class="form-control" value="{{ $book->date_of_publication }}" required>
        </div>
        <div class="mb-3">
            <label for="author_id" class="form-label">Penulis</label>
            <select name="author_id" class="form-control" required>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ $book->author_id == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
