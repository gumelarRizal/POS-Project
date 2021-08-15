<table class="table table-striped dataTable no-footer" id="table-COA" role="grid">
    <thead>
        <tr>
            <th>
                #
            </th>
            <th>Kode COA</th>
            <th>Nama COA</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 0;
        @endphp
        @foreach ($listCOA as $item)
            @php
                $no++;
            @endphp
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $item->id_coa }}</td>
                <td>{{ $item->nama_coa }}</td>
                <td align="center">
                    <a href="#" class="btn bg-danger btn-sm">
                        <i class="fas fa-trash"> Hapus </i>
                    </a>
                    <a href="#" class="btn bg-warning btn-sm btn-edit" {{-- data-id="{{ $item->id }}" --}}
                        onclick="getEdit( {{ $item->id }},'{{ $item->id_coa }}','{{ $item->nama_coa }}')">
                        <i class="fas fa-edit"> Edit </i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
