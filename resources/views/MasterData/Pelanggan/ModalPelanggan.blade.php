<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="javascript:void(0)" id="formPelanggan">
                    @csrf
                    <input type="hidden" name="id" id="formId" value="">
                    <div class="form-group">
                        <label>Nama Pelanggan</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nama Pelanggan" name="nama_pelanggan"
                                id="form-nama_pelanggan">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email Pelanggan</label>
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Email pelanggan" name="email"
                                id="form-email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>No Telfon Pelanggan</label>
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="No Telfon Pelanggan" name="no_telp"
                                id="form-no_telp">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alamat Pelanggan</label>
                        <div class="input-group">
                            <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control"
                                style="margin-top: 0px; margin-bottom: 0px; height: 61px;"></textarea>
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
