<div class="table-responsive">
    <table class="table table-striped dataTable no-footer" id="table-2" role="grid">
        <thead>
            <tr>
                <th>
                    #
                </th>
                <th>ID Transaksi</th>
                <th>Total Belanja</th>
                <th>Tanggal Transaksi</th>
                <th>Cashier</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 0;
            @endphp
            @foreach ($listDataHeader as $item)
                @php
                    $no++;
                @endphp
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $item->id_checkout }}</td>
                    <td>{{ 'Rp.' . number_format($item->total) }}</td>
                    <td>{{ $item->tgl_transaksi }}</td>
                    <td>{{ $item->name }}</td>
                    <td align="center">
                        {{-- <a href="#" class="btn btn-info detailCust"
                            data-idtranscust="{{ $item->id_customPesanan }}">Detail</a> --}}
                        <button class="btn btn-info detailCust" data-idtranscust="{{ $item->id_checkout }}">
                            detail
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
