<table class="table table-striped dataTable no-footer" id="table-ktgBrg" role="grid">
    <thead>
        <tr>
            <th>
                #
            </th>
            <th>Kode Kategori Barang</th>
            <th>Nama Kategori Barang</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 0;
        @endphp
        @foreach ($listKtgBrg as $item)
            @php
                $no++;
            @endphp
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $item->id_kategori_barang }}</td>
                <td>{{ $item->nama_kategori_barang }}</td>
                <td align="center">
                    <a href="#" class="btn bg-danger btn-sm">
                        <i class="fas fa-trash"> Hapus </i>
                    </a>
                    <a href="#" class="btn bg-warning btn-sm btn-edit" {{-- data-id="{{ $item->id }}" --}}
                        onclick="getEdit( {{ $item->id }},'{{ $item->id_kategori_barang }}','{{ $item->nama_kategori_barang }}')">
                        <i class="fas fa-edit"> Edit </i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
