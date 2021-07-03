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
                                            <option value="{{ $item->id_kategori_barang }}">
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
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Harga Jual</label>
                                    <div class="form-group">
                                        <input type="number" name="" id="" class="form-control">
                                        <div class="invalid-feedback" id="feedbackNamamenu">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Qty</label>
                                    <div class="form-group">
                                        <input type="number" name="" id="" class="form-control">
                                        <div class="invalid-feedback" id="feedbackNamamenu">

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="text-right">
                                        <button class="btn btn-info btn-sm" id="btnSearch"><i class="fas fa-plus"
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
                    <table class="table table-striped dataTable no-footer" id="table-1" role="grid">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>Nama Menu</th>
                                <th>Qty</th>
                                <th>Harga Menu</th>
                                <th>Subtotal</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td align="center">
                                    <a href="#" class="btn bg-danger btn-bg">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-lg-4 col-sm-5">

                        </div>

                        <div class="col-lg-4 col-sm-5 ml-auto QA_section">
                            <table class="table table-clear QA_table">
                                <tbody>
                                    <tr>
                                        <td class="left">
                                            <strong>Subtotal</strong>
                                        </td>
                                        <td class="right">$8.497,00</td>
                                    </tr>
                                    <tr>
                                        <td class="left">
                                            <strong>Pajak (100%)</strong>
                                        </td>
                                        <td class="right">$679,76</td>
                                    </tr>
                                    <tr>
                                        <td class="left">
                                            <strong>Total</strong>
                                        </td>
                                        <td class="right">
                                            <strong>$7.477,36</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-primary col-sm-12">
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
            $("#id_kategori_barang").change(function(e) {
                e.preventDefault();
                $("#id_barang").hide();
                var idKtgBrg = $("#id_kategori_barang").val();
                console.log(idKtgBrg);
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
    </script>
@endpush
