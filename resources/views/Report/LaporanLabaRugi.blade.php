@extends('layouts.ReportTransLayout')
@section('title')
    <h1>{{ __('Biodata') }}</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-12 ">
                        <h4>Laporan Laba Rugi</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="javascript:void(0)" id="formSearchPengeluaranKas">
                        <div class="col-sm-12 col-md-12 text-right">
                            @csrf
                            <div class="form-group row mb-4">
                                <label for="">Tanggal (bulan/tahun)</label>
                                <div class="col-sm-4 col-md-4">
                                    <input type="text" name="tanggal" id="tanggal" class="form-control" autocomplete="off">
                                </div>
                                <div class="col-sm-2 col-md-2 text-left">
                                    <button class="btn btn-info btn-sm" id="btnSearchChck"><i class="fas fa-search"></i>
                                        Search</button>
                                    <button class="btn btn-secondary btn-sm" id="clearIdChck"><i class="fas fa-cycle"></i>
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
@endsection
@push('after-script')
    <script>
        $(document).ready(function() {
            pageLoad();
            $("#tanggal").datepicker({
                format: "yyyy-mm",
                viewMode: "months",
                minViewMode: "months"
            })
        });

        function pageLoad() {
            $.ajax({
                type: "post",
                url: "{{ route('Report.LabaRead') }}",
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
                }
            });
        }
    </script>
@endpush
