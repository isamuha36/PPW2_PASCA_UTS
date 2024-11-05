<!-- resources/views/Book/index.blade.php -->
@extends('book.layouts')

@section('title', 'Daftar Author')

@section('content')
    <h1>Daftar Buku</h1>
    <a href="{{ route('authors.create') }}" class="btn btn-primary mb-3">Tambah Author</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No Telepon</th>
                <th>Alamat</th>
                <th>Tanggal Lahir</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($authors_data as $author)
                <tr>
                    <td>{{ $author->id }}</td>
                    <td>{{ $author->name }}</td>
                    <td>{{ $author->email }}</td>
                    <td>{{ $author->phone }}</td>
                    <td>{{ $author->address }}</td>
                    <td>{{ $author->birth_date }}</td>
                    <td>
                        @if ($author->photo)
                            <img src="{{ asset('storage/' . $author->photo) }}" alt="Author Photo"
                            style="width: 100px; height: auto;">
                        @else
                        <span>Tidak Ada Foto</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('authors.destroy', $author->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
