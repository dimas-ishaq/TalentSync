import MultiStepFormHandler from "../../../components/MultiStepFormHandler";
import {
    getById,
    queryAll,
    formatTanggalIndonesia,
    formatDateInputValue,
} from "../../../components/helper";
const createFormHandler = new MultiStepFormHandler({
    formElement: "form-create",
    formStepsSelector: ".form-steps-create",
    nextButtonId: "btnNextCreate",
    previousButtonId: "btnPreviousCreate",
    saveButtonId: "btnSaveCreate",
    progressBarSelector: ".custom-progress-bar.create i",
});

createFormHandler.addValidationRules(0, [
    {
        id: "create_nama",
        validations: [
            { type: "required", message: "Nama tidak boleh kosong" },
            { type: "minLength", value: 4, message: "Nama minimal 4 karakter" },
            {
                type: "maxLength",
                value: 50,
                message: "Nama maksimal 50 karakter",
            },
        ],
    },
    {
        id: "create_email",
        validations: [
            { type: "required", message: "Email tidak boleh kosong" },
            { type: "email", message: "Format email tidak valid" },
        ],
    },
    {
        id: "create_no_telepon",
        validations: [
            { type: "required", message: "Nomor Telepon tidak boleh kosong" },
            { type: "phone", message: "Nomor Telepon tidak valid" },
            {
                type: "minLength",
                value: 10,
                message: "Nomor Telepon minimal 10 digit",
            },
            {
                type: "maxLength",
                value: 13,
                message: "Nomor Telepon maksimal 13 digit",
            },
        ],
    },
    {
        id: "create_jenis_kelamin",
        validations: [{ type: "select", message: "Mohon pilih jenis kelamin" }],
    },
    {
        id: "create_agama",
        validations: [{ type: "select", message: "Mohon pilih agama" }],
    },
    {
        id: "create_pendidikan_terakhir",
        validations: [
            {
                type: "select",
                message: "Mohon pilih pendidikan terakhir",
            },
        ],
    },
    {
        id: "create_status_pernikahan",
        validations: [
            { type: "select", message: "Mohon pilih status pernikahan" },
        ],
    },
]);

createFormHandler.addValidationRules(1, [
    {
        id: "create_jabatan",
        validations: [{ type: "select", message: "Mohon pilih jabatan" }],
    },
    {
        id: "create_department",
        validations: [{ type: "select", message: "Mohon pilih department" }],
    },
    {
        id: "create_tanggal_masuk",
        validations: [
            {
                type: "required",
                message: "Tanggal masuk wajib diisi",
            },
            {
                type: "date",
                message: "Tanggal masuk tidak valid",
            },
        ],
    },
    {
        id: "create_status",
        validations: [
            { type: "select", message: "Mohon pilih status karyawan" },
        ],
    },
]);

createFormHandler.addValidationRules(2, [
    {
        id: "create_alamat",
        validations: [
            { type: "required", message: "Alamat tidak boleh kosong" },
            {
                type: "minLength",
                value: 15,
                message: "Deskripsi alamat terlalu sedikit",
            },
            {
                type: "maxLength",
                value: 255,
                message: "Deskripsi alamat maksimal 255 karakter",
            },
        ],
    },
]);

const btnEdit = queryAll("#btnEditKaryawan");
const updateFormHandlers = {}; // Untuk menyimpan instance yang sudah dibuat

