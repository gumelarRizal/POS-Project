<div class="modal fade" id="ktgBrgModal" tabindex="-1" role="dialog" aria-labelledby="ktgBrgModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ktgBrgModalLabel">Tambah Data Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="javascript:void(0)" id="formMenu">
                    @csrf
                    <input type="hidden" name="id" id="formId" value="">
                    <div class="form-group">
                        <label>Kode Kategori Barang</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Kode Kategori Barang"
                                name="id_kategori_barang" id="form-id_kategori_barang">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama kategori_Barang</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nama Kategori Barang"
                                name="nama_kategori_barang" id="form-nama_kategori_barang">
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
