@extends('layouts.Mainlayouts')
@section('title')
    <h1>{{ __('Retur Barang') }}</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Retur Barang</h4>
                </div>
                <div class="card-body">
                    <div class="col-sm-12 col-md-12">
                        <form method="POST" action="javascript:void(0)" id="formSearchRetur">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label for="">ID Transaksi</label>
                                            <div class="form-group">
                                                <select name="id_transaksi" id="id_transaksi" class="form-control">
                                                    <option value="" selected disabled>--Pilih--</option>
                                                    @foreach ($dropDownIdTrans as $item)
                                                        <option value="{{ $item->id_customPesanan }}"
                                                            data-nmPelanggan=" {{ $item->nama_pelanggan }} "
                                                            data-total=" {{ $item->total }} "
                                                            data-cashier=" {{ $item->Cashier }} "
                                                            data-alamat=" {{ $item->alamat }} ">
                                                            {{ $item->id_customPesanan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="">Nominal</label>
                                            <div class="form-group">
                                                <input type="text" name="nominal" id="nominal"
                                                    class="form-control number-mask" onkeypress="validatenumber(event)"
                                                    value="0" readonly>
                                                <div class="invalid-feedback" id="feedbackNamamenu">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="">Kasir</label>
                                            <div class="form-group">
                                                <input type="text" name="kasir" id="kasir" class="form-control" readonly>
                                                <div class="invalid-feedback" id="feedbackNamamenu">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <label for="">Nama Pelanggan</label>
                                            <div class="form-group">
                                                <input type="text" name="nama_pelanggan" id="nama_pelanggan"
                                                    class="form-control">
                                                <div class="invalid-feedback" id="feedbackNmKtgBrg">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <label for="">Alamat</label>
                                            <div class="form-group">
                                                <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control"
                                                    style="margin-top: 0px; margin-bottom: 0px; height: 61px;"></textarea>
                                            </div>
                                        </div>
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
                            <h4 class="text-center">Tidak ada data</h4>
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
            set_mask2();

            $("#id_transaksi").change(function(e) {
                e.preventDefault();
                var idTrans = $(this).val(),
                    cashier = $(this).find(':selected').attr('data-cashier'),
                    total = $(this).find(':selected').attr('data-total'),
                    nmPelanggan = $(this).find(':selected').attr('data-nmPelanggan'),
                    alamat = $(this).find(':selected').attr('data-alamat')
                $("#nama_pelanggan").val(nmPelanggan);
                $("#nominal").val(total);
                $("#alamat").val(alamat);
                $("#kasir").val(cashier);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('Retur.getByIdTrans') }}",
                    data: {
                        id_trans: idTrans
                    },
                    dataType: "HTML",

                    beforeSend: function() {
                        $("#loaderChck").fadeIn('slow');
                    },
                    success: function(response) {
                        $("#loaderChck").fadeOut('slow');
                        $("#dataListChck").html(response).show();
                        $("tbody").on("click", ".deleteRow", function() {
                            $(this).parent().parent().remove();
                        });
                        $("input[name^=qty]").on("keyup", function() {
                            var harga = $(this).parents('tr').find('.harga').val()
                                .replace('Rp.', '').replace(',', ''),
                                subtotal = $(this).parents('tr').find('.subtotal').val()
                                .replace('Rp.', '').replace(',', '');
                            $(this).parents('tr').find('.subtotal').val('Rp.' +
                                addCommas(
                                    harga * $(this)
                                    .val()));
                        });
                        $("#saveChange").click(function(e) {
                            e.preventDefault();
                            var formSerial = $("#formDetailRetur").serialize(),
                                idTransaksi = $("#id_transaksi").val();
                            formSerial = formSerial + "&idTrans=" + idTransaksi;
                            SaveProccess(formSerial);
                        });
                    }
                });
            });
        });

        function SaveProccess(formSerial) {
            swal({
                title: "Apakah Kamu yakin?",
                text: "Transaksi selesai dan akan di simpan ke database!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((confirm) => {
                if (confirm) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('Retur.Save') }}",
                        data: formSerial,
                        dataType: "JSON",
                        success: function(response) {
                            Refresh()
                            swal(response.msg, {
                                icon: "success",
                            });
                        }
                    });
                } else {
                    swal('Transaksi Dibatalkan', {
                        icon: "error",
                    });
                }
            });
        }

        function Refresh() {
            $("#id_transaksi").val("");
            $("#nominal").val("");
            $("#kasir").val("");
            $("#nama_pelanggan").val("");
            $("#alamat").val("");
            $("#dataListChck").html('<h4 class="text-center">Tidak ada data</h4>').show();
        }
    </script>
@endpush