btnEdit.forEach((element) => {
    element.addEventListener(
        "click",
        () => {
            const id = element.dataset.id;
            console.log(id);

            // // Cek apakah handler dengan ID tersebut sudah pernah dibuat
            if (!updateFormHandlers[id]) {
                const handler = new MultiStepFormHandler({
                    formElement: `form-update`,
                    formStepsSelector: `.form-steps-update`,
                    nextButtonId: `btnNext`,
                    previousButtonId: `btnPrevious`,
                    saveButtonId: `btnSave`,
                    progressBarSelector: `.custom-progress-bar.update-${id} i`,
                });

                handler.addValidationRules(0, [
                    {
                        id: `update_nama`,
                        validations: [
                            {
                                type: "required",
                                message: "Nama tidak boleh kosong",
                            },
                            {
                                type: "minLength",
                                value: 4,
                                message: "Nama minimal 4 karakter",
                            },
                            {
                                type: "maxLength",
                                value: 50,
                                message: "Nama maksimal 50 karakter",
                            },
                        ],
                    },
                    {
                        id: `update_email`,
                        validations: [
                            {
                                type: "required",
                                message: "Email tidak boleh kosong",
                            },
                            {
                                type: "email",
                                message: "Format email tidak valid",
                            },
                        ],
                    },
                    {
                        id: `update_no_telepon`,
                        validations: [
                            {
                                type: "required",
                                message: "Nomor Telepon tidak boleh kosong",
                            },
                            {
                                type: "phone",
                                message: "Nomor Telepon tidak valid",
                            },
                            {
                                type: "minLength",
                                value: 10,
                                message: "Minimal 10 digit",
                            },
                            {
                                type: "maxLength",
                                value: 13,
                                message: "Maksimal 13 digit",
                            },
                        ],
                    },
                    {
                        id: `update_jenis_kelamin`,
                        validations: [
                            {
                                type: "select",
                                message: "Mohon pilih jenis kelamin",
                            },
                        ],
                    },
                    {
                        id: `update_agama`,
                        validations: [
                            { type: "select", message: "Mohon pilih agama" },
                        ],
                    },
                    {
                        id: `update_pendidikan_terakhir`,
                        validations: [
                            {
                                type: "select",
                                message: "Mohon pilih pendidikan terakhir",
                            },
                        ],
                    },
                    {
                        id: `update_status_pernikahan`,
                        validations: [
                            {
                                type: "select",
                                message: "Mohon pilih status pernikahan",
                            },
                        ],
                    },
                ]);

                handler.addValidationRules(1, [
                    {
                        id: `update_jabatan`,
                        validations: [
                            { type: "select", message: "Mohon pilih jabatan" },
                        ],
                    },
                    {
                        id: `update_department`,
                        validations: [
                            {
                                type: "select",
                                message: "Mohon pilih department",
                            },
                        ],
                    },
                    {
                        id: `update_tanggal_masuk`,
                        validations: [
                            {
                                type: "required",
                                message: "Tanggal masuk wajib diisi",
                            },
                            {
                                type: "date",
                                message: "Tanggal masuk tidak valid",
                            },
                        ],
                    },
                    {
                        id: `update_status`,
                        validations: [
                            {
                                type: "select",
                                message: "Mohon pilih status karyawan",
                            },
                        ],
                    },
                ]);

                handler.addValidationRules(2, [
                    {
                        id: `update_alamat`,
                        validations: [
                            {
                                type: "required",
                                message: "Alamat tidak boleh kosong",
                            },
                            {
                                type: "minLength",
                                value: 15,
                                message: "Deskripsi alamat terlalu sedikit",
                            },
                            {
                                type: "maxLength",
                                value: 255,
                                message:
                                    "Deskripsi alamat maksimal 255 karakter",
                            },
                        ],
                    },
                ]);

                updateFormHandlers[id] = handler; // Simpan handler supaya tidak dibuat ulang
            }

            // // Jika kamu ingin melakukan sesuatu setelah form dibuka, seperti reset step:
            // updateFormHandlers[id].goToStep(0); // Optional: reset ke step awal
        },
        { once: true }
    );
});

async function fetchDataKaryawanById(id) {
    const response = await fetch(`/dashboard/admin/karyawan/${id}`, {
        method: "GET",
    });
    const responseJSON = await response.json();
    return responseJSON;
}

async function displayKaryawan(data) {
    const {
        id,
        nama,
        email,
        no_telepon,
        jabatan,
        department,
        agama,
        tanggal_masuk,
        status,
        status_pernikahan,
        alamat,
        keterampilan,
        pengalaman_kerja,
    } = data;

    const { nama: namaDepartment } = department;
    const { nama: namaJabatan } = jabatan;
    const infoNamaKaryawan = queryAll("#info_nama_karyawan");
    const infoNamaJabatanDepartment = getById("info_nama_jabatan_department");
    const infoAgama = getById("info_agama");
    const infoTanggalMasuk = getById("info_tanggal_masuk");
    const infoStatusKaryawan = getById("info_status");
    const infoStatusPernikahan = getById("info_status_pernikahan");
    const infoAlamat = getById("info_alamat");
    const infoKeterampilan = getById("info_keterampilan");
    const infoPengalamanKerja = getById("info_pengalaman_kerja");
    infoNamaKaryawan.forEach((el) => {
        el.textContent = nama;
    });
    infoNamaJabatanDepartment.textContent = `${namaDepartment}-${namaJabatan}`;
    infoAgama.textContent = agama;
    infoTanggalMasuk.textContent = formatTanggalIndonesia(tanggal_masuk);
    infoStatusKaryawan.textContent = status.toUpperCase();
    infoStatusPernikahan.textContent = status_pernikahan;
    infoAlamat.textContent = alamat;
    infoKeterampilan.textContent = keterampilan;
    infoPengalamanKerja.textContent = pengalaman_kerja;
}

