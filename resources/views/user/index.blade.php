<!-- resources/views/Book/index.blade.php -->
@extends('user.layouts')

@section('title', 'Daftar User')

@section('content')
    <h1>Daftar User</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Tambah User</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Level</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user_data as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->level }}</td>
                    <td>
                        @if ($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="User Photo"
                                style="width: 100px; height: auto;">
                        @else
                            <span>Tidak Ada Foto</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
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
