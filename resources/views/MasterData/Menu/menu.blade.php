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
                                        <input type="text" name="id_menu" id="id_menu" class="form-control">
                                        <div class="invalid-feedback" id="feedbackIdmenu">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="">Nama Menu Menu</label>
                                    <div class="form-group">
                                        <input type="text" name="nama_menu" id="nama_menu" class="form-control">
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

                $("#addModal").on("click", function() {
                    $("#exampleModalLabel").html("Tambah Data Menu");
                });

                $("#btnSearch").click(function() {
                    var flagErr = 0;
                    var idMenu = $("#id_menu").val();
                    var namaMenu = $("#nama_menu").val();
                    if (!idMenu) {
                        $("#id_menu").addClass("is-invalid");
                        $("#feedbackIdmenu").html("Kolom Id Menu tidak boleh kosong");
                        flagErr = 1
                    }
                    if (!idMenu) {
                        $("#nama_menu").addClass("is-invalid");
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
                                $("#id_menu").removeClass("is-invalid");
                                $("#nama_menu").removeClass("is-invalid");
                                $("#table-1").DataTable({
                                    searching: false,
                                });
                            }
                        });
                    }
                });

                $("#clearId").click(function(e) {
                    e.preventDefault();
                    $("#id_menu").val("");
                    $("#nama_menu").val("");
                    $("#id_menu").removeClass("is-invalid");
                    $("#nama_menu").removeClass("is-invalid");
                    pageload();
                });

                $("#saveChanges").click(function(e) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    console.log($("#formMenu").serialize());
                    $.ajax({
                        url: "{{ route('Menu.store') }}",
                        method: "post",
                        data: $("#formMenu").serialize(),
                        success: function(resp) {
                            swal("Berhasil", resp.msg, "success");
                            resetModal()
                            $("#exampleModal").modal("hide");
                            pageload();
                        }
                    })
                })
            });

            function getEdit(id, id_menu, nama, harga) {
                $("#exampleModal").modal("show");
                $("#exampleModalLabel").html("Edit Data Menu");
                $("#formId").val(id);
                $("#form-id_menu").val(id_menu);
                $("#form-nama_menu").val(nama);
                $("#harga").val(harga);
            }

            function resetModal() {
                $("#formId").val("");
                $("#form-id_menu").val("");
                $("#form-nama_menu").val("");
                $("#harga").val("");
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
