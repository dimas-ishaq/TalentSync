<div class="modal fade" id="detailKaryawan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="detailKaryawanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h4 class="mb-0">Detail Karyawan: <span id="info_nama_karyawan"></span></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="row g-0 py-4">
                <div class="col-md-3 d-flex flex-column align-items-center justify-content-center text-center ">
                    <img src="{{ asset('images/profile.png') }}" alt="Foto Profil" title="Foto Profil Karyawan"
                        class="img-thumbnail rounded-circle mb-3"
                        style="width: 150px; height: 150px; object-fit: cover;">
                    <h5 class="mt-2 mb-0" id="info_nama_karyawan"></h5>
                    <p class="text-muted" id="info_nama_jabatan_department"></p>
                </div>
                <div class="col-md-9">
                    <div class="py-0">
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Agama:
                                        <span class="fw-bold" id="info_agama"></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Tanggal Masuk:
                                        <span class="fw-bold" id="info_tanggal_masuk"></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Status Karyawan:
                                        <span class="fw-bold" id="info_status"></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Status Pernikahan:
                                        <span class="fw-bold" id="info_status_pernikahan"></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <strong>Alamat:</strong>
                                        <p class="mb-0 text-muted" id="info_alamat"></p>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Keterampilan:</strong>
                                        <p class="mb-0 text-muted" id="info_keterampilan"></p>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Pengalaman Kerja:</strong>
                                        <p class="mb-0 text-muted" id="info_pengalaman_kerja"></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
