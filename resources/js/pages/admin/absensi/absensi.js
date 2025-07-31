import { getById, queryAll } from "../../../components/helper";

const btnDetail = queryAll("#btnDetailAbsensi");
const btnEdit = queryAll("#btnEditAbsensi");

function formatWaktuIndonesia(isoString) {
    const date = new Date(isoString);

    const options = {
        timeZone: "Asia/Jakarta",
        year: "numeric",
        month: "long",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
        hour12: false,
    };

    const formatted = new Intl.DateTimeFormat("id-ID", options).format(date);
    return `${formatted} WIB`;
}

// ambil data absensi
async function fetchAbsensi(id) {
    const response = await fetch(`/dashboard/admin/absensi/${id}`);
    const responseJSON = await response.json();
    return responseJSON;
}

async function displayAbsensi(data) {
    const {
        id,
        tanggal,
        jam_masuk,
        jam_keluar,
        karyawan,
        status,
        lokasi,
        latitude_masuk,
        longitude_masuk,
        latitude_keluar,
        longitude_keluar,
        updated_at,
        catatan,
    } = data;

    const { nama: namaKaryawan } = karyawan;

    const absensiTanggal = getById("absensi_tanggal");
    const absensiStatus = getById("absensi_status");
    const absensiJamMasuk = getById("absensi_jam_masuk");
    const absensiLatitudeMasuk = getById("absensi_latitude_masuk");
    const absensiLongitudeMasuk = getById("absensi_longitude_masuk");
    const absensiAlamat = queryAll("#absensi_alamat");
    const absensiJamKeluar = getById("absensi_jam_keluar");
    const absensiLatitudeKeluar = getById("absensi_latitude_keluar");
    const absensiLongitudeKeluar = getById("absensi_longitude_keluar");
    const absensiCatatan = getById("absensi_catatan");
    const absensiUpdatedAt = getById("absensi_updated_at");

    absensiTanggal.innerHTML = `${tanggal} - <strong>${namaKaryawan}</strong>`;
    absensiStatus.textContent = status;
    if (status != "hadir") {
        absensiStatus.classList.add("bg-warning");
    } else {
        absensiStatus.classList.add("bg-success");
    }
    absensiLatitudeMasuk.textContent = latitude_masuk;
    absensiLongitudeMasuk.textContent = longitude_masuk;
    absensiLatitudeKeluar.textContent = latitude_keluar;
    absensiLongitudeKeluar.textContent = longitude_keluar;
    absensiAlamat.forEach((el) => {
        el.textContent = lokasi;
    });
    absensiCatatan.textContent = catatan;
    absensiUpdatedAt.textContent = formatWaktuIndonesia(updated_at);
}

async function displayEditAbsensi(data) {
    const { status, catatan, karyawan } = data;

    const { nama: namaKaryawan } = karyawan;

    const editAbsensiNamaKaryawan = getById("edit_absensi_nama_karyawan");
    const editAbsensiStatus = getById("edit_absensi_status");
    const editAbsensiCatatan = getById("edit_absensi_catatan");

    editAbsensiNamaKaryawan.textContent = namaKaryawan;
    editAbsensiCatatan.textContent = catatan;
    editAbsensiStatus.value = status;
}

btnDetail.forEach((btn) => {
    const absensiId = btn.dataset.id;
    btn.addEventListener("click", async () => {
        const data = await fetchAbsensi(absensiId);
        await displayAbsensi(data);
    });
});

btnEdit.forEach((btn) => {
    const absensiId = btn.dataset.id;
    const formEdit = getById("form_edit_absensi");
    btn.addEventListener("click", async () => {
        const data = await fetchAbsensi(absensiId);
        await displayEditAbsensi(data);
        formEdit.action = `/dashboard/admin/absensi/${absensiId}`;
    });
});
