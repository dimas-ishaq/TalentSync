import { showToast } from "../../../components/toast";
import { getById, queryAll } from "../../../components/helper";
import {
    hitungTotalPendapatan,
    hitungTotalPotongan,
} from "./hitung_penggajian";
import { rulesCreatePenggajian, rulesEditPenggajian } from "./validation";
import { validateForm } from "../../../components/helper";

// fetch data karyawan
// params Id karyawan
// return data karyawan by Id
async function fetchDataKaryawanById(id) {
    try {
        const response = await fetch(`/dashboard/admin/karyawan/${id}`);
        const responseJSON = await response.json();
        return responseJSON;
    } catch (error) {
        return showToast(error.message, "warning");
    }
}

// fetch data penggajian
// params id penggajian
// return single data penggajian
async function fetchDataPenggajianById(id) {
    try {
        const response = await fetch(`/dashboard/admin/penggajian/${id}`, {
            headers: {
                Accept: "application/json",
            },
        });
        const responseJSON = await response.json();
        return responseJSON;
    } catch (error) {
        console.log(error);
        return showToast(error.message, "warning");
    }
}

// display data karyawan
async function displayDataKaryawan(data) {
    const { id, nama, jabatan, department } = data;
    const { nama: namaJabatan, gaji_pokok } = jabatan;
    const { nama: namaDepartment } = department;

    const karyawanId = getById("karyawan_id");
    const createPenggajianNamaKaryawan = getById("create_nama_karyawan");
    const createPenggajianJabatan = getById("create_jabatan");
    const createPenggajianDepartment = getById("create_department");
    const createPenggajianGajiPokok = getById("create_gaji_pokok");

    karyawanId.value = id;
    createPenggajianNamaKaryawan.value = nama;
    createPenggajianJabatan.value = namaJabatan;
    createPenggajianDepartment.value = namaDepartment;
    createPenggajianGajiPokok.value = gaji_pokok;
}

const periodeMulai = getById("create_periode_mulai");
const periodeSelesai = getById("create_periode_selesai");

periodeMulai.addEventListener("change", () => {
    const tanggalMulaiString = periodeMulai.value;
    if (tanggalMulaiString) {
        const tanggalMulai = new Date(tanggalMulaiString);
        if (!isNaN(tanggalMulai.getTime())) {
            tanggalMulai.setMonth(tanggalMulai.getMonth() + 1);

            // Format the new date back into 'YYYY-MM-DD' for the input field
            const year = tanggalMulai.getFullYear();
            const month = String(tanggalMulai.getMonth() + 1).padStart(2, "0"); // Months are 0-indexed, so add 1
            const day = String(tanggalMulai.getDate()).padStart(2, "0");

            periodeSelesai.value = `${year}-${month}-${day}`;
        }
    }
});

async function displayDataPenggajian(data) {
    const {
        periode_mulai,
        periode_selesai,
        gaji_pokok,
        tunjangan_tetap,
        tunjangan_tidak_tetap,
        pot_bpjs_kesehatan,
        pot_bpjs_ketenagakerjaan,
        pot_pph21,
        pot_pinjaman,
        pot_denda,
        tanggal_pembayaran,
        status_pembayaran,
        karyawan,
    } = data;
    const { nama: namaKaryawan } = karyawan;
    const { nama: namaJabatan } = karyawan.jabatan;
    const { nama: namaDepartment } = karyawan.department;

    const penggajianNamaKaryawan = getById("nama_karyawan");
    const editPenggajianNamaKaryawan = getById("edit_nama_karyawan");
    const editPenggajianJabatan = getById("edit_jabatan");
    const editPenggajianDepartment = getById("edit_department");
    const editPenggajianPeriodeMulai = getById("edit_periode_mulai");
    const editPenggajianPeriodeSelesai = getById("edit_periode_selesai");

    const editPenggajianGajiPokok = getById("edit_gaji_pokok");
    const editPenggajianTunjanganTetap = getById("edit_tunjangan_tetap");
    const editPenggajianTunjanganTidakTetap = getById(
        "edit_tunjangan_tidak_tetap"
    );
    const editPenggajianPotBPJSKesehatan = getById("edit_pot_bpjs_kesehatan");
    const editPenggajianPotBPJSKetenagakerjaan = getById(
        "edit_pot_bpjs_ketenagakerjaan"
    );
    const editPenggajianPotPPH21 = getById("edit_pot_pph21");
    const editPenggajianPotPinjaman = getById("edit_pot_pinjaman");
    const editPenggajianPotDenda = getById("edit_pot_denda");
    const editPenggajianTanggalPembayaran = getById("edit_tanggal_pembayaran");
    const editPenggajianStatusPembayaran = getById("edit_status_pembayaran");

    penggajianNamaKaryawan.textContent = namaKaryawan;
    editPenggajianNamaKaryawan.value = namaKaryawan;
    editPenggajianJabatan.value = namaJabatan;
    editPenggajianDepartment.value = namaDepartment;
    editPenggajianPeriodeMulai.value = periode_mulai;
    editPenggajianPeriodeSelesai.value = periode_selesai;

    editPenggajianGajiPokok.value = gaji_pokok;
    editPenggajianTunjanganTetap.value = tunjangan_tetap;
    editPenggajianTunjanganTidakTetap.value = tunjangan_tidak_tetap;
    editPenggajianPotBPJSKesehatan.value = pot_bpjs_kesehatan;
    editPenggajianPotBPJSKetenagakerjaan.value = pot_bpjs_ketenagakerjaan;
    editPenggajianPotPPH21.value = pot_pph21;
    editPenggajianPotPinjaman.value = pot_pinjaman;
    editPenggajianPotDenda.value = pot_denda;
    editPenggajianTanggalPembayaran.value = tanggal_pembayaran;
    editPenggajianStatusPembayaran.value = status_pembayaran;
}

// addlistener btnProsesPenggajian
const btnProsesPenggajian = queryAll("#btnProsesPenggajian");
btnProsesPenggajian.forEach((btn) => {
    const karyawanId = btn.dataset.id;
    btn.addEventListener("click", async () => {
        const data = await fetchDataKaryawanById(karyawanId);
        await displayDataKaryawan(data);
        hitungTotalPendapatan();
        hitungTotalPotongan();
    });
});

// addlistener formCreatePenggajian
const formCreatePenggajian = getById("formCreatePenggajian");
formCreatePenggajian.addEventListener("submit", (e) => {
    const isValid = validateForm(rulesCreatePenggajian);
    if (!isValid) {
        e.preventDefault();
    }
});

// addEventListener btnEditPenggajian
const btnEditPenggajian = queryAll("#btnEditPenggajian");
if (btnEditPenggajian) {
    btnEditPenggajian.forEach((btn) => {
        const penggajianId = btn.dataset.id;
        const formEditPenggajian = getById("formEditPenggajian");
        btn.addEventListener("click", async () => {
            const data = await fetchDataPenggajianById(penggajianId);
            await displayDataPenggajian(data);
            formEditPenggajian.action = `/dashboard/admin/penggajian/${penggajianId}`;
        });
    });
}

// addEventListener formEditPenggajian
const formEditPenggajian = getById("formEditPenggajian");
formEditPenggajian.addEventListener("submit", (e) => {
    const isValid = validateForm(rulesEditPenggajian);
    if (!isValid) {
        e.preventDefault();
    }
});
