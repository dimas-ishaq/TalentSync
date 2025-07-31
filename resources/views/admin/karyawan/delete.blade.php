<div class="modal fade" id="deleteKaryawanModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="deleteKaryawanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header text-bg-danger">
                <h5 class="modal-title fs-5" id="deleteKaryawanModalLabel">
                    Konfirmasi Penghapusan
                    Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data <span id="delete_nama_karyawan"></span>
                    ini?
                    Tindakan ini tidak dapat
                    dibatalkan dan
                    akan
                    menghapus semua data terkait karyawan tersebut.</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="" method="POST" id="formDeleteKaryawan">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
