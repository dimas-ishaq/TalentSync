<div class="modal fade" id="editAbsensi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editAbsensiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header text-bg-warning">
                <h5 class="modal-title" id="editAbsensiLabel">Edit Absensi -
                    <span id="edit_absensi_nama_karyawan"></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST" id="form_edit_absensi">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="edit_absensi_status">Status</label>
                        <select name="status" class="form-select" id="edit_absensi_status">
                            <option value="terlambat">Terlambat</option>
                            <option value="hadir">Hadir</option>
                            <option value="izin">Izin</option>
                            <option value="alpha">Alpha</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_absensi_catatan" class="form-label">Catatan</label>
                        <textarea name="catatan" id="edit_absensi_catatan" rows="2" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
