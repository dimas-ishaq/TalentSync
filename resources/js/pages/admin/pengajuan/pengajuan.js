import { queryAll, getById } from "../../../components/helper";

const approveButtons = queryAll(".btn-approve");
const rejectButtons = queryAll(".btn-reject");

const approveNamaKaryawan = getById("approve_nama_karyawan");
const formApprovePengajuan = getById("formApprovePengajuan");

approveButtons.forEach((btn) => {
    const { id, nama } = btn.dataset;
    btn.addEventListener("click", () => {
        approveNamaKaryawan.textContent = nama;
        formApprovePengajuan.action = `/dashboard/admin/pengajuan/approve/${id}`;
    });
});

const rejectNamaKaryawan = getById("reject_nama_karyawan");
const formRejectPengajuan = getById("formRejectPengajuan");
rejectButtons.forEach((btn) => {
    const { id, nama } = btn.dataset;
    btn.addEventListener("click", () => {
        rejectNamaKaryawan.textContent = nama;
        formRejectPengajuan.action = `/dashboard/admin/pengajuan/reject/${id}`;
    });
});
