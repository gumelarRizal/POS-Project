<table class="table table-striped dataTable no-footer" id="table-1" role="grid">
    <thead>
        <tr>
            <th>
                #
            </th>
            <th>Kode Barang</th>
            <th>Kategori Barang</th>
            <th>Nama Barang</th>
            <th>Harga Barang</th>
            <th>Stok Barang</th>
            <th>Satuan Barang</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 0;
        @endphp
        @foreach ($listbarang as $item)
            @php
                $no++;
            @endphp
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $item->id_barang }}</td>
                <td>{{ $item->nama_kategori_barang }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ 'Rp.' . number_format($item->harga) }}</td>
                <td>{{ number_format($item->stok) }}</td>
                <td>{{ $item->satuan }}</td>
                <td align="center">
                    <a href="#" class="btn bg-warning btn-sm btn-edit" {{-- data-id="{{ $item->id }}" --}}
                        onclick="getEdit( {{ $item->id }},'{{ $item->id_barang }}','{{ $item->nama_barang }}',{{ $item->harga }},{{ $item->harga_jual }},{{ $item->stok }},'{{ $item->satuan }}','{{ $item->id_kategori_barang }}')">
                        <i class="fas fa-edit"> Edit </i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
