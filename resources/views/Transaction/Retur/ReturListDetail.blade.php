<form action="#" method="POST" id="formDetailRetur">
    @csrf
    <table class="table table-striped dataTable no-footer" id="table-1" role="grid">
        <thead>
            <tr>
                <th>
                    #
                </th>
                <th>Kode Transaksi</th>
                <th>Nama Barang</th>
                <th>Harga Barang</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 0;
            @endphp
            @foreach ($listData as $item)
                @php
                    $no++;
                @endphp
                <tr>
                    <td>{{ $no }}</td>
                    <td><input name="id_customPesanan[]" type="text" class="form-control"
                            value="{{ $item->id_customPesanan }}" readonly></td>
                    <input type="hidden" name="id_barang[]" value="{{ $item->id_barang }}">
                    <td><input type="text" class="form-control" value="{{ $item->nama_barang }}" readonly></td>
                    <td><input type="text" name="harga_barang[]" class="form-control harga"
                            value="{{ 'Rp.' . number_format($item->harga_barang) }}" readonly>
                    </td>
                    <td><input type="number" class="form-control" name="qty[]"
                            value="{{ number_format($item->qty) }}">
                    </td>
                    <td><input type="text" class="form-control subtotal" name="subtotal[]"
                            value="{{ 'Rp.' . number_format($item->harga_barang * $item->qty) }}" readonly></td>
                    <td align="center">
                        <a href="javascript:;" class="btn btn-danger deleteRow">
                            <i class="fas fa-trash"> </i>
                        </a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('Retur.index') }}" class="btn btn-danger btn-block">
                <i class="fas fa-times-circle"></i> Cancel
            </a>
        </div>
        <div class="col-md-6">
            <button type="button" class="btn btn-success btn-block" id="saveChange"><i class="fa fa-save"></i>
                Save</button>
        </div>
    </div>
</form>
