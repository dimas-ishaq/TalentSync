import {
    getById,
    queryAll,
    displayError,
    removeDisplayError,
} from "../../../components/helper";

const tanggalMulai = getById("tanggal_mulai");
const tanggalBerakhir = getById("tanggal_berakhir");
const formDeletePengajuan = getById("formDeletePengajuan");
const btnDeletePengajuan = queryAll("#btnDeletePengajuan");
const formCreatePengajuan = getById("formCreatePengajuan");

function setDefaultDate() {
    const date = new Date();
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, "0"); // Bulan dimulai dari 0
    const day = String(date.getDate()).padStart(2, "0");

    const tanggalHariIni = `${year}-${month}-${day}`;

    // Misalnya ingin set value ke input date
    tanggalMulai.value = tanggalHariIni;
    tanggalBerakhir.value = tanggalHariIni;

    tanggalMulai.addEventListener("input", () => {
        tanggalBerakhir.value = tanggalMulai.value;
    });
}

btnDeletePengajuan.forEach((btn) => {
    const pengajuanId = btn.dataset.id;
    btn.addEventListener(
        "click",
        () => {
            formDeletePengajuan.action = `/dashboard/karyawan/pengajuan/${pengajuanId}`;
        },
        { once: true }
    );
});

function formPengajuanValidation() {
    const inputJenis = getById("jenis");
    const inputTanggalMulai = getById("tanggal_mulai");
    const inputTanggalBerakhir = getById("tanggal_berakhir");
    const inputAlasan = getById("alasan");
    const inputLampiran = getById("lampiran");

    let isValid = true;

    if (!inputJenis.value.trim()) {
        isValid = false;
        displayError(inputJenis, "Jenis pengajuan wajib diisi.");
    } else {
        removeDisplayError(inputJenis);
    }

    if (!inputTanggalMulai.value) {
        isValid = false;
        displayError(inputTanggalMulai, "Tanggal mulai wajib diisi.");
    } else {
        removeDisplayError(inputTanggalMulai);
    }

    if (!inputTanggalBerakhir.value) {
        isValid = false;
        displayError(inputTanggalBerakhir, "Tanggal berakhir wajib diisi.");
    } else {
        removeDisplayError(inputTanggalBerakhir);
    }

    if (inputTanggalMulai.value && inputTanggalBerakhir.value) {
        if (
            new Date(inputTanggalMulai.value) >
            new Date(inputTanggalBerakhir.value)
        ) {
            isValid = false;
            displayError(
                inputTanggalBerakhir,
                "Tanggal berakhir tidak boleh lebih awal dari tanggal mulai."
            );
        } else {
            removeDisplayError(inputTanggalBerakhir);
        }
    }

    if (!inputAlasan.value.trim()) {
        isValid = false;
        displayError(inputAlasan, "Alasan wajib diisi.");
    } else {
        removeDisplayError(inputAlasan);
    }

    // Validasi lampiran jika diperlukan (contoh: wajib PDF)
    if (inputLampiran.files.length > 0) {
        const file = inputLampiran.files[0];
        const allowedTypes = ["application/pdf"];

        if (!allowedTypes.includes(file.type)) {
            isValid = false;
            displayError(inputLampiran, "Lampiran harus berupa file PDF.");
        } else {
            removeDisplayError(inputLampiran);
        }
    }

    return isValid;
}

formCreatePengajuan.addEventListener("submit", (e) => {
    const isValid = formPengajuanValidation();
    if (!isValid) {
        e.preventDefault();
    }
});


document.addEventListener("DOMContentLoaded", () => {
    setDefaultDate();
});
