<div class="modal fade" id="COAModal" tabindex="-1" role="dialog" aria-labelledby="COAModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="COAModalLabel">Tambah Data Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="javascript:void(0)" id="formMenu">
                    @csrf
                    <input type="hidden" name="id" id="formId" value="">
                    <div class="form-group">
                        <label>Kode COA</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Kode COA" name="id_coa"
                                id="form-id_coa">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama COA</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nama COA" name="nama_coa"
                                id="form-nama_coa">
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
