<div class="modal fade" id="prosesPenggajianModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="prosesPenggajianModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h1 class="modal-title fs-5" id="prosesPenggajianModalLabel">Form Proses Penggajian
                    <span id="penggajian_nama_karyawan"></span>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.penggajian.store') }}" method="post" id="formCreatePenggajian">
                <div class="modal-body">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="karyawan_id" id="karyawan_id" value="">
                    <div class="row ">
                        <div class="mb-3 col">
                            <label class="form-label" for="create_nama_karyawan">Nama Karyawan</label>
                            <input type="text" class="form-control form-control-sm" value=""
                                id="create_nama_karyawan" readonly disabled>
                        </div>
                        <div class="mb-3 col">
                            <label for="create_jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control form-control-sm" id="create_jabatan"
                                name="jabatan" value="" readonly disabled>
                        </div>
                        <div class="mb-3 col">
                            <label for="create_department" class="form-label">Department</label>
                            <input type="text" class="form-control form-control-sm" id="create_department"
                                name="department" value="" readonly disabled>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="create_periode_mulai" class="form-label">Periode Mulai</label>
                            <input type="date" name="periode_mulai" id="create_periode_mulai"
                                class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="create_periode_selesai" class="form-label">Periode Selesai</label>
                            <input type="date" name="periode_selesai" id="create_periode_selesai"
                                class="form-control form-control-sm" required>
                        </div>
                    </div>

                    {{-- Komponen Gaji --}}
                    <div class="row">
                        <div class="col-md-3 mb-3 ">
                            <label for="create_gaji_pokok" class="form-label">Gaji Pokok</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">IDR</span>
                                <input type="number" name="gaji_pokok" id="create_gaji_pokok"
                                    class="form-control form-control-sm" value="" readonly>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="create_tunjangan_tetap">Tunjangan Tetap</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">IDR</span>
                                <input type="number" name="tunjangan_tetap" id="create_tunjangan_tetap"
                                    class="form-control form-control-sm" value="0">
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="create_tunjangan_tidak_tetap">Tunjangan Tidak Tetap</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">IDR</span>
                                <input type="number" name="tunjangan_tidak_tetap" id="create_tunjangan_tidak_tetap"
                                    class="form-control form-control-sm" value="0">
                            </div>
                        </div>
                    </div>

                    {{-- Potongan --}}
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="create_pot_bpjs_kesehatan">Pot BPJS Kesehatan</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">IDR</span>
                                <input type="number" name="pot_bpjs_kesehatan" id="create_pot_bpjs_kesehatan"
                                    class="form-control form-control-sm" value="0">
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="create_pot_bpjs_ketenagakerjaan">Pot BPJS
                                Tenaga Kerja</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">IDR</span>
                                <input type="number" name="pot_bpjs_ketenagakerjaan"
                                    id="create_pot_bpjs_ketenagakerjaan" class="form-control form-control-sm"
                                    value="0">
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="create_pot_pph21">Pot PPh 21</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">IDR</span>
                                <input type="number" name="pot_pph21" id="create_pot_pph21"
                                    class="form-control form-control-sm" value="0">
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="create_pot_pinjaman">Pot Pinjaman</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">IDR</span>
                                <input type="number" name="pot_pinjaman" id="create_pot_pinjaman"
                                    class="form-control form-control-sm" value="0">
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="create_pot_denda">Potongan Denda</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">IDR</span>
                                <input type="number" name="pot_denda" id="create_pot_denda"
                                    class="form-control form-control-sm" value="0">
                            </div>
                        </div>
                    </div>

                    {{-- Informasi Pembayaran --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="create_tanggal_pembayaran">Tanggal Pembayaran</label>
                            <input type="date" name="tanggal_pembayaran" id="create_tanggal_pembayaran"
                                class="form-control form-control-sm">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="create_status_pembayaran">Status Pembayaran</label>
                            <select name="status_pembayaran" class="form-select form-select-sm"
                                id="create_status_pembayaran">
                                <option value="pending">Pending</option>
                                <option value="dibayar">Dibayar</option>
                            </select>
                        </div>
                    </div>

                    {{-- Informasi Total Pendapatan Bersih --}}
                    <div class="row mb-3">
                        <div class="col ">
                            <div>Total Pendapatan : <span id="total_pendapatan"></span></div>
                            <div>Total Potongan : <span id="total_potongan"></span></div>
                            <div>Total Gaji Bersih : <span id="gaji_bersih"></span></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Penggajian</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
