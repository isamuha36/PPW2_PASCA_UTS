<!-- resources/views/Book/show.blade.php -->
@extends('book.layouts')

@section('title', 'Detail Buku')

@section('content')
    <h1>Detail Buku</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $book->title }}</h5>
            <p class="card-text">Harga: {{ $book->price }}</p>
            <p class="card-text">Tanggal Terbit: {{ $book->date_of_publication }}</p>
            <p class="card-text">Deskripsi: {{ $book->description }}</p>
            <p class="card-text">Penulis: {{ $book->author->name ?? 'N/A' }}</p>
        </div>
    </div>

    <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection
