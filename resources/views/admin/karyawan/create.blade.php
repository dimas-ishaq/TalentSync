<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="tambahKaryawanModal" tabindex="-1"
    aria-labelledby="tambahKaryawanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg ">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <div class="row w-100 custom-progress-bar create align-items-start justify-content-center">
                    <div class="col d-flex flex-column justify-content-center">
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
            <form action="{{ route('admin.karyawan.store') }}" method="POST" id="form-create">
                @csrf
                @method('POST')
                <div class="modal-body shadow-sm">
                    <section class="form-steps-create">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="create_nama" name="nama" value="{{ old('nama') }}" placeholder="Nama">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="create_email" name="email" value="{{ old('email') }}"
                                        placeholder="Email">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="mb-3 input-group">
                                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                    <input type="text" name="no_telepon" id="create_no_telepon"
                                        class="form-control @error('no_telepon') is-invalid @enderror" minlength="8"
                                        value="{{ old('no_telepon') }}" placeholder="Nomor Telepon">
                                    @error('no_telepon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="mb-3">
                                    @php
                                        $jenis_kelamin_options = ['L', 'P'];
                                    @endphp
                                    <select name="jenis_kelamin" id="create_jenis_kelamin"
                                        class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                        <option disabled value=""
                                            {{ empty(old('jenis_kelamin')) ? 'selected' : '' }}>Jenis
                                            Kelamin</option>
                                        @foreach ($jenis_kelamin_options as $jenis_kelamin)
                                            <option value="{{ $jenis_kelamin }}"
                                                {{ old('jenis_kelamin') == $jenis_kelamin ? 'selected' : '' }}>
                                                {{ $jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</option>
                                        @endforeach
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="mb-3">

                                    @php
                                        $agama_options = ['Islam', 'Kristen', 'Hindu', 'Budha', 'Konghucu'];
                                    @endphp
                                    <select name="agama" id="create_agama"
                                        class="form-select @error('agama') is-invalid @enderror">
                                        <option disabled value="" {{ empty(old('agama')) ? 'selected' : '' }}>
                                            Agama
                                        </option>
                                        @foreach ($agama_options as $agama)
                                            <option value="{{ $agama }}"
                                                {{ old('agama') == $agama ? 'selected' : '' }}>
                                                {{ $agama }}</option>
                                        @endforeach
                                    </select>
                                    @error('agama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
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
                                <select name="pendidikan_terakhir" id="create_pendidikan_terakhir"
                                    class="form-select @error('pendidikan_terakhir') is-invalid @enderror">
                                    <option disabled value=""
                                        {{ empty(old('pendidikan_terakhir')) ? 'selected' : '' }}>
                                        Pendidikan Terakhir</option>
                                    @foreach ($pendidikan_terakhir_options as $pendidikan)
                                        <option value="{{ $pendidikan }}"
                                            {{ old('pendidikan_terakhir') == $pendidikan ? 'selected' : '' }}>
                                            {{ $pendidikan }}</option>
                                    @endforeach
                                </select>
                                @error('pendidikan_terakhir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">

                                @php
                                    $status_pernikahan_options = [
                                        'Belum Menikah',
                                        'Menikah',
                                        'Cerai Hidup',
                                        'Cerai Mati',
                                    ];
                                @endphp
                                <select name="status_pernikahan" id="create_status_pernikahan"
                                    class="form-select @error('status_pernikahan') is-invalid @enderror">
                                    <option disabled value=""
                                        {{ empty(old('status_pernikahan')) ? 'selected' : '' }}>
                                        Status Pernikahan</option>
                                    @foreach ($status_pernikahan_options as $status_pernikahan)
                                        <option value="{{ $status_pernikahan }}"
                                            {{ old('status_pernikahan') == $status_pernikahan ? 'selected' : '' }}>
                                            {{ $status_pernikahan }}</option>
                                    @endforeach
                                </select>
                                @error('status_pernikahan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </section>
                    <section class="form-steps-create d-none">
                        <div class="mb-3">
                            <select class="form-select @error('jabatan_id') is-invalid @enderror" name="jabatan_id"
                                id="create_jabatan" aria-label="Select jabatan">
                                <option disabled value="" {{ empty(old('jabatan_id')) ? 'selected' : '' }}>
                                    Jabatan
                                </option>
                                @foreach ($jabatans as $jabatan)
                                    <option value="{{ $jabatan->id }}"
                                        {{ old('jabatan_id') == $jabatan->id ? 'selected' : '' }}>
                                        {{ $jabatan->nama }}
                                    </option>
                                @endforeach

                            </select>
                            @error('jabatan_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">

                            <select name="department_id" id="create_department"
                                class="form-select @error('department_id') is-invalid @enderror"
                                aria-label="Select department">
                                <option disabled value="" {{ empty(old('department_id')) ? 'selected' : '' }}>
                                    Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                        {{ $department->nama }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3 input-group">
                            <span class="input-group-text">Tanggal Masuk</span>
                            <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror"
                                id="create_tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" />
                            @error('tanggal_masuk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            @php
                                $status_options = ['aktif', 'nonaktif'];
                            @endphp
                            <select name="status" id="create_status"
                                class="form-select @error('status') is-invalid @enderror">
                                <option disabled value="" {{ empty(old('status')) ? 'selected' : '' }}>Status
                                    Karyawan
                                </option>
                                @foreach ($status_options as $status)
                                    <option value="{{ $status }}"
                                        {{ old('status') == $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </section>

                    <section class="form-steps-create d-none">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="create_alamat" class="form-label">Alamat</label>
                                    <input type="text" name="alamat" id="create_alamat"
                                        class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</input>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="create_pengalaman_kerja" class="form-label">Pengalaman Kerja</label>
                                    <textarea name="pengalaman_kerja" id="create_pengalaman_kerja" rows="2"
                                        class="form-control @error('pengalaman_kerja') is-invalid @enderror">{{ old('pengalaman_kerja') }}</textarea>
                                    @error('pengalaman_kerja')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="create_keterampilan" class="form-label">Keterampilan</label>
                                    <textarea name="keterampilan" id="create_keterampilan" rows="2"
                                        class="form-control @error('keterampilan') @enderror">{{ old('keterampilan') }}</textarea>
                                    @error('keterampilan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="modal-footer align-items-center">
                        <div
                            class="d-flex flex-column flex-lg-row justify-content-between align-items-center w-100 gap-2">
                            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal"
                                id="btnClose">Close <i class="bi bi-x-octagon-fill"></i></button>
                            <div
                                class="d-flex flex-column flex-lg-row align-items-center justify-self-end gap-2 w-100">
                                <button type="button" class="btn btn-secondary d-none w-100" id="btnPreviousCreate">
                                    <i class="bi bi-arrow-left"></i>Kembali </button>
                                <button type="button" class="btn btn-primary w-100" id="btnNextCreate">Selanjutnya
                                    <i class="bi bi-arrow-right"></i></button>
                                <button type="button" class="btn btn-primary d-none w-100" id="btnSaveCreate">Simpan
                                    <i class="bi bi-save-fill"></i></button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
