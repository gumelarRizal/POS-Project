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
                        <form method="POST" action="javascript:void(0)">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label for="">Id Transaksi</label>
                                            <div class="form-group">
                                                <input type="text" name="id_pengeluaranKas" id="id_pengeluaranKas"
                                                    class="form-control" value="{{ $idPengeluaranKas }}">
                                                <div class="invalid-feedback" id="feedbackNamamenu">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <label for="">Deskripsi</label>
                                            <div class="form-group">
                                                <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"
                                                    class="form-control"
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
                        <form method="POST" action="javascript:void(0)" id="formDetailPeng">
                            <div class="table-responsive">
                                @csrf
                                <table class="table table-bordered" id="tableDetailPengKas">
                                    <thead>
                                        <tr>
                                            <th>Chart of Account</th>
                                            <th>Total</th>
                                            <th class="text-center">
                                                <a href="javascript:;" class="btn btn-info addRow" id="addRow"><i
                                                        class="fas fa-plus"></i></a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select name="coa[]" class="form-control">
                                                    <option value="" selected disabled>--Pilih--</option>
                                                    @foreach ($COA as $item)
                                                        <option value="{{ $item->id_coa }}">
                                                            {{ $item->id_coa }} : {{ $item->nama_coa }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="total[]" class="form-control number-mask"
                                                    onkeypress="validatenumber(event)">
                                            </td>
                                            <td align="center">
                                                <a href="javascript:;" class="btn btn-danger deleteRow">
                                                    <i class="fas fa-trash-alt"> </i>
                                                </a>

                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('Retur.index') }}" class="btn btn-danger btn-block">
                                        <i class="fas fa-times-circle"></i> Cancel
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-success btn-block" id="saveChange"><i
                                            class="fa fa-save"></i>
                                        Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-script')
    <script>
        $(document).ready(function() {
            $(".number-mask").inputmask("decimal", {
                radixPoint: ",",
                autoGroup: true,
                groupSeparator: ".",
                groupSize: 3,
                rightAlignNumerics: true,
                oncleared: function() {
                    $(this).val("0");
                },
            });


            $('#addRow').on('click', function() {
                var tr =
                    '<tr>' +
                    '<td>' +
                    '<select name="coa[]" class="form-control">' +
                    '<option value="" selected disabled>--Pilih--</option>' +
                    @foreach ($COA as $item)
                        '<option value="{{ $item->id_coa }}">{{ $item->id_coa }} : {{ $item->nama_coa }}</option>'+
                    @endforeach '</select>' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" name="total[]" class="form-control number-mask" onkeypress="validatenumber(event)" > ' +
                    '</td>' +
                    '<td class="text-center"><a href="javascript:;" class="btn btn-danger deleteRow"><i class="far fa-trash-alt"></i></a></td>' +
                    '</tr>';

                $('table tbody').append(tr);
            });

            $('tbody').on('click', '.deleteRow', function() {
                $(this).parent().parent().remove();
            });

            $("#saveChange").click(function(e) {
                e.preventDefault();
                var formSerial = $("#formDetailPeng").serialize(),
                    idTransaksi = $("#id_pengeluaranKas").val(),
                    deskripsi = $("#deskripsi").val();
                formSerial = formSerial + "&idTrans=" + idTransaksi;
                formSerial = formSerial + "&deskripsi=" + deskripsi;
                console.log(formSerial);
                SaveProccess(formSerial);
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
                        url: "{{ route('Pengeluaran.Save') }}",
                        data: formSerial,
                        dataType: "JSON",
                        success: function(response) {
                            window.location.reload();
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
    </script>
@endpush
