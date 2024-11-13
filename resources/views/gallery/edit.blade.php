<!-- resources/views/Book/create.blade.php -->
@extends('user.layouts')

@section('title', 'Tambah User')

@section('content')
    <h1>Edit Gambar</h1>

    <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $gallery->title }}" required>
            @if ($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
                <div class="alert alert-danger">{{ $message }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ $gallery->description }}</textarea>
            @if ($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
                <div class="alert alert-danger">{{ $message }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="picture">Choose Image</label>
            <input type="file" name="picture" id="picture" class="form-control" value="{{ $gallery->picture }}">
            @if ($errors->has('picture'))
                <span class="text-danger">{{ $errors->first('picture') }}</span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
