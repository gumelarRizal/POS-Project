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
                        <label>Kode Menu</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Kode Menu" name="id_menu"
                                id="form-id_menu">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama Menu</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nama Menu" name="nama_menu"
                                id="form-nama_menu">
                            </>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <div class="input-group">
                            <input type="number" class="form-control" placeholder="Harga" name="harga" id="harga">
                            </>
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
