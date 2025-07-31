<div class="modal fade" id="editPenggajianModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="editPenggajianModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header text-bg-warning">
                <h1 class="modal-title fs-5" id="editPenggajianModalLabel">Form Edit Penggajian <span id="nama_karyawan"></span>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" id="formEditPenggajian">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="edit_nama_karyawan" class="form-label">Nama Karyawan</label>
                            <input type="text" name="nama" class="form-control form-control-sm " value=""
                                disabled id="edit_nama_karyawan" readonly>
                        </div>
                        <div class="mb-3 col">
                            <label for="edit_jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control form-control-sm" id="edit_jabatan" name="jabatan"
                                value="" readonly disabled>
                        </div>
                        <div class="mb-3 col">
                            <label for="edit_department" class="form-label">Department</label>
                            <input type="text" class="form-control form-control-sm" id="edit_department"
                                name="department" value="" readonly disabled>
                        </div>
                    </div>

                    {{-- Periode --}}
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="edit_periode_mulai" class="form-label">Periode Mulai</label>
                            <input type="date" name="periode_mulai" class="form-control form-control-sm"
                                id="edit_periode_mulai" value="">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="edit_periode_selesai" class="form-label">Periode Selesai</label>
                            <input type="date" name="periode_selesai" class="form-control form-control-sm"
                                id="edit_periode_selesai" value="">
                        </div>
                    </div>
                    {{-- Gaji, Tunjangan --}}
                    <div class="row">
                        <div class="col-12 col-md-4 mb-3">
                            <label for="edit_gaji_pokok" class="form-label">Gaji Pokok</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">IDR</span>
                                <input type="text" name="gaji_pokok" id="edit_gaji_pokok"
                                    class="form-control form-control-sm" readonly value="">
                            </div>

                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <label for="edit_tunjangan_tetap" class="form-label">Tunjangan Tetap</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">IDR</span>
                                <input type="number" name="tunjangan_tetap" id="edit_tunjangan_tetap"
                                    class="form-control form-control-sm" value="">
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <label for="edit_tunjangan_tidak_tetap" class="form-label">Tunjangan Tidak Tetap</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">IDR</span>
                                <input type="number" name="tunjangan_tidak_tetap" id="edit_tunjangan_tidak_tetap"
                                    class="form-control form-control-sm" value="">
                            </div>
                        </div>
                    </div>
                    {{-- Potongan --}}
                    <div class="row">
                        <div class="col-12 col-md-3 mb-3">
                            <label for="edit_pot_bpjs_kesehatan" class="form-label">Pot BPJS Kesehatan</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">IDR</span>
                                <input type="number" name="pot_bpjs_kesehatan" id="edit_pot_bpjs_kesehatan"
                                    class="form-control form-control-sm" value="">
                            </div>
                        </div>
                        <div class="col-12 col-md-3 mb-3">
                            <label for="edit_pot_bpjs_ketenagakerjaan" class="form-label">Pot BPJS
                                Tenaga Kerja</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">IDR</span>
                                <input type="number" name="pot_bpjs_ketenagakerjaan"
                                    id="edit_pot_bpjs_ketenagakerjaan" class="form-control form-control-sm"
                                    value="">
                            </div>
                        </div>
                        <div class="col-12 col-md-3 mb-3">
                            <label for="edit_pot_pph21" class="form-label">Pot PPh 21</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">IDR</span>
                                <input type="number" name="pot_pph21" id="edit_pot_pph21"
                                    class="form-control form-control-sm" value="">
                            </div>
                        </div>
                        <div class="col-12 col-md-3 mb-3">
                            <label for="edit_pot_pinjaman" class="form-label">Pot Pinjaman</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">IDR</span>
                                <input type="number" name="pot_pinjaman" id="edit_pot_pinjaman"
                                    class="form-control form-control-sm" value="">
                            </div>
                        </div>
                        <div class="col-12 col-md-3 mb-3">
                            <label for="edit_pot_denda" class="form-label">Pot Denda</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">IDR</span>
                                <input type="number" name="pot_denda" id="edit_pot_denda"
                                    class="form-control form-control-sm" value="">
                            </div>
                        </div>
                    </div>
                    {{-- Pembayaran --}}
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="edit_tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
                            <input type="date" name="tanggal_pembayaran" id="edit_tanggal_pembayaran"
                                class="form-control form-control-sm" value="">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="edit_status_pembayaran" class="form-label">Status Pembayaran</label>
                            <select name="status_pembayaran" id="edit_status_pembayaran" class="form-select">
                                @php
                                    $status_pembayaran_option = ['pending', 'dibayar'];
                                @endphp
                                @foreach ($status_pembayaran_option as $status_pembayaran)
                                    <option value="{{ $status_pembayaran }}">
                                        {{ ucfirst($status_pembayaran) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
