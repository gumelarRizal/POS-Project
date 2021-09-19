<table class="table table-striped dataTable no-footer" id="table-presensi" role="grid">
    <thead>
        <tr>
            <th>
                #
            </th>
            <th>Nama Pegawai</th>
            <th>Jam Masuk</th>
            <th>Jam Keluar</th>
            <th>Total Jam</th>
            <th>Tanggal Presensi</th>
        </tr>
    </thead>
    @if (count($listData) > 0)
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
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->jam_masuk }}</td>
                    <td>{{ $item->jam_keluar }}</td>
                    <td>{{ $item->TotalJamKerja }}</td>
                    <td>{{ $item->tgl_transaksi }}</td>
                </tr>
            @endforeach
        </tbody>
    @else
        <tbody>
            <td colspan="6" class="text-center">No data found</td>
        </tbody>
    @endif
</table>
