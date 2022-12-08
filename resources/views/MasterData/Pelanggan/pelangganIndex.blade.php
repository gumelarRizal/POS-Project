@extends('layouts.MainLayouts')
@section('title')
    <h1>{{ __('Master Pelanggan') }}</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('List Pelanggan') }}</h4>
                </div>
                <div class="card-body">
                    <div class="col-sm-12">
                        <form method="POST" action="javascript:void(0)" id="formSearch">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="">No Telp</label>
                                    <div class="form-group">
                                        <input type="text" name="notelp" id="notelp" class="form-control">
                                        <div class="invalid-feedback" id="feedbacknoTelp">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="">Nama Pelanggan</label>
                                    <div class="form-group">
                                        <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control">
                                        <div class="invalid-feedback" id="feedbackNamaPelanggan">

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
                    <div class="col-sm-12">
                        <div class="alert alert-primary" id="loader" style="display:none" role="alert">
                            Mohon tunggu <i class="fas fa-spinner fa-pulse"></i>
                        </div>
                        <div id="dataList"></div>
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

                $("#addModal").on("click", function() {
                    $("#exampleModalLabel").html("Tambah Data Pelanggan");
                });

                $("#btnSearch").click(function() {
                    var flagErr = 0;
                    var noTelp = $("#notelp").val();
                    var namaMenu = $("#nama_pelanggan").val();
                    if (noTelp == "" && namaMenu == "") {
                        $("#notelp").addClass("is-invalid");
                        $("#feedbacknoTelp").html("Kolom No Telfon tidak boleh kosong");
                        $("#nama_pelanggan").addClass("is-invalid");
                        $("#feedbackNamaPelanggan").html("Kolom Nama Pelanggan tidak boleh kosong");
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
                            url: "{{ route('Pelanggan.read') }}",
                            data: $("#formSearch").serialize(),
                            dataType: "html",
                            beforeSend: function() {
                                $('#loader').fadeIn('slow');
                            },
                            success: function(response) {
                                $('#loader').fadeOut('slow');
                                $('#dataList').html(response);
                                $("#notelp").removeClass("is-invalid");
                                $("#nama_pelanggan").removeClass("is-invalid");
                                $("#table-1").DataTable({
                                    searching: false,
                                });
                            }
                        });
                    }
                });

                $("#clearId").click(function(e) {
                    e.preventDefault();
                    $("#notelp").val("");
                    $("#nama_pelanggan").val("");
                    $("#notelp").removeClass("is-invalid");
                    $("#nama_pelanggan").removeClass("is-invalid");
                    pageload();
                });

                $("#saveChanges").click(function(e) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var formSerialize = $("#formPelanggan").serialize();
                    console.log(formSerialize);
                    $.ajax({
                        url: "{{ route('Pelanggan.store') }}",
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

            function getEdit(id, nama_pelanggan, email, no_telp, alamat) {
                $("#exampleModal").modal("show");
                $("#exampleModalLabel").html("Edit Data Barang");
                $("#formId").val(id);
                $("#form-nama_pelanggan").val(nama_pelanggan);
                $("#form-email").val(email);
                $("#form-no_telp").val(no_telp);
                $("#alamat").val(alamat);
            }

            function resetModal() {
                $("#formId").val("");
                $("#form-nama_pelanggan").val("");
                $("#form-email").val("");
                $("#form-no_telp").val("");
                $("#alamat").val("");
            }

            function pageload() {
                $.ajax({
                    method: "post",
                    url: "{{ route('Pelanggan.read') }}",
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
    @include('MasterData.Pelanggan.ModalPelanggan')
@endsection
