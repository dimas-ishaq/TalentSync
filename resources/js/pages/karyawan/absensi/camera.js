import { showToast } from "../../../components/toast";

export async function startCamera(videoElement) {
    // Tidak perlu parameter 'stream' lagi
    const constraints = {
        video: {
            width: {
                ideal: 480,
            },
            height: {
                ideal: 280,
            },
            facingMode: "environment",
        },
        audio: false,
    };
    try {
        const stream = await navigator.mediaDevices.getUserMedia(constraints);
        videoElement.srcObject = stream;
        return stream; // Mengembalikan objek stream
    } catch (error) {
        // Gunakan 'error' sesuai nama variabel di catch
        if (error.name === "OverconstrainedError") {
            console.error(
                `The resolution ${constraints.video.width.exact}x${constraints.video.height.exact} px is not supported by your device.`
            );
        } else if (error.name === "NotAllowedError") {
            console.error(
                "You need to grant this page permission to access your camera and microphone."
            );
        } else {
            console.error(`getUserMedia error: ${error.name}`, error);
        }
        return null; // Kembalikan null jika ada error
    }
}

export function stopCamera(currentStream) {
    if (currentStream) {
        const tracks = currentStream.getTracks();

        // Hentikan setiap track
        tracks.forEach((track) => {
            track.stop();
        });
    }
}

export async function checkIzinKamera() {
    try {
        const result = await navigator.permissions.query({
            name: "camera",
        });
        if (result.state === "granted") {
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
