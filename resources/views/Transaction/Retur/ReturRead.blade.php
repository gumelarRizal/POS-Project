<div class="alert alert-primary" id="loaderChck" style="display:none" role="alert">
    Mohon tunggu <i class="fas fa-spinner fa-pulse"></i>
</div>
<div class="table-responsive">
    <table class="table table-striped dataTable no-footer" id="table-1" role="grid">
        <thead>
            <tr>
                <th>
                    #
                </th>
                <th>ID Retur</th>
                <th>ID Transaksi</th>
                <th>Nama Pelanggan</th>
                <th>Total Retur</th>
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
                    <td>{{ $item->id_retur }}</td>
                    <td>{{ $item->id_customPesanan }}</td>
                    <td>{{ $item->nama_pelanggan }}</td>
                    <td>{{ 'Rp.' . number_format($item->total) }}</td>
                    <td>{{ $item->tgl_transaksi }}</td>
                    <td align="center">
                        {{-- <a href="#" class="btn btn-info detailCust"
                            data-idtranscust="{{ $item->id_customPesanan }}">Detail</a> --}}
                        <button class="btn btn-info detailCust" data-idretur="{{ $item->id_retur }}"
                            onclick="getDetail('{{ $item->id_retur }}')">
                            detail
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
