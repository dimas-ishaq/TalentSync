import { getById, updateClock, getDate } from "../../../components/helper";
import { startCamera, checkIzinKamera, stopCamera } from "./camera";
import { checkIzinLokasi } from "./lokasi";

let stream;
let isTakePhotoBound = false;

const video = getById("video");
const takePhotoBtn = getById("btnTakePhoto");
const photoCanvas = getById("photoCanvas");
const photoPreview = getById("photoPreview");
const checkinForm = getById("checkinForm");
const photoDataInput = getById("photoData");
const retakePhotoBtn = getById("btnRetakePhoto");

export async function startCheckIn() {
    const izinKamera = await checkIzinKamera();
    const izinLokasi = await checkIzinLokasi();

    if (izinKamera && izinLokasi) {
        const checkInModal = getById("startCheckIn");
        const modal = new bootstrap.Modal(checkInModal);
        modal.show();

        stream = await startCamera(video);

        setupTakePhoto();
        setupRetakePhoto();
    }
}

export function stopCheckIn() {
    stopCamera(stream);
    stream = null;

    takePhotoBtn.classList.remove("d-none");
    photoPreview.src = "";
    video.classList.remove("d-none");
    checkinForm.classList.add("d-none");
    retakePhotoBtn.classList.add("d-none");
}

function setupTakePhoto() {
    if (isTakePhotoBound) return; // Hindari event listener ganda

    takePhotoBtn.addEventListener("click", () => {
        const context = photoCanvas.getContext("2d");

        photoCanvas.width = video.videoWidth;
        photoCanvas.height = video.videoHeight;
        context.drawImage(video, 0, 0, photoCanvas.width, photoCanvas.height);

        // Stop kamera
        stream.getTracks().forEach((track) => track.stop());
        video.srcObject = null;
        video.classList.add("d-none");

        // Preview foto
        const photoData = photoCanvas.toDataURL("image/png");
        photoPreview.src = photoData;
        photoDataInput.value = photoData;

        photoPreview.classList.remove("d-none");
        takePhotoBtn.classList.add("d-none");
        checkinForm.classList.remove("d-none");
        retakePhotoBtn.classList.remove("d-none");
    });

    isTakePhotoBound = true;
}

function setupRetakePhoto() {
    retakePhotoBtn.addEventListener("click", async () => {
        // Reset tampilan
        photoPreview.classList.add("d-none");
        photoCanvas.classList.add("d-none");
        checkinForm.classList.add("d-none");

        video.classList.remove("d-none");
        takePhotoBtn.classList.remove("d-none");
        retakePhotoBtn.classList.add("d-none");

        // Mulai ulang kamera
        stream = await startCamera(video);
    });
}

const setJam = getById("jam");
const setTanggal = getById("tanggal");

const date = new Date();
const inputUserTimeZone = getById("user_timezone");
const inpuCheckInTime = getById("check_in_time_client");

const userTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
const checkInISOTime = date.toISOString();

inputUserTimeZone.value = userTimeZone;
inpuCheckInTime.value = checkInISOTime;

document.addEventListener("DOMContentLoaded", () => {
    updateClock(setJam);
    setInterval(() => updateClock(setJam), 1000);
    getDate(setTanggal);
});
