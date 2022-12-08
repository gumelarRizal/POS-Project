<table class="table table-striped dataTable no-footer" id="table-COA" role="grid">
    <thead>
        <tr>
            <th>
                #
            </th>
            <th>Nama Pelanggan</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>No telpon</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 0;
        @endphp
        @foreach ($listPelanggan as $item)
            @php
                $no++;
            @endphp
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $item->nama_pelanggan }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->no_telp }}</td>
                <td align="center">
                    <a href="#" class="btn bg-danger btn-sm">
                        <i class="fas fa-trash"> Hapus </i>
                    </a>
                    <a href="#" class="btn bg-warning btn-sm btn-edit" {{-- data-id="{{ $item->id }}" --}}
                        onclick="getEdit( {{ $item->id }},'{{ $item->nama_pelanggan }}','{{ $item->email }}','{{ $item->no_telp }}','{{ $item->alamat }}')">
                        <i class="fas fa-edit"> Edit </i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
