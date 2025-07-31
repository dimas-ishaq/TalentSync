<!-- Modal -->
<div class="modal fade" id="pengajuanKaryawanModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="pengajuanKaryawanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content ">
            <div class="modal-header text-bg-primary">
                <h1 class="modal-title fs-5" id="pengajuanKaryawanModalLabel">Form Pengajuan Cuti</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('karyawan.pengajuan.store') }}" method="post" enctype="multipart/form-data"
                id="formCreatePengajuan">
                <div class="modal-body">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="jenis" class="form-label">Jenis</label>
                                <select class="form-select" name="jenis" id="jenis">
                                    <option disabled selected value="">Pilih Jenis</option>
                                    @php
                                        $jenisOptions = ['cuti', 'izin', 'sakit'];
                                    @endphp
                                    @foreach ($jenisOptions as $jenis)
                                        <option value="{{ $jenis }}">{{ ucwords($jenis) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="tanggal_berakhir" class="form-label">Tanggal Berakhir</label>
                                <input type="date" name="tanggal_berakhir" id="tanggal_berakhir"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="alasan" class="form-label">Alasan</label>
                                <input type="text" name="alasan" id="alasan" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="lampiran" class="form-label">Lampiran</label>
                                <input type="file" name="lampiran" id="lampiran" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-bookmark"></i> Ajukan</button>
                </div>
            </form>
        </div>
    </div>
</div>
