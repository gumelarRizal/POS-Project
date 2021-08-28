@extends('layouts.MainLayouts')

@php
$titleBreadcrump = 'Pembelian';
@endphp

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Form Pembelian</h4>
                </div>
                <div class="card-body">
                    <div class="col-sm-12">
                        <form action="javascript:void(0)" method="post" id="formBeli">
                            <div class="form-group">
                                <label for="kategori" class="form-control-label">Kategori</label>
                                <select class="form-control" name="kategori" id="kategori">
                                    <option value="" selected>--Pilih Kategory--</option>
                                    @foreach ($kategori as $kategor)
                                        <option value="{{ $kategor->id_kategori_barang }}">
                                            {{ $kategor->nama_kategori_barang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="barang" class="form-control-label">Barang</label>
                                <select class="form-control" name="barang" id="barang">

                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="harga" class="form-control-label">Harga</label>
                                        <input class="form-control angka" type="number" name="harga" id="harga" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jumlah" class="form-control-label">Jumlah</label>
                                        <input class="form-control angka" type="number" name="jumlah" id="jumlah">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-right">
                                        <button class="btn btn-info" id="Beli">Tambah</button>
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
                    <div class="col-md-6">
                        <h4>Detail Pembelian</h4>
                    </div>
                    <div class="col-md-6 text-right">
                        {{ date('l d/m/Y') }}
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover" role="grid" id="detailbeli">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Barang</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-right text-uppercase font-weight-bold"><strong>Total</strong>
                                </td>
                                <td id="total" class="text-right font-weight-bold"></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button class="btn btn-info btn-lg" id="pembelian"> Pembelian </button>
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
            $(".angka").on("keypress keyup blur", function(event) {
                $(this).val($(this).val().replace(/[^\d].+/, ""));
                if ((event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });

            $("#kategori").on('change', function(e) {
                e.preventDefault();
                var barang = $("#kategori").val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: "{{ route('Pembelian.barang') }}",
                    data: {
                        id: barang
                    },
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);
                        $("#barang").empty();
                        var str = '<option value="" selected disabled>--Pilih Barang--</option>'
                        $.each(response, function(key, value) {
                            str += '<option value="' + value.id_barang +
                                '" data-hargaBeli = "' + value.harga +
                                '">' + value.nama_barang +
                                '</option>'
                            $("#barang").append(str)
                            // $("#barang").append(new Option(value.nama_barang, value
                            //     .id_barang));
                        });
                    }
                });
            });

            $("#barang").click(function(e) {
                e.preventDefault();
                var harga = addCommas($(this).find(':selected').attr('data-hargaBeli'));
                $("#harga").val(harga);
            });

            var arrVal = [];
            if (arrVal.length == 0) {
                $("#pembelian").prop("disabled", true);
            }

            $("#Beli").click(function(e) {
                e.preventDefault();
                var kategori = $("#kategori").val();
                var kategori_nama = $("#kategori option:selected").text();
                var barang = $("#barang").val();
                var barang_nama = $("#barang option:selected").text();
                var harga = $("#harga").val().replace('.', '');
                var jumlah = $("#jumlah").val();
                var subtotals = harga * jumlah;

                if (kategori == "" || barang == "" || harga == "" || jumlah == "") {
                    //alert("kosong nih boss!!");
                    swal({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Input tidak boleh kosong!'
                    });
                } else {
                    objVal = new initialObj(kategori, kategori_nama, barang, barang_nama, harga, jumlah,
                        subtotals);
                    arrVal.push(objVal);
                    subtotals = 0;
                    var tabel = "";
                    $.each(arrVal, function(indexInArray, valueOfElement) {
                        tabel += "<tr><td>" + valueOfElement.nmKtg +
                            "</td><td>" + valueOfElement.nmBrg +
                            "</td><td class='text-right'>" + valueOfElement.jml +
                            "</td><td class='text-right'>" + valueOfElement.hrg +
                            "</td><td class='text-right'>" + valueOfElement.sbtl +
                            "</td><td><button class='btn btn-danger hapus' data-idx=" +
                            indexInArray +
                            ">Hapus</button></td></tr>";
                        $("#detailbeli tbody").html(tabel);
                        subtotals += valueOfElement.sbtl;
                        $("#total").html(subtotals);
                    });

                    $("#pembelian").prop("disabled", false);
                    //console.log(arrVal);
                    hapusForm();
                }
            });

            $("#detailbeli").on('click', '.hapus', function(e) {
                e.preventDefault();
                var indexArr = $(this).attr("data-idx"),
                    subtotals = 0,
                    tabel = "";

                arrVal.splice(indexArr, 1);
                $.each(arrVal, function(indexInArray, valueOfElement) {
                    tabel += "<tr><td>" + valueOfElement.nmKtg +
                        "</td><td>" + valueOfElement.nmBrg +
                        "</td><td>" + valueOfElement.jml +
                        "</td><td>" + valueOfElement.hrg +
                        "</td><td>" + valueOfElement.sbtl +
                        "</td><td><button class='btn btn-danger hapus' data-idx=" + indexInArray +
                        ">Hapus</button></td></tr>";
                    $("#detailbeli tbody").html(tabel);
                    subtotals += valueOfElement.sbtl;
                    $("#total").html(subtotals);
                });

                if (arrVal.length == 0) {
                    var tabel = "";
                    $("#detailbeli tbody").html(tabel);
                    $("#total").html(subtotals);
                    $("#pembelian").prop("disabled", false);
                }
                console.log(arrVal);
            });

            $("#pembelian").click(function(e) {
                e.preventDefault();
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
                            url: "{{ route('Pembelian.simpan') }}",
                            data: {
                                obj: JSON.stringify(arrVal),
                                total: parseInt($("#total").html())
                            },
                            dataType: 'JSON',
                            success: function(response) {
                                swal(response.msg, {
                                    icon: "success",
                                });
                                clearPage();
                            }
                        });
                    }
                });
            });

            function initialObj(kategori, kategori_nama, barang, barang_nama, harga, jumlah, subtotals) {
                this.ktg = kategori;
                this.nmKtg = kategori_nama;
                this.brg = barang;
                this.nmBrg = barang_nama;
                this.hrg = harga;
                this.jml = jumlah;
                this.sbtl = subtotals;
            }

            function hapusForm() {
                $("#kategori").val("");
                $("#barang").empty();
                $("#harga").val("");
                $("#jumlah").val("");
            }

            function clearPage() {
                $("#total").html("0");
                $("#detailbeli tbody").html("");
                $("#kategori").val("");
                $("#barang").empty();
                $("#harga").val("");
                $("#jumlah").val("");
                $("#pembelian").prop("disabled", true);
                arrVal.length = 0;
            }
        });
    </script>
@endpush