async function displayEditKaryawan(data) {
    const {
        id,
        nama,
        email,
        no_telepon,
        jabatan,
        department,
        agama,
        alamat,
        pengalaman_kerja,
        keterampilan,
        pendidikan_terakhir,
        status,
        status_pernikahan,
        tanggal_masuk,
        jenis_kelamin,
        jabatan_id,
        department_id,
    } = data;

    const karyawanId = getById("karyawan_id");
    const updateNamaKaryawan = getById("update_nama");
    const updateEmailKaryawan = getById("update_email");
    const updateNoTelepon = getById("update_no_telepon");
    const updateJenisKelamin = getById("update_jenis_kelamin");
    const updateAgama = getById("update_agama");
    const updatePendidikanTerakhir = getById("update_pendidikan_terakhir");
    const updateStatusPernikahan = getById("update_status_pernikahan");
    const updateJabatan = getById("update_jabatan");
    const updateDepartment = getById("update_department");
    const updateTanggalMasuk = getById("update_tanggal_masuk");
    const updateStatus = getById("update_status");
    const updateAlamat = getById("update_alamat");
    const updatePengalamanKerja = getById("update_pengalaman_kerja");
    const updateKeterampilan = getById("update_keterampilan");

    karyawanId.value = id;
    updateNamaKaryawan.value = nama;
    updateEmailKaryawan.value = email;
    updateNoTelepon.value = no_telepon;
    updateJenisKelamin.value = jenis_kelamin;
    updateAgama.value = agama;
    updatePendidikanTerakhir.value = pendidikan_terakhir;
    updateStatusPernikahan.value = status_pernikahan;
    updateJabatan.value = jabatan_id;
    updateDepartment.value = department_id;
    updateTanggalMasuk.value = formatDateInputValue(tanggal_masuk);
    updateStatus.value = status;
    updateAlamat.textContent = alamat;
    updateKeterampilan.textContent = keterampilan;
    updatePengalamanKerja.textContent = pengalaman_kerja;
}

const btnShowKaryawan = queryAll("#btnShowKaryawan");
const btnEditKaryawan = queryAll("#btnEditKaryawan");
const btnDeleteKaryawan = queryAll("#btnDeleteKaryawan");
const btnClose = queryAll("#btnClose");

// fungsi addEventListener
btnShowKaryawan.forEach((btn) => {
    const karyawanId = btn.dataset.id;
    btn.addEventListener("click", async () => {
        const data = await fetchDataKaryawanById(karyawanId);
        await displayKaryawan(data);
    });
});

btnEditKaryawan.forEach((btn) => {
    const karyawanId = btn.dataset.id;
    const progressElement = document.querySelector(".custom-progress-bar");
    const formEdit = getById("form-update");

    btn.addEventListener("click", async () => {
        const data = await fetchDataKaryawanById(karyawanId);
        await displayEditKaryawan(data);
        progressElement.classList.add(`update-${karyawanId}`);
        formEdit.action = `/dashboard/admin/karyawan/${karyawanId}`;
    });
});

btnClose.forEach((btn) => {
    btn.addEventListener("click", () => {
        const isInvalidElement = queryAll(".is-invalid");
        const invalidFeedbackElement = queryAll(".invalid-feedback");

        if (isInvalidElement && invalidFeedbackElement) {
            isInvalidElement.forEach((el) => {
                el.classList.remove("is-invalid");
            });
            invalidFeedbackElement.forEach((el) => {
                el.remove();
            });
        }
    });
});

btnDeleteKaryawan.forEach((btn) => {
    const { id, nama } = btn.dataset;
    const formDeleteKaryawan = getById("formDeleteKaryawan");
    const deleteNamaKaryawan = getById("delete_nama_karyawan");
    btn.addEventListener("click", () => {
        formDeleteKaryawan.action = `/dashboard/admin/karyawan/${id}`;
        deleteNamaKaryawan.textContent = nama;
    });
});
