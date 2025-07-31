import { showToast } from "../../../components/toast";
import { getById } from "../../../components/helper";

const latitudeInput = getById("latitude_masuk");
const longitudeInput = getById("longitude_masuk");

const showAddress = getById("lokasi");
const inputAddress = getById("user_lokasi");

export async function checkIzinLokasi() {
    try {
        const result = await navigator.permissions.query({
            name: "geolocation",
        });
        if (result.state === "granted") {
            const lokasi = await getGeolocation();
            showAddress.textContent = `: ${lokasi}`;
            inputAddress.value = lokasi;
            return true;
        } else if (result.state === "prompt") {
            showToast("Izin lokasi: Belum diminta");
        } else if (result.state === "denied") {
            showToast("Mohon izinkan akses lokasi", "warning");
        }
    } catch (error) {
        console.error(error.message);
    }
}

async function getGeolocation() {
    return new Promise((resolve, reject) => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                async (position) => {
                    // Perhatikan 'async' di sini
                    const lat = position.coords.latitude;
                    const long = position.coords.longitude;
                    latitudeInput.value = lat;
                    longitudeInput.value = long;
                    try {
                        const address = await getAddressLocation(lat, long); // Tunggu hasil alamat
                        resolve(address); // Selesaikan Promise dengan alamat
                    } catch (err) {
                        reject("Gagal mendapatkan alamat dari Nominatim."); // Tolak Promise jika Nominatim error
                    }
                },
                (error) => {
                    console.error("Error getting geolocation: ", error);
                    let errorMessage =
                        "Gagal mendapatkan lokasi. Pastikan browser Anda mengizinkan akses lokasi.";
                    if (error.code === error.PERMISSION_DENIED) {
                        errorMessage =
                            "Akses lokasi ditolak. Mohon izinkan akses.";
                    } else if (error.code === error.POSITION_UNAVAILABLE) {
                        errorMessage = "Informasi lokasi tidak tersedia.";
                    } else if (error.code === error.TIMEOUT) {
                        errorMessage =
                            "Waktu tunggu untuk mendapatkan lokasi habis.";
                    }
                    window.alert(errorMessage);
                    reject(errorMessage); // Tolak Promise dengan pesan error
                },
                {
                    enableHighAccuracy: true,
                    timeout: 100000, // Tingkatkan timeout, kadang butuh waktu
                    maximumAge: 0,
                } // Opsi akurasi tinggi
            );
        } else {
            window.alert("Geolocation tidak didukung oleh browser ini.");
            reject("Geolocation tidak didukung.");
        }
    });
}

async function getAddressLocation(lat, long) {
    try {
        const response = await fetch(
            `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${long}&zoom=18&addressdetails=1`
        );

        // Cek jika respons HTTP tidak berhasil (misal: 404, 500, atau batasan rate)
        if (!response.ok) {
            const errorText = await response.text(); // Coba ambil teks error
            throw new Error(
                `HTTP error! Status: ${response.status} - ${errorText}`
            );
        }

        const data = await response.json(); // Menguraikan respons JSON

        if (data && data.display_name) {
            return data.display_name;
        } else {
            console.log("Tidak ditemukan lokasi untuk koordinat ini.");
            return null;
        }
    } catch (error) {
        console.error(error.message);
        return "Gagal memuat lokasi";
    }
}
