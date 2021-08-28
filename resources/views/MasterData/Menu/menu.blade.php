@extends('layouts.MainLayouts')
@section('title')
    <h1>{{ __('Master Data Menu') }}</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('List Data Menu') }}</h4>
                </div>
                <div class="card-body">
                    <div class="col-sm-12">
                        <form method="POST" action="javascript:void(0)" id="formSearch">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="">Kode Menu</label>
                                    <div class="form-group">
                                        <input type="text" name="id_barang" id="id_barang" class="form-control">
                                        <div class="invalid-feedback" id="feedbackIdmenu">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="">Nama Menu Menu</label>
                                    <div class="form-group">
                                        <input type="text" name="nama_barang" id="nama_barang" class="form-control">
                                        <div class="invalid-feedback" id="feedbackNamamenu">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="text-left">
                                        <button type="button" id="addModal" class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModal">
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
                set_mask2();

                $("#addModal").on("click", function() {
                    $("#exampleModalLabel").html("Tambah Data Barang");
                });

                $("#btnSearch").click(function() {
                    var flagErr = 0;
                    var idMenu = $("#id_barang").val();
                    var namaMenu = $("#nama_barang").val();
                    if (!idMenu) {
                        $("#id_barang").addClass("is-invalid");
                        $("#feedbackIdmenu").html("Kolom Id Menu tidak boleh kosong");
                        flagErr = 1
                    }
                    if (!idMenu) {
                        $("#nama_barang").addClass("is-invalid");
                        $("#feedbackNamamenu").html("Kolom Nama Menu tidak boleh kosong");
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
                            url: "{{ route('Menu.Read') }}",
                            data: $("#formSearch").serialize(),
                            dataType: "html",
                            beforeSend: function() {
                                $('#loader').fadeIn('slow');
                            },
                            success: function(response) {
                                $('#loader').fadeOut('slow');
                                $('#dataList').html(response);
                                $("#id_barang").removeClass("is-invalid");
                                $("#nama_barang").removeClass("is-invalid");
                                $("#table-1").DataTable({
                                    searching: false,
                                });
                            }
                        });
                    }
                });

                $("#clearId").click(function(e) {
                    e.preventDefault();
                    $("#id_barang").val("");
                    $("#nama_barang").val("");
                    $("#id_barang").removeClass("is-invalid");
                    $("#nama_barang").removeClass("is-invalid");
                    pageload();
                });

                $("#saveChanges").click(function(e) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var harga = $("#harga").val(),
                        stok = $("#stok").val(),
                        hargaJual = $("#hargaJual").val().replace(/\./g, ""),
                        hargaMask = harga.replace(/\./g, ""),
                        stokMask = stok.replace(/\./g, ""),
                        formSerialize = $("#formMenu").serialize();
                    formSerialize = formSerialize + "&" + "hargaMask=" + hargaMask;
                    formSerialize = formSerialize + "&" + "hargaJual=" + hargaJual;
                    formSerialize = formSerialize + "&" + "stokMask=" + stokMask;
                    console.log(formSerialize);
                    $.ajax({
                        url: "{{ route('Menu.store') }}",
                        method: "post",
                        data: formSerialize,
                        success: function(resp) {
                            swal("Berhasil", resp.msg, "success");
                            resetModal()
                            $("#exampleModal").modal("hide");
                            pageload();
                        }
                    })
                })
            });

            function getEdit(id, id_barang, nama, harga, hargaJual, stok, satuan, ktg) {
                $("#exampleModal").modal("show");
                $("#exampleModalLabel").html("Edit Data Barang");
                $("#formId").val(id);
                $("#form-id_kategori_barang").val(ktg).attr('selected', 'selected');
                $("#form-nama_barang").val(nama);
                $("#harga").val(harga);
                $("#hargaJual").val(hargaJual);
                $("#stok").val(stok);
                $("#satuan").val(satuan);
            }

            function resetModal() {
                $("#formId").val("");
                $("#form-nama_barang").val("");
                $("#form-id_kategori_barang").val("");
                $("#harga").val("");
                $("#hargaJual").val("");
                $("#stok").val("");
                $("#satuan").val("");
            }

            function pageload() {
                $.ajax({
                    method: "post",
                    url: "{{ route('Menu.Read') }}",
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
                        $("#table-1").DataTable({
                            searching: false,
                        });
                    }
                });
            }
        </script>
    @endpush
@endsection
@section('modal')
    @include('MasterData.Menu.modalMenu')
@endsection
