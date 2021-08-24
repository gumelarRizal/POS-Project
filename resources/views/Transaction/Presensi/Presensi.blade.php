<table class="table table-bordered">
    <thead>
        <tr>
            <th>Jam Masuk</th>
            <th>Jam Keluar</th>
            <th>Total Jam</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($listData as $item)
            <tr>
                <td>{{ $item->jam_masuk }}</td>
                <td>{{ $item->jam_keluar }}</td>
                <td>{{ $item->total_jam }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
