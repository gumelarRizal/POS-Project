@extends('layouts.MainLayouts')
@section('title')
    <h1>{{ __('Master Kategori Barang') }}</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('List Data Kategori Barang') }}</h4>
                </div>
                <div class="card-body">
                    <div class="col-sm-12">
                        <form method="POST" action="javascript:void(0)" id="formSearch">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="">Kode Kategori Barang</label>
                                    <div class="form-group">
                                        <input type="text" name="id_kategori_barang" id="id_kategori_barang"
                                            class="form-control">
                                        <div class="invalid-feedback" id="feedbackIdktgBrg">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="">Nama Kategori Barang</label>
                                    <div class="form-group">
                                        <input type="text" name="nama_kategori_barang" id="nama_kategori_barang"
                                            class="form-control">
                                        <div class="invalid-feedback" id="feedbackNmKtgBrg">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="text-left">
                                        <button type="button" id="addModalKtgBrg" class="btn btn-primary"
                                            data-toggle="modal" data-target="#ktgBrgModal">
                                            <i class="fas fa-plus"></i>
                                            Add
                                        </button>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-right">
                                        <button class="btn btn-info btn-sm" id="btnSearch"><i class="fas fa-search"
                                                id="search"></i>
                                            Search</button>
                                        <button class="btn btn-secondary btn-sm" id="clearId"><i class="fas fa-cycle"></i>
                                            Clear</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </div>
                    <div class="col-sm-12" id="dataList">
                        <div class="alert alert-primary" id="loader" style="display:none" role="alert">
                            Mohon tunggu <i class="fas fa-spinner fa-pulse"></i>
                        </div>
                        {{-- @include('MasterData.Menu.menuList') --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('after-script')
        <script>
            $(document).ready(function() {
                pageload();

                $("#addModalKtgBrg").on("click", function() {
                    $("#ktgBrgModalLabel").html("Tambah Data Kategori Barang");
                });

                $("#btnSearch").click(function() {
                    var flagErr = 0;
                    var idMenu = $("#id_kategori_barang").val();
                    var namaMenu = $("#nama_kategori_barang").val();
                    if (!idMenu) {
                        $("#id_kategori_barang").addClass("is-invalid");
                        $("#feedbackIdktgBrg").html("Kolom Kode Kategori Barang tidak boleh kosong");
                        flagErr = 1
                    }
                    if (!idMenu) {
                        $("#nama_kategori_barang").addClass("is-invalid");
                        $("#feedbackNmKtgBrg").html("Kolom Nama Kategori Barang tidak boleh kosong");
                        flagErr = 1
                    }
                    if (flagErr == 0) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            method: "post",
                            url: "{{ route('KtgBrg.Read') }}",
                            data: $("#formSearch").serialize(),
                            dataType: "html",
                            beforeSend: function() {
                                $('#loader').fadeIn('slow');
                            },
                            success: function(response) {
                                $('#loader').fadeOut('slow');
                                $('#dataList').html(response);
                                $("#id_kategori_barang").removeClass("is-invalid");
                                $("#nama_kategori_barang").removeClass("is-invalid");
                                $("#table-1").DataTable({
                                    searching: false,
                                });
                            }
                        });
                    }
                });

                $("#clearId").click(function(e) {
                    e.preventDefault();
                    $("#id_kategori_barang").val("");
                    $("#nama_kategori_barang").val("");
                    $("#id_kategori_barang").removeClass("is-invalid");
                    $("#nama_kategori_barang").removeClass("is-invalid");
                    pageload();
                });

                $("#saveChanges").click(function(e) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var formSerialize = $("#formMenu").serialize();
                    console.log(formSerialize);
                    $.ajax({
                        url: "{{ route('KtgBrg.Store') }}",
                        method: "post",
                        data: formSerialize,
                        success: function(resp) {
                            swal("Berhasil", resp.msg, "success");
                            resetModal()
                            $("#ktgBrgModal").modal("hide");
                            pageload();
                        }
                    })
                })
            });

            function getEdit(id, id_kategori_barang, nama) {
                $("#ktgBrgModal").modal("show");
                $("#ktgBrgModalLabel").html("Edit Data Barang");
                $("#formId").val(id);
                $("#form-id_kategori_barang").val(id_kategori_barang);
                $("#form-nama_kategori_barang").val(nama);
                $("#harga").val(harga);
                $("#stok").val(stok);
                $("#satuan").val(satuan);
            }

            function resetModal() {
                $("#formId").val("");
                $("#form-id_kategori_barang").val("");
                $("#form-nama_kategori_barang").val("");
                $("#harga").val("");
                $("#stok").val("");
                $("#satuan").val("");
            }

            function pageload() {
                $.ajax({
                    method: "post",
                    url: "{{ route('KtgBrg.Read') }}",
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: "html",
                    beforeSend: function() {
                        $('#loader').fadeIn('slow');
                    },
                    success: function(response) {
                        $('#loader').fadeOut('slow');
                        $('#dataList').html(response);
                        $("#table-ktgBrg").DataTable({
                            searching: false,
                        });
                    }
                });
            }
        </script>
    @endpush
@endsection
@section('modal')
    @include('MasterData.KategoriBarang.modalKtgBrg')
@endsection
