<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="javascript:void(0)" id="formMenu">
                    @csrf
                    <input type="hidden" name="id" id="formId" value="">
                    <div class="form-group">
                        <label>Kode Barang</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Kode Barang" name="id_barang"
                                id="form-id_barang">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kategori Barang</label>
                        <div class="input-group">
                            <select name="id_kategori_barang" id="form-id_kategori_barang" class="form-control">
                                <option value="" selected disabled>--Pilih--</option>
                                @foreach ($dropDownKtgBarang as $item)
                                    <option value="{{ $item->id_kategori_barang }}">
                                        {{ $item->nama_kategori_barang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nama Barang" name="nama_barang"
                                id="form-nama_barang">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Harga</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-dollar-sign"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control number-mask" placeholder="00.0" name="harga"
                                        id="harga" onkeypress="validatenumber(event)">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Stok</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-boxes"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control number-mask" placeholder="00.0" name="stok"
                                        id="stok" onkeypress="validatenumber(event)">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Satuan</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Satuan" name="satuan" id="satuan">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    onclick="resetModal()">Close</button>
                <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
            </div>
        </div>
    </div>
</div>
