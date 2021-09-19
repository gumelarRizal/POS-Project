@extends('layouts.MainLayouts')
@section('title')
    <h1>{{ __('Laporan Presensi') }}</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('List Presensi Karyawan') }}</h4>
                </div>
                <div class="card-body">
                    <div class="col-sm-12">
                        <form method="POST" action="javascript:void(0)" id="formSearch">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="">Nama Karyawan</label>
                                    <div class="form-group">
                                        <select name="userName" id="userName" class="form-control">
                                            <option value="" disabled selected>--pilih nama karyawan--</option>
                                            @foreach ($cmbUser as $item)
                                                <option value="{{ $item->id }}"> {{ $item->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="">Tanggal (Bulan/Tahun)</label>
                                    <div class="form-group">
                                        <input type="text" name="tanggal" id="tanggal" class="form-control"
                                            autocomplete="off">
                                        <div class="invalid-feedback" id="feedbackNamamenu">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">

                                </div>
                                <div class="col-sm-6">
                                    <div class="text-right">
                                        <button class="btn btn-info btn-sm" id="btnSearch"><i class="fas fa-search"
                                                id="search"></i>
                                            Search</button>
                                        <button class="btn btn-secondary btn-sm" id="clearId" onclick="pageload()"><i
                                                class="fas fa-cycle"></i>
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
                        <div id="dataList">

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
                $("#tanggal").datepicker({
                    format: "yyyy-mm",
                    viewMode: "months",
                    minViewMode: "months"
                })

                $("#btnSearch").click(function() {
                    var flagErr = 0;
                    var idPeagawi = $("#userName").val();
                    var tanggal = $("#tanggal").val();
                    // if (!idMenu) {
                    //     $("#id_barang").addClass("is-invalid");
                    //     $("#feedbackIdmenu").html("Kolom Id Menu tidak boleh kosong");
                    //     flagErr = 1
                    // }
                    // if (!idMenu) {
                    //     $("#nama_barang").addClass("is-invalid");
                    //     $("#feedbackNamamenu").html("Kolom Nama Menu tidak boleh kosong");
                    //     flagErr = 1
                    // }
                    if (flagErr == 0) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            method: "post",
                            url: "{{ route('presensi.list') }}",
                            data: $("#formSearch").serialize(),
                            dataType: "html",
                            beforeSend: function() {
                                $('#loader').fadeIn('slow');
                            },
                            success: function(response) {
                                $('#loader').fadeOut('slow');
                                $('#dataList').html(response);
                                // $("#id_barang").removeClass("is-invalid");
                                // $("#nama_barang").removeClass("is-invalid");
                                $("#table-presensi").DataTable({
                                    searching: false,
                                });
                            }
                        });
                    }
                });
            });

            function pageload() {
                $("#userName").val('');
                $("#tanggal").val('');
                $.ajax({
                    method: "post",
                    url: "{{ route('presensi.list') }}",
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
                        $("#table-presensi").DataTable({
                            searching: false,
                        });
                    }
                });
            }
        </script>
    @endpush
@endsection
