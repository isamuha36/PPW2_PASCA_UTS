<!-- resources/views/Book/create.blade.php -->
@extends('user.layouts')

@section('title', 'Tambah User')

@section('content')
    <h1>Tambah Gambar</h1>

    <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
            @if ($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
                <div class="alert alert-danger">{{ $message }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
            @if ($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
                <div class="alert alert-danger">{{ $message }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="picture">Choose Image</label>
            <input type="file" name="picture" id="picture" class="form-control">
            @if ($errors->has('picture'))
                <span class="text-danger">{{ $errors->first('picture') }}</span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
