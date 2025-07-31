<div class="modal fade" id="rejectPengajuanModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="rejectPengajuanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-bg-danger">
                <h1 class="modal-title fs-5" id="rejectPengajuanModalLabel">Tolak Pengajuan <span
                        id="reject_nama_karyawan"></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="formRejectPengajuan">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    Anda akan menolak pengajuan ini.
                    Pastikan Anda telah mempertimbangkan
                    semua aspek dan memberikan alasan yang memadai.
                    Klik 'Tolak' untuk menyelesaikan proses ini.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
