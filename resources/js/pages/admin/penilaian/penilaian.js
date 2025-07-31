import { getById, queryAll } from "../../../components/helper";
import { showToast } from "../../../components/toast";
// fetch data karyawan by id

async function fetchDataKaryawanById(id) {
    try {
        const response = await fetch(`/dashboard/admin/karyawan/${id}`);
        const responseJSON = await response.json();
        return responseJSON;
    } catch (error) {
        console.log(error.message);
        showToast(error.message, "warning");
    }
}

async function fetchDataPenilaianById(id) {
    try {
        const response = await fetch(`/dashboard/admin/penilaian/${id}`);
        const responseJSON = await response.json();
        return responseJSON;
    } catch (error) {
        console.log(error.message);
        showToast(error.message, "warning");
    }
}

async function displayDataKaryawan(data) {
    const { id, nama } = data;
    const { nama: namaJabatan } = data.jabatan;
    const { nama: namaDepartment } = data.department;

    const createPenilaianKaryawanId = getById("karyawan_id");
    const createPenilaianNamaKaryawan = getById("create_penilaian_nama");
    const createPenilaianJabatan = getById("create_penilaian_jabatan");
    const createPenilaianDepartment = getById("create_penilaian_department");

    createPenilaianKaryawanId.value = id;
    createPenilaianNamaKaryawan.value = nama;
    createPenilaianJabatan.value = namaJabatan;
    createPenilaianDepartment.value = namaDepartment;
}

async function displayDataPenilaian(data) {
    const {
        disiplin,
        periode,
        etika_kerja,
        inisiatif,
        kerja_sama,
        tanggung_jawab,
        target_kerja,
        catatan,
        status,
        rata_rata,
        karyawan,
    } = data;

    const { nama: namaKaryawan } = karyawan;
    const { nama: namaJabatan } = karyawan.jabatan;
    const { nama: namaDepartment } = karyawan.department;

    const editPenilaianNamaKaryawan = getById("edit_penilaian_nama");
    const editPenilaianJabatan = getById("edit_penilaian_jabatan");
    const editPenilaianDepartment = getById("edit_penilaian_department");
    const editPenilaianPeriode = getById("edit_penilaian_periode");
    const editPenilaianDisiplin = getById(
        `edit_penilaian_disiplin-${disiplin}`
    );
    const editPenilaianKerjasama = getById(
        `edit_penilaian_kerja_sama-${kerja_sama}`
    );
    const editPenilaianTanggungJawab = getById(
        `edit_penilaian_tanggung_jawab-${tanggung_jawab}`
    );
    const editPenilaianInisiatif = getById(
        `edit_penilaian_inisiatif-${inisiatif}`
    );
    const editPenilaianEtikaKerja = getById(
        `edit_penilaian_etika_kerja-${etika_kerja}`
    );
    const editPenilaianTargetKerja = getById(
        `edit_penilaian_target_kerja-${target_kerja}`
    );
    const editPenilaianCatatan = getById("edit_penilaian_catatan");
    const editPenilaianStatus = getById("edit_penilaian_status");

    editPenilaianNamaKaryawan.value = namaKaryawan;
    editPenilaianJabatan.value = namaJabatan;
    editPenilaianDepartment.value = namaDepartment;
    editPenilaianPeriode.value = periode;
    editPenilaianDisiplin.checked = true;
    editPenilaianKerjasama.checked = true;
    editPenilaianTanggungJawab.checked = true;
    editPenilaianInisiatif.checked = true;
    editPenilaianEtikaKerja.checked = true;
    editPenilaianTargetKerja.checked = true;
    editPenilaianCatatan.textContent = catatan;
    editPenilaianStatus.value = status;

}

const btnProsesPenilaian = queryAll("#btnProsesPenilaian");
btnProsesPenilaian.forEach((btn) => {
    const karyawanId = btn.dataset.id;
    btn.addEventListener("click", async () => {
        const data = await fetchDataKaryawanById(karyawanId);
        await displayDataKaryawan(data);
    });
});

const btnEditPenilaian = queryAll("#btnEditPenilaian");
btnEditPenilaian.forEach((btn) => {
    const penilaianId = btn.dataset.id;
    const formEditPenilaian = getById("formEditPenilaian")
    btn.addEventListener("click", async () => {
        const data = await fetchDataPenilaianById(penilaianId);
        await displayDataPenilaian(data);
        formEditPenilaian.action = `/dashboard/admin/penilaian/${penilaianId}`
    });
});

