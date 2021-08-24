<div class="d-flex justify-content-center">
    <div class="table-responsive col-md-8 col-sm-8">
        <h3 class="text-center">Laporan Laba Rugi</h3><br>
        <table class="table table-bordered">
            <tr>
                <th colspan="4">Pendapatan dari penjualan</th>
            </tr>
            <tr>
                <td style="width: 25%">Penjualan</td>
                <th colspan="2" class="text-right">{{ 'Rp.' . number_format($totalPenjualan) }}</th>
                <td></td>
            </tr>
            <tr>
                <td>Retur Penjualan</td>
                <th class="text-right">({{ 'Rp.' . number_format($totalRetur->Nominal) }})</th>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>Penjualan Bersih</th>
                <th colspan="2" class="text-right">{{ 'Rp.' . number_format($totalPenjualan - $totalRetur->Nominal) }}
                </th>
                <th></th>
            </tr>
            <tr>
                <th>Harga Pokok Penjualan</th>
                <th colspan="2" class="text-right">
                    ({{ 'Rp.' . number_format($HPP->total) }})
                </th>
                <th></th>
            </tr>
            <tr class="table-primary">
                <th>Laba Kotor</th>
                <th colspan="3" class="text-right">
                    {{ 'Rp.' . number_format($totalPenjualan - $totalRetur->Nominal - $HPP->total) }}
                </th>
            </tr>
            <tr>
                <th colspan="4">Beban Operasional : </th>
            </tr>
            @foreach ($listPengeluaranKas as $item)
                <tr>
                    <td>{{ $item->nama_coa }}</td>
                    <th class="text-right">{{ 'Rp.' . number_format($item->subtotal) }}</th>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
            <tr>
                <th>Total Beban Operasional</th>
                <th></th>
                <th colspan="2" class="text-right">({{ 'Rp.' . number_format($totalPengeluaran->Nominal) }})</th>
            </tr>
            <tr class="table-primary">
                <th>Laba Bersih</th>
                <th colspan="3" class="text-right">
                    {{ 'Rp.' . number_format($totalPenjualan - $totalRetur->Nominal - $totalPengeluaran->Nominal - $HPP->total) }}
                </th>
            </tr>
        </table>
    </div>
</div>
