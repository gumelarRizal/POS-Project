@extends('layouts.MainLayouts')
@section('title')
    <h1>{{ __('Checkout Pesanan') }}</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Form Checkout') }}</h4>
                </div>
                <div class="card-body">
                    <div class="col-sm-12">
                        <form method="POST" action="javascript:void(0)" id="formSearch">
                            @csrf
                            <div class="form-group">
                                <label>Kategori Barang</label>
                                <div class="input-group">
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
                            <label for="">Nama Barang</label>
                            <div class="form-group" id="form-idBrg">
                                <p id="loadingNmBrg" style="display: none">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Loading...
                                </p>
                                <select name="" id="id_barang" class="form-control">

                                </select>
                                <div class="invalid-feedback" id="feedbackNamamenu">

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
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Harga Jual</label>
                                    <div class="form-group">
                                        <input type="number" name="hargaJual" id="hargaJual" class="form-control" readonly>
                                        <div class="invalid-feedback" id="feedbackNamamenu">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Qty</label>
                                    <div class="form-group">
                                        <input type="number" name="qtyJual" id="qtyJual" class="form-control">
                                        <div class="invalid-feedback" id="feedbackNamamenu">

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label>Diskon</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="disc" id="disc">
                                </div>
                            </div>
                            <div class="row">
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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="col-sm-6">
                        <h4>{{ __('List Detail Checkout') }}</h4>
                    </div>
                    <div class="col-sm-6 text-right">
                        {{ date('l d/m/Y') }}
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover" id="tableDetail" role="grid">
                        <thead>
                            <tr>
                                <th>Kategori </th>
                                <th>Barang</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Diskon</th>
                                <th>Subtotal</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-right text-uppercase font-weight-bold">
                                    <strong>Total Checkout</strong>
                                </td>
                                <td class="text-right font-weight-bold" id="subtotal1"></td>
                                <td></td>
                            </tr>
                            {{-- <tr>
                                <td colspan="5" class="text-right text-uppercase font-weight-bold">
                                    <strong>Bayar</strong>
                                </td>
                                <td class="text-right font-weight-bold"><input type="text" class="form-control" id="bayar"
                                        onkeypress="validatenumber(event)">
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right text-uppercase font-weight-bold">
                                    <strong>Kembalian</strong>
                                </td>
                                <td class="text-right font-weight-bold" id="totalBel"></td>
                                <td></td>
                            </tr> --}}
                        </tfoot>
                    </table>

                    <div class="row">
                        <div class="col-lg-4 col-sm-5">

                        </div>

                        <div class="col-lg-4 col-sm-5 ml-auto QA_section">

                        </div>
                    </div><br>
                    <div class="col-md-12 text-right">
                        <a href="{{ route('Checkout.cetakStruk') }}" class="btn btn-info" target="_blank">Cetak Struk</a>
                        <button class="btn btn-primary" id="selesaiPesan">
                            selesai
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-script')
    <script>
        $(document).ready(function() {
            //add data detail
            var arrVal = [],
                total = 0;
            if (arrVal.length == 0) {
                $("#selesaiPesan").prop("disabled", true);
            }

            // bayar
            // $("#bayar").on("input", function() {
            //     var val = $(this).val(),
            //         totalCheck = total;
            //     $("#totalBel").html(val - totalCheck);
            // });

            // $("#btnAdd").click(addValObj);
            $("#btnAdd").click(function(e) {
                e.preventDefault();

                var ktgBrgObj = $("#id_kategori_barang").val(),
                    nmKtgObj = $("#id_kategori_barang").find(':selected').attr("data-ktg"),
                    brgObj = $("#id_barang").val(),
                    nmBrgObj = $("#id_barang").find(':selected').attr("data-nmbrg"),
                    hrgObj = $("#hargaJual").val().replace('.', ''),
                    qtyObj = $("#qtyJual").val(),
                    discObj = $('#disc').val(),
                    subtotal = (hrgObj * qtyObj) - discObj;
                if (ktgBrgObj == "" || brgObj == "" || hrgObj == "" || qtyObj == "") {
                    //alert("kosong nih boss!!");
                    swal({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Input tidak boleh kosong!'
                    });
                } else {
                    var objVal = new initialObj(ktgBrgObj, nmKtgObj, brgObj, nmBrgObj, hrgObj, qtyObj,
                            discObj, subtotal),
                        trTd = "",
                        subtotal = 0;

                    arrVal.push(objVal);
                    $.each(arrVal, function(indexInArray, valueOfElement) {
                        trTd += "<tr>" + "<td>" + valueOfElement.nmKtg + "</td>" +
                            "<td>" + valueOfElement.nmBrg + "</td>" +
                            "<td class='text-right'>" + valueOfElement.qty + "</td>" +
                            "<td class='text-right'>" + addCommas(valueOfElement.hrg) + "</td>" +
                            "<td class='text-right'>" + addCommas(valueOfElement.disc) + "</td>" +
                            "<td class='text-right'>" + addCommas(valueOfElement.sbtl) + "</td>" +
                            "<td><a href='#' class='btn bg-danger btn-sm deleteRow' data-indexArr='" +
                            indexInArray + "'><i class='fas fa-trash'> Hapus </i></a></td>" +
                            "</tr>";
                        $("#tableDetail tbody").html(trTd);
                        subtotal += valueOfElement.sbtl;
                        $("#subtotal1").html(addCommas(subtotal));
                    });
                    total = subtotal;
                    $("#selesaiPesan").prop("disabled", false);
                    console.log(arrVal);
                }
            });

            //delete data
            $("#tableDetail tbody").on("click", ".deleteRow", function() {
                var indexArr = $(this).attr("data-indexArr"),
                    trTd = "",
                    subtotal = 0;
                arrVal.splice(indexArr, 1);
                $.each(arrVal, function(indexInArray, valueOfElement) {
                    trTd += "<tr>" +
                        "<td>" + valueOfElement.nmKtg + "</td>" +
                        "<td>" + valueOfElement.nmBrg + "</td>" +
                        "<td class='text-right'>" + valueOfElement.qty + "</td>" +
                        "<td class='text-right'>" + addCommas(valueOfElement.hrg) + "</td>" +
                        "<td class='text-right'>" + addCommas(valueOfElement.disc) + "</td>" +
                        "<td class='text-right'>" + addCommas(valueOfElement.sbtl) + "</td>" +
                        "<td><a href='#' class='btn bg-danger btn-sm deleteRow' data-indexArr='" +
                        indexInArray + "'><i class='fas fa-trash'> Hapus </i></a></td>" +
                        "</tr>";
                    $("#tableDetail tbody").html(trTd);
                    subtotal += valueOfElement.sbtl;
                    $("#subtotal1").html(addCommas(subtotal));
                });
                $total = subtotal;
                if (arrVal.length == 0) {
                    trTd = "";
                    total = 0;
                    $("#subtotal1").html(total);
                    $("#tableDetail tbody").html(trTd)
                }
                if (arrVal.length == 0) {
                    $("#selesaiPesan").prop("disabled", true);
                }
                console.log(arrVal);
            });

            // selesai pesanan
            $("#selesaiPesan").click(function(e) {
                e.preventDefault();
                console.log(total)
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
                            url: "{{ route('Checkout.selesaiPesan') }}",
                            data: {
                                obj: JSON.stringify(arrVal),
                                total: parseInt(total)
                            },
                            dataType: 'JSON',
                            success: function(response) {
                                //alert(response.msg);
                                arrVal = [];
                                swal(response.msg, {
                                    icon: "success",
                                });
                                refresh();
                            }
                        });
                    } else {
                        swal("Transaksi dibatalkan!");
                    }
                })
            });

            // GetHarga
            $("#id_barang").click(function(e) {
                e.preventDefault();
                var harga = addCommas($(this).find(':selected').attr('data-harga'));
                $("#hargaJual").val(harga);
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
                    url: "{{ route('Checkout.getParentBarang') }}",
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
                    }
                });
            });
        });

        function initialObj(ktgBrg, nmKtg, brg, nmBrg, hrg, qty, disc, sbtl) {
            this.ktgBrg = ktgBrg;
            this.nmKtg = nmKtg;
            this.brg = brg;
            this.nmBrg = nmBrg;
            this.hrg = hrg;
            this.qty = qty;
            this.disc = disc;
            this.sbtl = sbtl;
        }

        function refresh() {
            $("#subtotal1").html("0");
            $("#tableDetail tbody").html("");
            $("#id_kategori_barang").val("");
            $("#id_barang").val("");
            $("#hargaJual").val("");
            $("#qtyJual").val("");
            $("#selesaiPesan").prop("disabled", true);
        }

        function refreshAdd() {
            $("#id_kategori_barang").val('');
            $("#id_barang").val('');
            $("#hargaJual").val('');
            $("#qtyJual").val('');
        }
    </script>
@endpush
