<!-- Modal -->
<div class="modal fade" id="deletePengajuan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="deletePengajuanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header text-bg-danger">
                <h1 class="modal-title fs-5" id="deletePengajuanLabel">Hapus Pengajuan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p class="fs-5">Apakah Anda yakin ingin <strong>menghapus pengajuan ini</strong>?</p>
                <p class="text-muted">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer">
                <form action="" method="post" id="formDeletePengajuan">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
