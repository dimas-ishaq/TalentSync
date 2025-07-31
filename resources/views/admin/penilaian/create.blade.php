<div class="modal fade" id="prosesPenilaianModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="prosesPenilaianModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h1 class="modal-title fs-5" id="prosesPenilaianModalLabel">Formulir Penilaian Karyawan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.penilaian.store') }}" method="post">
                <div class="modal-body">
                    @csrf
                    @method('POST')

                    <div class="row">
                        <input type="hidden" name="karyawan_id" value="" id="karyawan_id">
                        <div class=" col mb-3">
                            <label for="create_penilaian_nama" class="form-label">Nama Karyawan</label>
                            <input type="text" name="nama" id="create_penilaian_nama"
                                class="form-control form-control-sm" disabled value="">
                        </div>
                        <div class=" col mb-3">
                            <label for="create_penilaian_jabatan" class="form-label">Jabatan</label>
                            <input type="text" name="jabatan" id="create_penilaian_jabatan"
                                class="form-control form-control-sm" disabled value="">
                        </div>
                        <div class=" col mb-3">
                            <label for="create_penilaian_department" class="form-label">Department</label>
                            <input type="text" name="department" id="create_penilaian_department"
                                class="form-control form-control-sm" disabled value="">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="create_penilaian_periode" class="form-label">Periode</label>
                        <input type="date" name="periode" id="create_penilaian_periode"
                            class="form-control form-control-sm" required>
                    </div>

                    <h6 class="text-center">Pertanyaan dan Skoring</h6>
                    <div class="mb-3 row flex-column align-items-center">
                        <div class="col">
                            1. Seberapa disiplin karyawan ini dalam hal kehadiran, ketepatan waktu, dan
                            menyelesaikan
                            tugas?
                        </div>
                        <div class="col">
                            @foreach (range(1, 10) as $point)
                                <div class="form-check form-check-inline ">
                                    <input class="form-check-input" type="radio" name="disiplin"
                                        id="disiplin-{{ $point }}" value="{{ $point }}" required>
                                    <label class="form-check-label"
                                        for="disiplin-{{ $point }}">{{ $point }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-3 row flex-column align-items-center">
                        <div class="col">
                            2. Seberapa baik kemampuan karyawan ini dalam bekerja sama dan berkomunikasi dengan tim?
                        </div>
                        <div class="col">
                            @foreach (range(1, 10) as $point)
                                <div class="form-check form-check-inline ">
                                    <input class="form-check-input" type="radio" name="kerja_sama"
                                        id="kerja_sama-{{ $point }}" value="{{ $point }}" required>
                                    <label class="form-check-label"
                                        for="kerja_sama-{{ $point }}">{{ $point }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-3 row flex-column align-items-center">
                        <div class="col">
                            3. Seberapa tinggi tanggung jawab karyawan ini terhadap tugas yang diberikan dan hasil
                            kerjanya?
                        </div>
                        <div class="col">
                            @foreach (range(1, 10) as $point)
                                <div class="form-check form-check-inline ">
                                    <input class="form-check-input" type="radio" name="tanggung_jawab"
                                        id="tanggung_jawab-{{ $point }}" value="{{ $point }}" required>
                                    <label class="form-check-label"
                                        for="tanggung_jawab-{{ $point }}">{{ $point }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-3 row flex-column align-items-center">
                        <div class="col">
                            4. Seberapa sering karyawan ini menunjukkan inisiatif dan proaktif dalam pekerjaannya?
                        </div>
                        <div class="col">
                            @foreach (range(1, 10) as $point)
                                <div class="form-check form-check-inline ">
                                    <input class="form-check-input" type="radio" name="inisiatif"
                                        id="inisiatif-{{ $point }}" value="{{ $point }}" required>
                                    <label class="form-check-label"
                                        for="inisiatif-{{ $point }}">{{ $point }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-3 row flex-column align-items-center">
                        <div class="col">
                            5. Seberapa baik sikap, perilaku, dan kepatuhan karyawan ini terhadap aturan dan etika
                            kerja?
                        </div>
                        <div class="col">
                            @foreach (range(1, 10) as $point)
                                <div class="form-check form-check-inline ">
                                    <input class="form-check-input" type="radio" name="etika_kerja"
                                        id="etika_kerja-{{ $point }}" value="{{ $point }}" required>
                                    <label class="form-check-label"
                                        for="etika_kerja-{{ $point }}">{{ $point }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-3 row flex-column align-items-center">
                        <div class="col">
                            6. Seberapa baik pencapaian karyawan ini dalam memenuhi target kerja atau hasil yang
                            diharapkan?
                        </div>
                        <div class="col">
                            @foreach (range(1, 10) as $point)
                                <div class="form-check form-check-inline ">
                                    <input class="form-check-input" type="radio" name="target_kerja"
                                        id="target_kerja-{{ $point }}" value="{{ $point }}" required>
                                    <label class="form-check-label"
                                        for="target_kerja-{{ $point }}">{{ $point }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan</label>
                        <textarea class="form-control form-control-sm" id="catatan" rows="3" name="catatan"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select form-select-sm">
                            <option value="draft" selected>Draft</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>

        </div>
    </div>
</div>
