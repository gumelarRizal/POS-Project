<div class="table-responsive">
    <table class="table">
        <tr>
            <th>Id Retur</th>
            <th>:</th>
            <td>{{ $Data->id_retur }}</td>
        </tr>
        <tr>
            <th>Pelanggan</th>
            <th>:</th>
            <td>{{ $Data->nama_pelanggan }}</td>
        </tr>
    </table>
    <hr>
    <table class="table table-striped dataTable no-footer" id="table-1" role="grid">
        <thead>
            <tr>
                <th>
                    #
                </th>
                <th>ID Detail Retur</th>
                <th>Nama Barang</th>
                <th>Harga Barang</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
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
                    <td>{{ $item->id_dt_retur }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ 'Rp.' . number_format($item->harga_barang) }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ 'Rp.' . number_format($item->subtotal) }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
