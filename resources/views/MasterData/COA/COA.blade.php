@extends('layouts.MainLayouts')
@section('title')
    <h1>{{ __('Master Chart of Account') }}</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('List Data Chart of Account') }}</h4>
                </div>
                <div class="card-body">
                    <div class="col-sm-12">
                        <form method="POST" action="javascript:void(0)" id="formSearch">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="">Kode COA</label>
                                    <div class="form-group">
                                        <input type="text" name="id_COA" id="id_COA" class="form-control">
                                        <div class="invalid-feedback" id="feedbackIdCOA">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="">Nama COA</label>
                                    <div class="form-group">
                                        <input type="text" name="nama_COA" id="nama_COA" class="form-control">
                                        <div class="invalid-feedback" id="feedbackNmCOA">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="text-left">
                                        <button type="button" id="addModalCOA" class="btn btn-primary" data-toggle="modal"
                                            data-target="#COAModal">
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
                $("#COAModal").on("hidden.bs.modal", function() {
                    resetModal();
                });
                $("#addModalCOA").on("click", function() {
                    $("#COAModalLabel").html("Tambah Data COA");
                });

                $("#btnSearch").click(function() {
                    var flagErr = 0;
                    var idMenu = $("#id_COA").val();
                    var namaMenu = $("#nama_COA").val();
                    if (!idMenu) {
                        $("#id_COA").addClass("is-invalid");
                        $("#feedbackIdCOA").html("Kolom Kode COA tidak boleh kosong");
                        flagErr = 1
                    }
                    if (!idMenu) {
                        $("#nama_COA").addClass("is-invalid");
                        $("#feedbackNmCOA").html("Kolom Nama Kategori Barang tidak boleh kosong");
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
                            url: "{{ route('COA.Read') }}",
                            data: $("#formSearch").serialize(),
                            dataType: "html",
                            beforeSend: function() {
                                $('#loader').fadeIn('slow');
                            },
                            success: function(response) {
                                $('#loader').fadeOut('slow');
                                $('#dataList').html(response);
                                $("#id_COA").removeClass("is-invalid");
                                $("#nama_COA").removeClass("is-invalid");
                                $("#table-1").DataTable({
                                    searching: false,
                                });
                            }
                        });
                    }
                });

                $("#clearId").click(function(e) {
                    e.preventDefault();
                    $("#id_COA").val("");
                    $("#nama_COA").val("");
                    $("#id_COA").removeClass("is-invalid");
                    $("#nama_COA").removeClass("is-invalid");
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
                        url: "{{ route('COA.Store') }}",
                        method: "post",
                        data: formSerialize,
                        success: function(resp) {
                            swal("Berhasil", resp.msg, "success");
                            resetModal()
                            $("#COAModal").modal("hide");
                            pageload();
                        }
                    })
                })
            });

            function getEdit(id, id_COA, nama) {
                $("#COAModal").modal("show");
                $("#COAModalLabel").html("Edit Data Barang");
                $("#formId").val(id);
                $("#form-id_coa").val(id_COA);
                $("#form-nama_coa").val(nama);
            }

            function resetModal() {
                $("#formId").val("");
                $("#form-id_coa").val("");
                $("#form-nama_coa").val("");
            }

            function pageload() {
                $.ajax({
                    method: "post",
                    url: "{{ route('COA.Read') }}",
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
                        $("#table-COA").DataTable({
                            searching: false,
                        });
                    }
                });
            }
        </script>
    @endpush
@endsection
@section('modal')
    @include('MasterData.COA.modalCOA')
@endsection
