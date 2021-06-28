@extends('layouts.MainLayouts')

@section('content')
    <div class="container mt-3">
        <h1 class="text-center" id="judul">Edit Data Pegawai </h1>
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('Pegawai.update', ['Pegawai' => $pegawai->id] ) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="mb-3">
                                <label for="nama_pegawai" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_pegawai" class="form-control" id="nama_pegawai" value="{{ old('nama_pegawai') ?? $pegawai->nama_pegawai }}">
                                @error('nama_pegawai')
                                    <div class="alert alert-warning mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio1" value="Laki-laki" {{ ($pegawai->jenis_kelamin == "Laki-laki")? "checked" : "" }}>
                                    <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio2" value="Perempuan" {{ ($pegawai->jenis_kelamin == "Perempuan")? "checked" : "" }}>
                                    <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                </div>
                                @error('jenis_kelamin')
                                    <div class="alert alert-warning mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" value="{{ old('tempat_lahir') ?? $pegawai->tempat_lahir }}">
                                @error('tempat_lahir')
                                    <div class="alert alert-warning mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" value="{{ old('tanggal_lahir') ?? $pegawai->tanggal_lahir }}">
                                @error('tanggal_lahir')
                                    <div class="alert alert-warning mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat" class="form-control" id="alamat" value="{{ old('alamat') ?? $pegawai->alamat }}">
                                @error('alamat')
                                    <div class="alert alert-warning mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>           
            </div>
        </div>
    </div>
@endsection