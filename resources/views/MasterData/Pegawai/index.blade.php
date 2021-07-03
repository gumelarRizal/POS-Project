@extends('layouts.MainLayouts')
@section('content')

@php
    $titleBreadcrump = "pegawai"; 
@endphp
    <div class="container mt-3">
        <h1 class="text-center" id="judul">Data Pegawai</h1>
        <div class="row mt-3">
            <div class="col">
                <button type="button" id="tambahModal" class="btn btn-primary"
                onclick="add()"><i class="fas fa-plus"></i>
                Add
                </button>
            </div>
            <div class="col">
                <form action="{{ route('Pegawai.search') }}" method="GET">
                    <div class="form-group-sm text-right">
                        <input type="text" name="cari" placeholder="input nama atau id pegawai ..">
                        <button type="submit" class="btn btn-success"><i class="fas fa-search"></i> Search</button>
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
                <table class="table table-striped table-bordered table-md" id="tabelpegawai">
                    <thead class="text-center">
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
                                <td class="text-center">{{ $pegawai->firstItem() + $loop->iteration - 1 }}</td>
                                <td class="text-center">{{ $items->id_pegawai }}</td>
                                <td>{{ $items->nama_pegawai }}</td>
                                <td>{{ $items->jenis_kelamin }}</td>
                                <td>{{ $items->alamat }}</td>
                                <td>
                                    <div class="row justify-content-center">
                                        <button type="button" id="editModal" class="btn btn-primary"
                                            onclick="edit({{ $items->id }}, '{{ $items->id_pegawai }}', '{{ $items->nama_pegawai }}', '{{ $items->jenis_kelamin }}', '{{ $items->tempat_lahir }}', '{{ $items->tanggal_lahir }}', '{{ $items->alamat }}')"><i class="fas fa-pen"></i>
                                            Edit 
                                        </button> &nbsp;
                                        <button type="button" class="btn btn-danger" onclick="hapus({{ $items->id }})"><i class="fas fa-trash"></i> Hapus</button>
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

    <!-- Modal Add-->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Pegawai</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-12">
                <form action="" id="pegawaiForm">
                    @csrf
                    <div class="form-group">
                        <label for="id_pegawai" class="form-label">ID Pegawai</label>
                        <input type="text" class="form-control" name="id_pegawai" id="id_pegawai" value="">
                    </div>
                    <div class="form-group">
                        <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                        <input type="text" class="form-control"  name="nama_pegawai" id="nama_pegawai" value="">
                    </div>
                    <div class="form-group">
                        <label for="jkPegawai" class="form-label">Jenis Kelamin</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio1" value="Laki-laki">
                            <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio2" value="Perempuan">
                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tmpPegawai" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="text" class="form-control datepicker" name="tanggal_lahir" id="tanggal_lahir">
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea  class="form-control" name="alamat" id="alamat" rows="3"></textarea>
                    </div>
                </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="simpan">Simpan</button>
            </div>
        </div>
        </div>
    </div>
    {{-- modal edit --}}
    <div class="modal fade" id="exampleModalLong1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle1" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle1">Edit Data Pegawai</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-10">
                <form action="" id="pegawaiFormEdit">
                    @csrf
                    <input type="hidden" name="id" id="id" value="">
                    <div class="form-group">
                        <label for="id_pegawai" class="form-label">ID Pegawai</label>
                        <input type="text" class="form-control" name="id_pegawai" id="peg" value="" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                        <input type="text" class="form-control"  name="nama_pegawai" id="nama" value="">
                    </div>
                    <div class="form-group">
                        <label for="jkPegawai" class="form-label">Jenis Kelamin</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk1" value="Laki-laki">
                            <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk2" value="Perempuan">
                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tmpPegawai" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" id="tmp" value="">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="text" class="form-control datepicker" name="tanggal_lahir" id="tgl" value="">
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea  class="form-control" name="alamat" id="almt" rows="3"></textarea>
                    </div>
                </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="edit">Simpan</button>
            </div>
        </div>
        </div>
    </div>

    {{-- modal delete --}}
    
    @push('after-script')
    <script>
        $(document).ready(function(){
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });

            $('#simpan').click(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url : "{{ route('Pegawai.store') }}",
                    type : 'POST',
                    data : $('#pegawaiForm').serialize(),
                    success : function(respon){
                        swal("Berhasil", "data berhasil ditambahkan", "success");
                        resetPegawaiModal();
                        $('#exampleModalLong').modal('hide');
                        location.reload();
                    },
                    error : function(respon){
                        swal("Gagal", "data tidak berhasil ditambahkan", "error");
                    }
                });
            });

            $('#edit').click(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var id = $('#id').val();
                $.ajax({
                    url : "{{ route('Pegawai.store') }}",
                    type : 'POST',
                    data : $('#pegawaiFormEdit').serialize(),
                    success : function(respon){
                        swal("Berhasil", "data berhasil diupdate", "success");
                        resetPegawaiModal();
                        $('#exampleModalLong1').modal('hide');
                        location.reload();
                    },
                    error : function(respon){
                        swal("Gagal", "data tidak berhasil diupdate", "error");
                    }
                });
            });
        

        });

        function add(){
            $('#pegawaiForm').trigger("reset");
            $('#exampleModalLong').appendTo("body").modal('show');
        }

        function edit(id,peg,nama,jk,tmp,tgl,alamat){
            $('#exampleModalLong1').appendTo("body").modal('show');
            $('#id').val(id);
            $('#peg').val(peg);
            $('#nama').val(nama);
            if(jk == "Laki-laki"){
                $('#jk1').prop('checked', true);
            }else{
                $('#jk2').prop('checked', true);
            }
            $('#tmp').val(tmp);
            $('#tgl').val(tgl);
            $('#almt').val(alamat);
            
        }

        function resetPegawaiModal(){
            $('#id').val('');
            $('#id_pegawai').val('');
            $('#nama_pegawai').val('');
            $('input[name="jenis_kelamin"]').prop('checked', false);
            $('#tempat_lahir').val('');
            $('#tanggal_lahir').val('');
            $('#alamat').val('');
        }

        function hapus(id){
            if (confirm("Anda yakin menghapus data?") == true) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var id = id;
                $.ajax({
                    url : "{{ route('Pegawai.delete') }}",
                    type : 'POST',
                    data : { id : id},
                    success : function(respon){
                        swal("Berhasil", "data berhasil dihapus", "success");
                        location.reload();
                    },
                    error : function(respon){
                        swal("Gagal", "data tidak berhasil dihapus", "error");
                    }
                });
            }
        }
    </script>    
    @endpush

    
@endsection