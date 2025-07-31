<div class="modal fade" id="editKaryawan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editKaryawanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <div class="row w-100 custom-progress-bar  align-items-start justify-content-center">
                    <div class="col d-flex flex-column justify-content-center ">
                        <i class="bi bi-1-circle-fill text-primary" style="font-size: 2rem"></i>
                        <span class="text-muted ">Informasi Pribadi</span>
                    </div>
                    <div class="col d-flex flex-column justify-content-center">
                        <i class="bi bi-2-circle-fill text-secondary" style="font-size: 2rem"></i>
                        <span class="text-muted ">Informasi Pekerjaan & Status</span>
                    </div>
                    <div class="col d-flex flex-column justify-content-center">
                        <i class="bi bi-3-circle-fill text-secondary" style="font-size: 2rem"></i>
                        <span class="text-muted ">Informasi Alamat & Pengalaman</span>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST" id="form-update">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <section class="form-steps-update">
                                <input type="hidden" name="id" id="karyawan_id">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="update_nama" class="form-label">Nama
                                                Karyawan</label>
                                            <input type="text" class="form-control" id="update_nama" name="nama">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="update_email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="update_email" name="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="update_no_telepon" class="form-label">No
                                                Telepon</label>
                                            <input type="text" name="no_telepon" id="update_no_telepon"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="update_jenis_kelamin" class="form-label">Jenis
                                                Kelamin</label>
                                            @php
                                                $jenis_kelamin_options = ['L', 'P'];
                                            @endphp
                                            <select name="jenis_kelamin" id="update_jenis_kelamin" class="form-select">
                                                @foreach ($jenis_kelamin_options as $jenis_kelamin)
                                                    <option value="{{ $jenis_kelamin }}">
                                                        {{ $jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="update_agama" class="form-label">Agama</label>
                                            @php
                                                $agama_options = ['Islam', 'Kristen', 'Hindu', 'Budha', 'Konghucu'];
                                            @endphp
                                            <select name="agama" id="update_agama" class="form-select">
                                                @foreach ($agama_options as $agama)
                                                    <option value="{{ $agama }}">
                                                        {{ $agama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="update_pendidikan_terakhir" class="form-label">Pendidikan
                                        Terakhir</label>
                                    @php
                                        $pendidikan_terakhir_options = [
                                            'SD',
                                            'SMP',
                                            'SMA/SMK',
                                            'D1',
                                            'D2',
                                            'D3',
                                            'S1',
                                            'S2',
                                        ];

                                    @endphp
                                    <select name="pendidikan_terakhir" id="update_pendidikan_terakhir"
                                        class="form-select">
                                        @foreach ($pendidikan_terakhir_options as $pendidikan)
                                            <option value="{{ $pendidikan }}">
                                                {{ $pendidikan }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="update_status_pernikahan" class="form-label">Status
                                        Pernikahan</label>
                                    @php
                                        $status_pernikahan_options = [
                                            'Belum Menikah',
                                            'Menikah',
                                            'Cerai Hidup',
                                            'Cerai Mati',
                                        ];
                                    @endphp
                                    <select name="status_pernikahan" id="update_status_pernikahan" class="form-select">
                                        @foreach ($status_pernikahan_options as $status_pernikahan)
                                            <option value="{{ $status_pernikahan }}">
                                                {{ $status_pernikahan }}</option>
                                        @endforeach
                                    </select>
                                </div>


                            </section>

                            <section class="form-steps-update d-none">
                                <div class="mb-3">
                                    <label for="update_jabatan" class="form-label">Jabatan</label>
                                    <select class="form-select" name="jabatan_id" id="update_jabatan"
                                        aria-label="Select jabatan">
                                        @foreach ($jabatans as $jabatan)
                                            <option value="{{ $jabatan->id }}">
                                                {{ $jabatan->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="update_department" class="form-label">Department</label>
                                    <select name="department_id" id="update_department" class="form-select"
                                        aria-label="Select jabatan">
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">
                                                {{ $department->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="update_tanggal_masuk" class="form-label">Tanggal
                                        Masuk</label>

                                    <input type="date" class="form-control" id="update_tanggal_masuk"
                                        name="tanggal_masuk" />
                                </div>

                                <div class="mb-3">
                                    <label for="update_status" class="form-label">Status</label>
                                    @php
                                        $status_options = ['aktif', 'nonaktif'];
                                    @endphp
                                    <select name="status" id="update_status" class="form-select">
                                        @foreach ($status_options as $status)
                                            <option value="{{ $status }}">
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </section>
                            <section class="form-steps-update d-none">
                                <div class="mb-3">
                                    <label for="update_alamat" class="form-label">Alamat</label>
                                    <textarea name="alamat" id="update_alamat" rows="2" class="form-control"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="update_pengalaman_kerja" class="form-label">Pengalaman Kerja</label>
                                    <textarea name="pengalaman_kerja" id="update_pengalaman_kerja" rows="2" class="form-control"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="update_keterampilan" class="form-label">Keterampilan</label>
                                    <textarea name="keterampilan" id="update_keterampilan" rows="2" class="form-control"></textarea>
                                </div>
                            </section>
                        </div>
                        <div class="modal-footer align-items-center">
                            <div
                                class="d-flex flex-column flex-lg-row justify-content-between align-items-center w-100 gap-2">
                                <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal"
                                    id="btnClose">Close <i class="bi bi-x-octagon-fill"></i></button>
                                <div
                                    class="d-flex flex-column flex-lg-row align-items-center justify-self-end gap-2 w-100">
                                    <button type="button" class="btn btn-secondary d-none w-100" id="btnPrevious">
                                        <i class="bi bi-arrow-left"></i>Kembali </button>
                                    <button type="button" class="btn btn-primary w-100" id="btnNext">Selanjutnya
                                        <i class="bi bi-arrow-right"></i></button>
                                    <button type="button" class="btn btn-primary d-none w-100" id="btnSave">Simpan
                                        <i class="bi bi-save-fill"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
