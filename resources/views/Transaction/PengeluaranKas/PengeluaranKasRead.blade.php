<div class="table-responsive">
    <table class="table table-striped dataTable no-footer" id="table-1" role="grid">
        <thead>
            <tr>
                <th>
                    #
                </th>
                <th>ID Transaksi</th>
                <th>Total Pengeluaran Kas</th>
                <th>Deskripsi</th>
                <th>Tanggal Transaksi</th>
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
                    <td>{{ $item->id_pengeluaranKas }}</td>
                    <td>{{ 'Rp.' . number_format($item->total) }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>{{ $item->tgl_transaksi }}</td>
                    <td align="center">
                        {{-- <a href="#" class="btn btn-info detailCust"
                            data-idtranscust="{{ $item->id_customPesanan }}">Detail</a> --}}
                        <button class="btn btn-info detailCust" data-idretur="{{ $item->id_pengeluaranKas }}"
                            onclick="getDetail('{{ $item->id_pengeluaranKas }}')">
                            detail
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
