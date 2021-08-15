@extends('layouts.MainLayouts')
@section('title')
    <h1>{{ __('Custom Pesanan') }}</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="col-sm-12">
                        <form method="POST" action="javascript:void(0)" id="formSearch">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Kategori Barang</label>
                                    <div class="form-group">
                                        <select name="id_kategori_barang" id="id_kategori_barang" class="form-control">
                                            <option value="" selected disabled>--Pilih--</option>
                                            @foreach ($dropDownKtgBarang as $item)
                                                <option value="{{ $item->id_kategori_barang }}"
                                                    data-ktg="{{ $item->nama_kategori_barang }}">
                                                    {{ $item->nama_kategori_barang }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Nama Barang</label>
                                    <div class="form-group" id="form-idBrg">
                                        <p id="loadingNmBrg" style="display: none">
                                            <span class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span>
                                            Loading...
                                        </p>
                                        <select name="" id="id_barang" class="form-control">

                                        </select>
                                        <div class="invalid-feedback" id="feedbackNamamenu">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label for="">Harga Jual</label>
                                    <div class="form-group">
                                        <input type="number" name="hargaJual" id="hargaJual" class="form-control" readonly>
                                        <div class="invalid-feedback" id="feedbackNamamenu">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Qty</label>
                                    <div class="form-group">
                                        <input type="number" name="qtyJual" id="qtyJual" class="form-control">
                                        <div class="invalid-feedback" id="feedbackNamamenu">

                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <label for="">Diskon</label>
                                    <div class="form-group">
                                        <input type="number" name="diskon" id="diskon" class="form-control">
                                        <div class="invalid-feedback" id="feedbackNamamenu">

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label>Jasa</label>
                                    <div class="form-group">
                                        <select name="id_jasa" id="id_jasa" class="form-control">
                                            <option value="0" selected>--Pilih--</option>
                                            @foreach ($dropDownJasa as $item)
                                                <option value="{{ $item->id_jasa }}"
                                                    data-harga="{{ $item->harga_jasa }}"
                                                    data-nama="{{ $item->nama_jasa }}">
                                                    {{ $item->nama_jasa }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <label>Harga Jasa</label>
                                    <div class="form-group">
                                        <input type="text" name="hargaJasa" id="hargaJasa" class="form-control number-mask"
                                            onkeypress="validatenumber(event)" value="0">
                                        <div class="invalid-feedback" id="feedbackNamamenu">

                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-3">
                                    <label>Estimasi Hari</label>
                                    <div class="form-group">
                                        <input type="number" name="estimasi" id="estimasi" class="form-control">
                                        <div class="invalid-feedback" id="feedbackNamamenu">

                                        </div>
                                    </div>
                                </div> --}}

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Deskripsi</label>
                                    <div class="form-group">
                                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control"
                                            style="margin-top: 0px; margin-bottom: 0px; height: 61px;"></textarea>
                                    </div>
                                </div>
                            </div>
                            {{-- <label for="">Diskon *optional</label>
                            <div class="form-group" id="form-idBrg">
                                <p id="loadingNmBrg" style="display: none">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Loading...
                                </p>
                                <select name="" id="" class="form-control">
                                    <option value="">--pilih diskon--</option>
                                    <option value="">20%</option>
                                    <option value="">--pilih diskon--</option>
                                </select>
                                <div class="invalid-feedback" id="feedbackNamamenu">

                                </div>
                            </div> --}}
                            <div class=" row">
                                <div class="col-sm-12">
                                    <div class="text-right">
                                        <button class="btn btn-info btn-sm" id="btnAdd"><i class="fas fa-plus"
                                                id="search"></i>
                                            Tambah</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <div class="col-sm-12">
                        <form method="POST" action="javascript:void(0)" id="formPelanggan">
                            @csrf
                            <input type="hidden" name="id_pelanggan" id="id_pelanggan" value="{{ $idPlg }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Nama Pelanggan</label>
                                    <div class="form-group">
                                        <input type="text" name="nama_pelanggan" class="form-control" id="nama_pelanggan">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label>Email</label>
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="">Alamat</label>
                                    <div class="form-group">
                                        <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control"
                                            style="margin-top: 0px; margin-bottom: 0px; height: 61px;"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="text-right">
                                        <button class="btn btn-info btn-sm" id="btnAddPelanggan"><i class="fas fa-plus"
                                                id="search"></i>
                                            Tambah</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-sm-6">
                        <h4>{{ __('List Detail Checkout') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 table-responsive">
                            <table class="table table-striped table-bordered" id="tableDetail" role="grid">
                                <thead>
                                    <tr>
                                        <td colspan="5" class="text-center">List Barang</td>
                                        <td colspan="4" class="text-center">List Jasa Pengerjaan </td>
                                        <td rowspan="2">Aksi</td>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                        <th>Diskon</th>
                                        <th>Subtotal</th>
                                        <th>Nama</th>
                                        <th>Service</th>
                                        <th>deskripsi</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <table class="table table-striped table-hover" id="tableDetailBarang" role="grid">
                                <thead>
                                    <tr>
                                        <th>Total Pembayaran</th>
                                        <th><input type="text" class="form-control" readonly id="subtotal1"></th>
                                    </tr>
                                    <tr>
                                        <th>Pembayaran</th>
                                        <th>
                                            <div class="selectgroup w-100">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="jenis_bayar" value="lunas"
                                                        class="selectgroup-input" checked="">
                                                    <span class="selectgroup-button">Lunas</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="jenis_bayar" value="cicil"
                                                        class="selectgroup-input">
                                                    <span class="selectgroup-button">Down Payment</span>
                                                </label>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Sisa Bayar</th>
                                        <th><input type="text" class="form-control" id="sisa"></th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" class="text-right">
                                            <a href="{{ route('CustomPesanan.invoice') }}" id="printInvoice"
                                                class="btn btn-info" target="_BLANK">
                                                print
                                            </a>
                                            <button class="btn btn-primary" id="selesaiPesan">
                                                selesai
                                            </button>
                                        </th>
                                    </tr>

                                </thead>
                                <tbody>
                                </tbody>

                            </table>
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
            var arrVal = [],
                totalBelanja = 0,
                sisa = 0;
            set_mask2();
            if (arrVal.length == 0) {
                $("#selesaiPesan").prop("disabled", true);
                $("#printInvoice").hide();
            }
            // change method
            $("input[name=jenis_bayar]").change(function(e) {
                e.preventDefault();
                var checked = $("input[name=jenis_bayar]:checked").val();
                // totalbelanja = $("#subtotal1").val().replace(".", "");

                if (checked != "lunas") {
                    sisa = totalBelanja / 2;
                    $("#sisa").val(addCommas(sisa));
                    $("#sisa").removeAttr('readonly');
                } else {
                    sisa = totalBelanja
                    $("#sisa").val(addCommas(sisa));
                    $("#sisa").attr('readonly', 'readonly');
                }
            });

            //Selected chain
            $("#id_kategori_barang").change(function(e) {
                e.preventDefault();
                $("#id_barang").hide();
                var idKtgBrg = $("#id_kategori_barang").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: "{{ route('CustomPesanan.barang') }}",
                    data: {
                        id_kategori_barang: idKtgBrg
                    },
                    dataType: "html",
                    beforeSend: function() {
                        $("#loadingNmBrg").show();
                    },
                    success: function(resp) {
                        $("#loadingNmBrg").hide();
                        $("#id_barang").html(resp).show();
                        $("#hargaJual").val(0);
                    }
                });
            });

            // getHargaBarang
            $("#id_barang").change(function(e) {
                e.preventDefault();
                var hrgBrg = $(this).find(":selected").attr("data-harga");
                $("#hargaJual").val(addCommas(hrgBrg));
            });

            // getHargaJasa
            $("#id_jasa").change(function(e) {
                e.preventDefault();
                var harga = $(this).find(":selected").attr("data-harga");
                $("#hargaJasa").val(addCommas(harga));
            });

            // add Barang
            $("#btnAdd").click(function(e) {
                e.preventDefault();

                var ktgBrgObj = $("#id_kategori_barang").val(),
                    nmKtgObj = $("#id_kategori_barang").find(':selected').attr("data-ktg"),
                    brgObj = $("#id_barang").val(),
                    nmBrgObj = $("#id_barang").find(':selected').attr("data-nmbrg"),
                    hrgObj = $("#hargaJual").val().replace(".", ""),
                    qtyObj = $("#qtyJual").val(),
                    diskon = $("#diskon").val(),
                    jasa = $("#id_jasa").val(),
                    nmJasa = $("#id_jasa").find(":selected").attr("data-nama"),
                    hargaJasa = $("#hargaJasa").val().replace(".", ""),
                    deskripsi = $("#deskripsi").val(),
                    subtotal = (hrgObj * qtyObj) - diskon,
                    subtotal2 = 0;
                nmJasa = jasa == '0' ? '-' : nmJasa;
                subtotal2 = parseInt(hargaJasa);
                if (ktgBrgObj == "" || brgObj == "" || hrgObj == "" || qtyObj == "" || diskon == "" ||
                    jasa == "") {
                    swal({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Input tidak boleh kosong!'
                    });
                } else {
                    var objVal = new initialObj(ktgBrgObj, nmKtgObj, brgObj, nmBrgObj, hrgObj, qtyObj,
                            subtotal, diskon, jasa, nmJasa, hargaJasa, deskripsi, subtotal2),
                        trTd = "",
                        subtotal = 0;
                    subtotal2 = 0;

                    arrVal.push(objVal);
                    $.each(arrVal, function(indexInArray, valueOfElement) {
                        trTd += "<tr>" +
                            "<td>" + valueOfElement.nmBrg + "</td>" +
                            "<td class='text-right'>" + addCommas(valueOfElement.qty) + "</td>" +
                            "<td class='text-right'>" + addCommas(valueOfElement.hrg) + "</td>" +
                            "<td class='text-right'>" + addCommas(valueOfElement.diskon) + "</td>" +
                            "<td class='text-right'>" + addCommas(valueOfElement.sbtl) + "</td>" +
                            "<td class='text-right'>" + addCommas(valueOfElement.nmJasa) + "</td>" +
                            "<td class='text-right'>" + addCommas(valueOfElement.hrgjasa) +
                            "</td>" +
                            "<td class='text-right'>" + addCommas(valueOfElement.deskripsi) +
                            "</td>" +
                            "<td class='text-right'>" + addCommas(valueOfElement.sbtl2) + "</td>" +
                            "<td><a href='#' class='btn bg-danger btn-sm deleteRow' data-indexArr='" +
                            indexInArray + "'><i class='fas fa-trash'> Hapus </i></a></td>" +
                            "</tr>";
                        $("#tableDetail tbody").html(trTd);
                        subtotal += valueOfElement.sbtl;
                        subtotal2 += valueOfElement.sbtl2;
                        totalBelanja = subtotal + subtotal2;
                        sisa = totalBelanja;
                        $("#subtotal1").val(addCommas(totalBelanja));
                        $("#sisa").val(addCommas(sisa));
                        $("#sisa").attr('readonly', 'readonly');
                    });
                    // console.log(subtotal)
                    $("#selesaiPesan").prop("disabled", false);
                    $("#printInvoice").show();
                    refreshClick();
                    // console.log(arrVal.find(obj => obj.jasa === 'JS001'));
                    console.log(arrVal);
                }
            });

            //delete data
            $("#tableDetail tbody").on("click", ".deleteRow", function() {
                var indexArr = $(this).attr("data-indexArr"),
                    subtotal = 0,
                    subtotal2 = 0,
                    trTd = "";
                arrVal.splice(indexArr, 1);
                $.each(arrVal, function(indexInArray, valueOfElement) {
                    trTd += "<tr>" +
                        "<td>" + valueOfElement.nmBrg + "</td>" +
                        "<td class='text-right'>" + addCommas(valueOfElement.qty) + "</td>" +
                        "<td class='text-right'>" + addCommas(valueOfElement.hrg) + "</td>" +
                        "<td class='text-right'>" + addCommas(valueOfElement.diskon) + "</td>" +
                        "<td class='text-right'>" + addCommas(valueOfElement.sbtl) + "</td>" +
                        "<td class='text-right'>" + addCommas(valueOfElement.nmJasa) + "</td>" +
                        "<td class='text-right'>" + addCommas(valueOfElement.hrgjasa) +
                        "</td>" +
                        "<td class='text-right'>" + addCommas(valueOfElement.deskripsi) +
                        "</td>" +
                        "<td class='text-right'>" + addCommas(valueOfElement.sbtl2) + "</td>" +
                        "<td><a href='#' class='btn bg-danger btn-sm deleteRow' data-indexArr='" +
                        indexInArray + "'><i class='fas fa-trash'> Hapus </i></a></td>" +
                        "</tr>";
                    $("#tableDetail tbody").html(trTd);
                    subtotal += valueOfElement.sbtl;
                    subtotal2 += valueOfElement.sbtl2;
                    totalBelanja = subtotal + subtotal2;
                    sisa = totalBelanja;
                    $("#subtotal1").val(addCommas(totalBelanja));
                    $("#sisa").val(addCommas(sisa));
                });

                if (arrVal.find(obj => obj.jasa === '0')) {
                    $("#id_jasa").attr("disabled", false);
                    $("#hargaJasa").attr("readonly", false);
                    $("#deskripsi").attr("readonly", false);
                }

                if (arrVal.length == 0) {
                    trTd = "";
                    totalBelanja = 0;
                    sisa = totalBelanja;
                    $("#subtotal1").val(totalBelanja);
                    $("#sisa").val(sisa);
                    $("#tableDetail tbody").html(trTd)
                    $("#selesaiPesan").prop("disabled", true);
                    $("#printInvoice").hide();
                }
                console.log(arrVal);
            });

            // addPelanggan
            $("#btnAddPelanggan").click(function(e) {
                e.preventDefault();
                $("#nama_pelanggan").attr('readonly', true);
                $("#email").attr('readonly', true);
                $("#alamat").attr('readonly', true);
                $("#btnAddPelanggan").attr('disabled', true);
            });

            // selesai Pesan
            $("#selesaiPesan").click(function(e) {
                e.preventDefault();
                var idPelanggan = $("#id_pelanggan").val(),
                    nmPelanggan = $("#nama_pelanggan").val(),
                    email = $("#email").val(),
                    alamat = $("#alamat").val();
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
                            url: "{{ route('CustomPesanan.simpan') }}",
                            data: {
                                obj: JSON.stringify(arrVal),
                                total: parseInt(totalBelanja),
                                sisa: parseInt(sisa),
                                idPlg: idPelanggan,
                                nmPlg: nmPelanggan,
                                almt: alamat,
                                email: email
                            },
                            dataType: 'JSON',
                            success: function(response) {
                                //alert(response.msg);
                                arrVal = [];
                                swal(response.msg, {
                                    icon: "success",
                                });
                                refreshPesanan();
                            }
                        });
                    } else {
                        swal("Transaksi dibatalkan!");
                    }
                })
            });
        });

        function initialObj(ktgBrg, nmKtg, brg, nmBrg, hrg, qty, sbtl, diskon, jasa, nmJasa, hrgjasa, deskripsi, sbtl2) {
            this.ktgBrg = ktgBrg;
            this.nmKtg = nmKtg;
            this.brg = brg;
            this.nmBrg = nmBrg;
            this.hrg = hrg;
            this.qty = qty;
            this.sbtl = sbtl;
            this.diskon = diskon;
            this.jasa = jasa;
            this.nmJasa = nmJasa;
            this.hrgjasa = hrgjasa;
            this.deskripsi = deskripsi;
            this.sbtl2 = sbtl2;
        }

        function refreshPesanan() {
            $("#subtotal1").val("0");
            $("#sisa").val("0");
            $("#tableDetail tbody").html("");
            $("#id_kategori_barang").val("");
            $("#id_jasa").val("");
            $("#id_barang").val("");
            $("#hargaJual").val("");
            $("#hargaJasa").val("");
            $("#diskon").val("");
            $("#qtyJual").val("");
            $("#deskripsi").val("");
            $("#selesaiPesan").prop("disabled", true);
            $("#nama_pelanggan").val('');
            $("#email").val('');
            $("#alamat").val('');
            $('#nama_pelanggan').removeAttr('readonly');
            $('#email').removeAttr('readonly');
            $('#alamat').removeAttr('readonly');
            $("#btnAddPelanggan").attr('disabled', false);
            $("#id_jasa").attr("disabled", false);
            $("#hargaJasa").attr("readonly", false);
            $("#deskripsi").attr("readonly", false);
            setTimeout(function() {
                $("#printInvoice").fadeOut();
            }, 5000);
        }

        function refreshClick() {
            $("#id_kategori_barang").val("");
            $("#id_jasa").val("0");
            $("#id_barang").val("");
            $("#hargaJual").val("");
            $("#hargaJasa").val(0);
            $("#diskon").val("");
            $("#qtyJual").val("");
            $("#deskripsi").val("-");
            $("#id_jasa").attr("disabled", true);
            $("#hargaJasa").attr("readonly", true);
            $("#deskripsi").attr("readonly", true);

        }
        // function generateInvoice() {
        //     $.ajax({
        //         type: "get",
        //         url: "{{ route('CustomPesanan.invoice') }}",
        //         xhrFields: {
        //             responseType: 'blob'
        //         },
        //         success: function(response) {
        //             var blob = new Blob([response]);
        //             var link = document.createElement('a');
        //             link.href = window.URL.createObjectURL(blob);
        //             link.download = "Sample.pdf";
        //             link.click();
        //         },
        //         error: function(blob) {
        //             console.log(blob);
        //         }
        //     });
        // }
    </script>
@endpush
