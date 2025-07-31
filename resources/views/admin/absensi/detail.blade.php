<!-- Modal -->
<div class="modal fade" id="detailAbsensi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="detailAbsensiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <div class="col">
                    <h5 class="mb-1">Detail Absensi</h5>
                    <small id="absensi_tanggal">

                    </small>
                </div>
                <div class="col d-flex flex-column justify-content-end align-items-end">
                    <h6 class="fw-bold">Status</h6>
                    <span class="badge" id="absensi_status"></span>
                </div>
            </div>
            <div class="card modal-body">
                <div class="card-body">
                    <div class="row mb-3">
                        <!-- JAM MASUK -->
                        <div class="col-md-6">
                            <h6 class="fw-bold">Jam Masuk</h6>
                            <p class="mb-1" id="absensi_jam_masuk"></p>
                            <p class="text-muted mb-0">Lokasi: <span id="absensi_latitude_masuk"></span>,
                                <span id="absensi_longitude_masuk"></span>
                            </p>
                            <p class="text-muted">Alamat: <span id="absensi_alamat"></span></p>
                            <a href="" target="_blank" class="d-block mb-2">
                                Lihat Foto Masuk
                            </a>
                        </div>

                        <!-- JAM KELUAR -->
                        <div class="col-md-6">
                            <h6 class="fw-bold">Jam Keluar</h6>
                            <p class="mb-1" id="absensi_jam_keluar"></p>
                            @if ($absensi->foto_keluar)
                                <p class="text-muted mb-0">Lokasi: <span id="absensi_latitude_keluar"></span>,
                                    <span id="absensi_longitude_keluar"></span>
                                </p>
                                <p class="text-muted">Alamat: <span id="absensi_alamat"></span></p>
                                <a href="" target="_blank" class="d-block mb-2">
                                    Lihat Foto Keluar
                                </a>
                            @else
                                <p class="text-muted">Belum melakukan absensi keluar</p>
                            @endif
                        </div>
                    </div>
                    <div>
                        <p>Catatan : </p>
                        <div id="absensi_catatan"></div>
                    </div>
                    <small class="text-muted">Terakhir diperbarui:
                        <span id="absensi_updated_at"></span></small>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
