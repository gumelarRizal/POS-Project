@extends('layouts.Mainlayouts')
@section('title')
    <h1>{{ __('Laporan Penjualan') }}</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="nav-chckPenj" data-toggle="tab" href="#chckPenj" role="tab"
                                aria-controls="home" aria-selected="true">Laporan Checkout Pesanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="nav-custPenj" data-toggle="tab" href="#custPenj" role="tab"
                                aria-controls="profile" aria-selected="false">Laporan Custom Pesanan</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">

                    <div class="col-sm-12">
                        <div class="tab-content" id="myTabContent2">
                            <div class="tab-pane fade active show" id="chckPenj" role="tabpanel"
                                aria-labelledby="home-tab3">
                                <div class="col-md-12 col-sm-12">
                                    <form method="POST" action="javascript:void(0)" id="formChckPnj">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="">Tanggal (bulan/tahun)</label>
                                                <div class="form-group">
                                                    <input type="text" name="tanggalChck" id="tanggalChck"
                                                        class="form-control" autocomplete="off">
                                                    <div class="invalid-feedback" id="feedbackIdktgBrg">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="">ID Transaksi</label>
                                                <div class="form-group">
                                                    <input type="text" name="nama_kategori_barang" id="id_transChck"
                                                        class="form-control">
                                                    <div class="invalid-feedback" id="feedbackNmKtgBrg">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="">Kasir</label>
                                                <div class="form-group">
                                                    <select name="kasir" id="kasir" class="form-control">
                                                        <option disabled selected>--pilih kasir--</option>
                                                        @foreach ($cashier as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback" id="feedbackNmKtgBrg">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="text-right">
                                                    <button class="btn btn-info btn-sm" id="btnSearchChck"><i
                                                            class="fas fa-search"></i>
                                                        Search</button>
                                                    <button class="btn btn-secondary btn-sm" id="clearIdChck"><i
                                                            class="fas fa-cycle"></i>
                                                        Clear</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <div class="alert alert-primary" id="loaderChck" style="display:none" role="alert">
                                        Mohon tunggu <i class="fas fa-spinner fa-pulse"></i>
                                    </div>
                                    <div id="dataListChck">

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custPenj" role="tabpanel" aria-labelledby="profile-tab3">
                                <div class="col-md-12 col-sm-12">
                                    <form method="POST" action="javascript:void(0)" id="formCustPnj">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="">Tanggal (bulan/tahun)</label>
                                                <div class="form-group">
                                                    <input type="text" name="tanggalCust" id="tanggalCust"
                                                        class="form-control" autocomplete="off">
                                                    <div class="invalid-feedback" id="feedbackIdktgBrg">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="">ID Transaksi</label>
                                                <div class="form-group">
                                                    <input type="text" name="nama_kategori_barang" id="id_transCust"
                                                        class="form-control">
                                                    <div class="invalid-feedback" id="feedbackNmKtgBrg">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="text-right">
                                                    <button class="btn btn-info btn-sm" id="btnSearchCust"><i
                                                            class="fas fa-search"></i>
                                                        Search</button>
                                                    <button class="btn btn-secondary btn-sm" id="clearIdCust"><i
                                                            class="fas fa-cycle"></i>
                                                        Clear</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <div class="alert alert-primary" id="loader" style="display:none" role="alert">
                                        Mohon tunggu <i class="fas fa-spinner fa-pulse"></i>
                                    </div>
                                    <div id="dataListCust"></div>
                                </div>
                            </div>
                        </div>
                        {{-- @include('MasterData.Menu.menuList') --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-script')
    <script>
        $(document).ready(function() {
            $("#tanggalChck").datepicker({
                format: "yyyy-mm",
                viewMode: "months",
                minViewMode: "months"
            })
            $("#tanggalCust").datepicker({
                format: "yyyy-mm",
                viewMode: "months",
                minViewMode: "months"
            })
            PageLoad1();
            PageLoad2();

            $("#btnSearchChck").click(function(e) {
                e.preventDefault();
            });
            $("#btnSearchCust").click(function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: "{{ route('Report.LaporanPenjualan') }}",
                    data: $("#formCustPnj").serialize(),
                    dataType: "html",
                    beforeSend: function() {
                        $('#loader').fadeIn('slow');
                    },
                    success: function(response) {
                        $('#loader').fadeOut('slow');
                        $('#dataListCust').html(response);
                        $("#table-1").DataTable({
                            searching: false,
                        });
                    }
                });

            });

            // $('#loader').fadeIn('slow');
            $(".detailCust").click(function(e) {
                e.preventDefault();
                // alert($(this).attr('data-idtranscust'));
            });
        });

        function PageLoad1() {
            $.ajax({
                type: "post",
                url: "{{ route('Report.LaporanPenjualan') }}",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                dataType: "html",
                beforeSend: function() {
                    $('#loader').fadeIn('slow');
                },
                success: function(response) {
                    $('#loader').fadeOut('slow');
                    $('#dataListCust').html(response);
                    $("#table-1").DataTable({
                        searching: false,
                    });
                }
            });
        }

        function PageLoad2() {
            $.ajax({
                type: "post",
                url: "{{ route('Report.LaporanPenjualanCheck') }}",
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
                    $("#table-2").DataTable({
                        searching: false,
                    });
                }
            });
        }
    </script>
@endpush
