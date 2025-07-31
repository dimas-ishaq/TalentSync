<div class="modal fade" id="approvePengajuanModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="approvePengajuanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h1 class="modal-title fs-5" id="approvePengajuanModalLabel">Terima Pengajuan <span
                        id="approve_nama_karyawan"></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="formApprovePengajuan">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    Anda akan menyetujui pengajuan ini.
                    Mohon pastikan semua detail telah diverifikasi dengan benar.
                    Tindakan ini akan menandai pengajuan sebagai disetujui
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
