@extends('layouts.MainLayouts')

@php
    $titleBreadcrump = "Pembelian";
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
                                        <option value="{{ $kategor->id_kategori_barang }}">{{ $kategor->nama_kategori_barang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="barang" class="form-control-label">Barang</label>
                                <select class="form-control" name="barang" id="barang">
                                    <option value="" selected>--Pilih Barang--</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="harga" class="form-control-label">Harga</label>
                                        <input class="form-control" type="number" name="harga" id="harga">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jumlah" class="form-control-label">Jumlah</label>
                                        <input class="form-control" type="number" name="jumlah" id="jumlah">
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
                    <table class="table table-striped table-hover" role="grid">
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
                        <tbody id="detailbeli"></tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-right">Subtotal</td>
                                <td id="subtotal"></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right">Pajak</td>
                                <td id="pajak"></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right">Total</td>
                                <td id="total"></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-info" id="pembelian"> Beli </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-script')
    <script>
        $(document).ready(function () {
            $("#kategori").on('change', function (e) {
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
                        id : barang
                    },
                    dataType: "json",
                    success: function (response) {
                        // console.log(response);
                        $("#barang").empty();
                        $.each(response, function (key, value) { 
                             $("#barang").append(new Option(value.nama_barang, value.id_barang));
                        });
                    }
                });
            });

            $("#Beli").click(function (e) { 
                e.preventDefault();
                var kategori = $("#kategori").val();
                var kategori_nama = $("#kategori option:selected").text();
                var barang = $("#barang").val();
                var barang_nama = $("#barang option:selected").text();
                var harga = $("#harga").val();
                var jumlah = $("#jumlah").val();
                var totals = harga*jumlah;
                $("#formBeli").trigger('reset');
                
                var tabel = "<tr><td>"+kategori_nama+"</td><td>"+barang_nama+"</td><td>"+jumlah+"</td><td>"+harga+"</td><td>"+totals+"</td><td><button class='btn btn-danger hapus'>Hapus</button></td></tr>";
                $("#detailbeli").append(tabel);
            });

            $("#detailbeli").on('click','.hapus', function (e) { 
                e.preventDefault();
                $(this).closest('tr').remove();
            });

            $("#pembelian").click(function (e) { 
                e.preventDefault();
                
            });
        });
    </script>
@endpush