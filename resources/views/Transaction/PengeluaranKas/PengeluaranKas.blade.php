@extends('layouts.Mainlayouts')
@section('title')
    <h1>{{ __('Pengeluaran Kas') }}</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-12 text-right">
                        <a href=" {{ route('Pengeluaran.add') }} " class="btn btn-info"><i class='fas fa-plus'> Tambah
                                Data
                            </i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-sm-12 col-md-12">
                        <form method="POST" action="javascript:void(0)" id="formSearchPengeluaranKas">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="">Tanggal (bulan/tahun)</label>
                                    <div class="form-group">
                                        <input type="text" name="tanggal" id="tanggal" class="form-control"
                                            autocomplete="off">
                                        <div class="invalid-feedback" id="feedbackIdktgBrg">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="">ID Pengeluaran Kas</label>
                                    <div class="form-group">
                                        <input type="text" name="id_pengeluaranKas" id="id_pengeluaranKas"
                                            class="form-control">
                                        <div class="invalid-feedback" id="feedbackNmKtgBrg">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="text-right">
                                        <button class="btn btn-info btn-sm" id="btnSearchChck"><i class="fas fa-search"></i>
                                            Search</button>
                                        <button class="btn btn-secondary btn-sm" id="clearIdChck"><i
                                                class="fas fa-cycle"></i>
                                            Clear</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="alert alert-primary" id="loaderChck" style="display:none" role="alert">
                            Mohon tunggu <i class="fas fa-spinner fa-pulse"></i>
                        </div>
                        <div id="dataListChck">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-script')
    <script>
        $(document).ready(function() {
            pageload();
            $("#tanggal").datepicker({
                format: "yyyy-mm",
                viewMode: "months",
                minViewMode: "months"
            })
        });

        // function resetModal() {
        //     $('#detailListPengeluaranKas').html("");
        // }



        function pageload() {
            $.ajax({
                type: "post",
                url: "{{ route('Pengeluaran.Read') }}",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                dataType: "html",
                beforeSend: function() {
                    $('#loaderChck').fadeIn('slow');
                },
                success: function(response) {
                    $('#loaderChck').fadeOut('slow');
                    $('#dataListChck').html(response);
                    $("#table-1").DataTable({
                        searching: false,
                    });
                }
            });
        }
    </script>
@endpush
