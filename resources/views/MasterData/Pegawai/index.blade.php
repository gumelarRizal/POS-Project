@extends('layouts.MainLayouts')
@section('content')
    <div class="container mt-3">
        <h1 class="text-center" id="judul">Data Pegawai</h1>
        <div class="row mt-3">
            <div class="col">
                <a href="{{ route('Pegawai.create') }}" class="btn btn-success">Tambah</a>
            </div>
            <div class="col">
                <form action="{{ route('Pegawai.search') }}" method="GET">
                    <div class="form-group-sm text-right">
                        <input type="text" name="cari" placeholder="input nama atau id pegawai ..">
                        <button type="submit" class="btn btn-success">Pencarian</button>
                    </div>
                </form>
            </div>           
        </div>
        @if (session()->has('success'))
            <div class="mt-3">
                <div class="alert alert-light w" role="alert">
                    <p class="text-center"><strong>{{ session()->get('success') }}</strong></p>
                </div>
            </div>
        @endif
        <div class="card mt-2">
            <div class="card-title">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID Pegawai</th>
                            <th>Nama Pegawai</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pegawai as $items)
                            <tr>
                                <td>{{ $pegawai->firstItem() + $loop->iteration - 1 }}</td>
                                <td class="text-center">{{ $items->id_pegawai }}</td>
                                <td>{{ $items->nama_pegawai }}</td>
                                <td>{{ $items->jenis_kelamin }}</td>
                                <td>{{ $items->alamat }}</td>
                                <td>
                                    <div class="row justify-content-center inline">
                                        <a href="{{ route('Pegawai.edit', ['Pegawai' => $items->id]) }}" class="btn btn-primary">Ubah</a>
                                        <form class="mx-2" action="{{ route('Pegawai.destroy', ['Pegawai' => $items->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="colspan-6">No data Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="row">
                    <div class="mx-auto mt-3">
                        {{ $pegawai->links() }} 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection