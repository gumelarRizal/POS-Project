<div class="table-responsive">
    <table class="table table-striped dataTable no-footer" id="table-1" role="grid">
        <thead>
            <tr>
                <th>
                    #
                </th>
                <th>ID Transaksi</th>
                <th>Nama Pelanggan</th>
                <th>Jumlah Bayar</th>
                <th>Total Belanja</th>
                <th>Status</th>
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
                    <td>{{ $item->id_customPesanan }}</td>
                    <td>{{ $item->nama_pelanggan }}</td>
                    <td>{{ 'Rp.' . number_format($item->jumlahByr) }}</td>
                    <td>{{ 'Rp.' . number_format($item->total) }}</td>
                    @if ($item->Status == 'Lunas')
                        <td><span class="badge badge-success">{{ $item->Status }}</span></td>
                    @else
                        <td><span class="badge badge-danger">{{ $item->Status }}</span></td>

                    @endif
                    <td>{{ $item->tgl_transaksi }}</td>
                    <td>{{ $item->Cashier }}</td>
                    <td align="center">
                        {{-- <a href="#" class="btn btn-info detailCust"
                            data-idtranscust="{{ $item->id_customPesanan }}">Detail</a> --}}
                        <button class="btn btn-info detailCust" data-idtranscust="{{ $item->id_customPesanan }}">
                            detail
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
