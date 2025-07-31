import { getById } from "../../../components/helper";

const gajiPokok = getById("create_gaji_pokok");
const tunjanganTetap = getById("create_tunjangan_tetap");
const tunjanganTidakTetap = getById("create_tunjangan_tidak_tetap");

const potonganBPJSKesehatan = getById("create_pot_bpjs_kesehatan");
const potonganBPJSKetenagakerjaan = getById("create_pot_bpjs_ketenagakerjaan");
const potonganPPH21 = getById("create_pot_pph21");
const potonganPinjaman = getById("create_pot_pinjaman");
const potonganDenda = getById("create_pot_denda");

const totalPendapatan = getById("total_pendapatan");
const totalPotongan = getById("total_potongan");
const totalGajiBersih = getById("gaji_bersih");

export function hitungTotalPendapatan() {
    const gajiPokokInput = parseFloat(gajiPokok.value) || 0;
    const tunjanganTetapInput = parseFloat(tunjanganTetap.value) || 0;
    const tunjanganTidakTetapInput = parseFloat(tunjanganTidakTetap.value) || 0;
    const total =
        gajiPokokInput + tunjanganTetapInput + tunjanganTidakTetapInput;
    totalPendapatan.textContent = total;
    totalGajiBersih.textContent = parseFloat(
        totalPendapatan.textContent - totalPotongan.textContent
    );
}

export function hitungTotalPotongan() {
    const potonganBPJSKesehatanInput =
        parseFloat(potonganBPJSKesehatan.value) || 0;
    const potonganBPJSKetenagakerjaanInput =
        parseFloat(potonganBPJSKetenagakerjaan.value) || 0;
    const potonganPPH21Input = parseFloat(potonganPPH21.value) || 0;
    const potonganPinjamanInput = parseFloat(potonganPinjaman.value) || 0;
    const potonganDendaInput = parseFloat(potonganDenda.value) || 0;
    const total =
        potonganBPJSKesehatanInput +
        potonganBPJSKetenagakerjaanInput +
        potonganPPH21Input +
        potonganPinjamanInput +
        potonganDendaInput;
    totalPotongan.textContent = total;

    totalGajiBersih.textContent = parseFloat(
        totalPendapatan.textContent - totalPotongan.textContent
    );
}
gajiPokok.addEventListener("input", hitungTotalPendapatan);
tunjanganTetap.addEventListener("input", hitungTotalPendapatan);
tunjanganTidakTetap.addEventListener("input", hitungTotalPendapatan);
potonganBPJSKesehatan.addEventListener("input", hitungTotalPotongan);
potonganBPJSKetenagakerjaan.addEventListener("input", hitungTotalPotongan);
potonganPPH21.addEventListener("input", hitungTotalPotongan);
potonganPinjaman.addEventListener("input", hitungTotalPotongan);
potonganDenda.addEventListener("input", hitungTotalPotongan);
