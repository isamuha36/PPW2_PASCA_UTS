@extends('gallery.layouts')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <a href="{{ route('gallery.create') }}" class="btn btn-primary mb-3">Tambah Gambar</a>
            <div class="card">
                <div class="card-header">Gallery</div>
                <div class="card-body">
                    <div class="row" id="gallery">
                        {{-- @if (count($galleries) > 0)
                            @foreach ($galleries as $gallery)
                                <div class="col-sm-2">
                                    <div>
                                        <a class="example-image-link"
                                            href="{{ asset('storage/posts_image/' . $gallery->picture) }}"
                                            data-lightbox="roadtrip" data-title="{{ $gallery->description }}">
                                            <img class="example-image img-fluid mb-2"
                                                src="{{ asset('storage/posts_image/' . $gallery->picture) }}"
                                                alt="image-1" />
                                        </a>
                                    </div>
                                    <a href="{{ route('gallery.edit', $gallery->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('gallery.destroy', $gallery->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                                    </form>
                                </div>
                            @endforeach
                        @else
                            <h3>Tidak ada data.</h3>
                        @endif --}}
                        <div class="d-flex">
                        </div>
                        {{-- {{ $galleries->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $.get('{{ route('gallery') }}', function(response) {
            console.log('Response dari API:', response);
            if (response['data']) {
                var html = '';
                response['data'].forEach(function(gallery) {
                    html += `
                        <div class="col-sm-2">
                            <div>
                                <a class="example-image-link" href="/storage/posts_image/${gallery.picture}" data-lightbox="roadtrip" data-title="${gallery.description}">
                                    <img class="example-image img-fluid mb-2" src="/storage/posts_image/${gallery.picture}" alt="${gallery.title}" width="200" />
                                </a>
                            </div>
                        </div>`;
                });
                console.log('HTML yang akan dimasukkan:', html);
                $('#gallery').html(html);
            } else {
                $('#gallery').html('<h3>Tidak ada data.</h3>');
            }
            }).fail(function() {
                console.error('Gagal memuat data dari API.');
                $('#gallery').html('<h3>Gagal memuat data dari API.</h3>');
            });
        });
    </script>
@endsection