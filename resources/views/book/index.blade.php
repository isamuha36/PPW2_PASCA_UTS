@extends('book.layouts')

@section('title', 'Data Buku')

@section('content')
<a href="{{route('buku.create')}}" class="btn btn-primary float-end">Tambah Buku</a>
<table class="table table-stripped">
    <thead>
        <tr>
            <th>id</th>
            <th>Judul Buku</th>
            <th>Penulis</th>
            <th>Harga</th>
            <th>Tanggal Terbit</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data_buku as $buku)
            <tr>
                <td>{{ $buku->id }}</td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>{{ "Rp. ".number_format($buku->harga, 2,',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}</td>
                <td>
                    <form action="{{route('buku.destroy', $buku->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin mau dihapus?')" type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                    <a href="{{route('buku.edit', $buku->id)}}" class="btn btn-primary">Edit</a>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tr>
        <td colspan="3">
            Total Buku
        </td>
        <td>
            {{ $total_buku }}
        </td>
    </tr>
    <tr>
        <td colspan="3">
            Total Harga
        </td>
        <td>
            {{ "Rp. ".number_format($total_harga, 2,',', '.')}}
        </td>
    </tr>
</table>
@endsection