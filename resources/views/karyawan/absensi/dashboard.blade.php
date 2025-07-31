@extends('layouts.karyawan.app')

@section('content')
    <div class="container-fluid my-4">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.dashboard') }}
                                class=" text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item active " aria-current="page">Absensi</li>
                    </ol>
                </nav>
            </div>
            <div class="col d-flex justify-content-end">
                <h5 class="fs-5">Riwayat Absensi</h5>
            </div>
        </div>
        <div class="card shadow-lg">
            <div class="card-header">
                <div class="row my-3">
                    <div class="col d-flex justify-content-end">
                        <button type="button" class="btn btn-success btn-sm" id="btnStartCheckIn"><i
                                class="bi bi-calendar-check"></i>
                            CheckIn</button>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Hari</th>
                                <th>Jam Masuk</th>
                                <th>Jam Pulang</th>
                                <th>Status</th>
                                <th>Lokasi</th>
                                <th>Durasi Kerja</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($absensis as $absensi)
                                <tr>
                                    <td>{{ $absensi->tanggal }}</td>
                                    <td>{{ convertHari($absensi->tanggal) }}</td>
                                    <td>{{ $absensi->jam_masuk }}</td>
                                    <td>{{ $absensi->jam_pulang ? $absensi->jam_pulang : '-' }}</td>
                                    <td>{{ ucfirst($absensi->status) }}</td>
                                    <td>{{ $absensi->alamat }}</td>
                                    <td>{{ durasiKerja($absensi->jam_masuk, $absensi->jam_keluar) }}</td>
                                    <td>{{ $absensi->jam_pulang ? 'Hadir' : 'Belum Checkout' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col">

                            {{ $absensis->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('karyawan.absensi.checkIn')

@push('script')
    @vite('resources/js/pages/karyawan/absensi/absensi.js')
@endpush

{{-- @if (is_null($checkIn))
    @push('script')
        <script>
            const video = document.getElementById('video');
            const takePhotoBtn = document.getElementById('takePhoto');
            const photoCanvas = document.getElementById('photoCanvas');
            const photoPreview = document.getElementById('photoPreview');
            const checkinForm = document.getElementById('checkinForm');
            const photoDataInput = document.getElementById('photoData');
            const latitudeInput = document.getElementById('latitude_masuk');
            const longitudeInput = document.getElementById('longitude_masuk');
            const resultsDiv = document.getElementById('results');
            const retakePhotoBtn = document.getElementById('retakePhoto');
            const showTime = document.getElementById('jam');
            const showDate = document.getElementById('tanggal');
            const showAddress = document.getElementById('lokasi');
            const inputAddress = document.getElementById('alamat');

            const inputUserTimeZone = document.getElementById('user_timezone');
            const inpuCheckInTime = document.getElementById('check_in_time_client');

            let currentStream;
            const date = new Date();
            const tanggal = date.toLocaleDateString();
            const userTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
            const checkInISOTime = date.toISOString();

            inputUserTimeZone.value = userTimeZone;
            inpuCheckInTime.value = checkInISOTime;



            // Fungsi startCamera sekarang mengembalikan stream
            async function startCamera(videoElement) { // Tidak perlu parameter 'stream' lagi
                const constraints = {
                    video: {
                        width: {
                            ideal: 480
                        },
                        height: {
                            ideal: 240
                        },
                        facingMode: 'environment'
                    },
                    audio: false
                };
                try {
                    const stream = await navigator.mediaDevices.getUserMedia(constraints);
                    videoElement.srcObject = stream;
                    return stream; // Mengembalikan objek stream
                } catch (error) { // Gunakan 'error' sesuai nama variabel di catch
                    if (error.name === "OverconstrainedError") {
                        console.error(
                            `The resolution ${constraints.video.width.exact}x${constraints.video.height.exact} px is not supported by your device.`,
                        );
                    } else if (error.name === "NotAllowedError") {
                        console.error(
                            "You need to grant this page permission to access your camera and microphone.",
                        );
                    } else {
                        console.error(`getUserMedia error: ${error.name}`, error);
                    }
                    return null; // Kembalikan null jika ada error
                }
            }

            // Fungsi takePhoto sekarang menggunakan stream global
            function takePhoto(takePhotoBtn, videoElement, photoCanvasElement, checkinFormElement, photoDataInputElement,
                retakePhotoBtnElement) { // Hapus parameter 'stream' dari sini
                takePhotoBtn.addEventListener('click', () => {
                    if (!currentStream) { // Cek stream global
                        window.alert('Mohon izinkan akses kamera.');
                        return;
                    }

                    const context = photoCanvasElement.getContext('2d');
                    photoCanvasElement.width = videoElement.videoWidth;
                    photoCanvasElement.height = videoElement.videoHeight;
                    context.drawImage(videoElement, 0, 0, photoCanvasElement.width, photoCanvasElement.height);

                    // Stop kamera setelah mengambil foto
                    currentStream.getTracks().forEach(track => track.stop());
                    videoElement.srcObject = null;
                    videoElement.style.display = 'none';

                    // Tampilkan preview foto
                    photoPreview.src = photoCanvasElement.toDataURL('image/png');
                    photoPreview.style.display = 'block';

                    // Sembunyikan tombol "Ambil Foto" dan tampilkan form submit
                    takePhotoBtn.style.display = 'none';
                    checkinFormElement.style.display = 'block';

                    // Set data foto ke input tersembunyi
                    photoDataInputElement.value = photoCanvasElement.toDataURL('image/png');
                    retakePhotoBtnElement.removeAttribute('hidden');
                });
            }

            function retakePhoto(takePhotoBtnElement, videoElement, photoCanvasElement, photoPreviewElement, checkinFormElement,
                photoDataInputElement, retakePhotoBtnElement) {
                retakePhotoBtnElement.addEventListener('click',
                    async () => { // Tambahkan 'async' di sini karena kita memanggil startCamera
                        // Sembunyikan/tampilkan elemen sesuai state awal
                        photoPreviewElement.style.display = 'none';
                        photoCanvasElement.style.display =
                            'none'; // Pastikan canvas juga tersembunyi jika sebelumnya ditampilkan
                        checkinFormElement.style.display = 'none'; // Sembunyikan form

                        videoElement.style.display = 'block'; // Tampilkan kembali video feed
                        takePhotoBtnElement.style.display = 'block'; // Tampilkan tombol ambil foto
                        retakePhotoBtnElement.setAttribute('hidden', ''); // Sembunyikan tombol ambil ulang

                        // Penting: Panggil startCamera lagi dengan elemen video yang benar
                        currentStream = await startCamera(videoElement); // <-- PERBAIKAN UTAMA DI SINI
                        // currentStream akan diperbarui di dalam startCamera
                    });
            }

            async function getGeolocation() {
                return new Promise((resolve, reject) => {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(
                            async (position) => { // Perhatikan 'async' di sini
                                    const lat = position.coords.latitude;
                                    const long = position.coords.longitude;
                                    latitudeInput.value = lat;
                                    longitudeInput.value = long;

                                    try {
                                        const address = await getAddressLocation(lat,
                                            long); // Tunggu hasil alamat
                                        resolve(address); // Selesaikan Promise dengan alamat
                                    } catch (err) {
                                        reject(
                                            "Gagal mendapatkan alamat dari Nominatim."
                                        ); // Tolak Promise jika Nominatim error
                                    }
                                },
                                (error) => {
                                    console.error("Error getting geolocation: ", error);
                                    let errorMessage =
                                        "Gagal mendapatkan lokasi. Pastikan browser Anda mengizinkan akses lokasi.";
                                    if (error.code === error.PERMISSION_DENIED) {
                                        errorMessage = "Akses lokasi ditolak. Mohon izinkan akses.";
                                    } else if (error.code === error.POSITION_UNAVAILABLE) {
                                        errorMessage = "Informasi lokasi tidak tersedia.";
                                    } else if (error.code === error.TIMEOUT) {
                                        errorMessage = "Waktu tunggu untuk mendapatkan lokasi habis.";
                                    }
                                    window.alert(errorMessage);
                                    reject(errorMessage); // Tolak Promise dengan pesan error
                                }, {
                                    enableHighAccuracy: true,
                                    timeout: 10000, // Tingkatkan timeout, kadang butuh waktu
                                    maximumAge: 0
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
                        `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${long}&zoom=18&addressdetails=1`, {
                            method: 'GET',
                        });

                    // Cek jika respons HTTP tidak berhasil (misal: 404, 500, atau batasan rate)
                    if (!response.ok) {
                        const errorText = await response.text(); // Coba ambil teks error
                        throw new Error(`HTTP error! Status: ${response.status} - ${errorText}`);
                    }

                    const data = await response.json(); // Menguraikan respons JSON

                    if (data && data.display_name) {
                        return data.display_name
                    } else {
                        console.log("Tidak ditemukan lokasi untuk koordinat ini.");
                        return null;
                    }
                } catch (error) {
                    console.error("Gagal mendapatkan lokasi:", error);
                    return null;
                }
            }

            function updateClock() {
                const now = new Date(); // Membuat objek Date baru setiap detik untuk waktu terkini

                // Opsi 1: Format yang sederhana (tergantung locale browser)
                const timeString = now.toLocaleTimeString(); // Contoh: "10:30:45 AM" atau "10:30:45"

                // Perbarui teks di elemen HTML
                showTime.textContent = timeString;
            }

            // Event listener DOMContentLoaded
            document.addEventListener('DOMContentLoaded', async () => { // Tambahkan 'async' di sini
                // Panggil startCamera dan simpan stream yang dikembalikan ke variabel global
                currentStream = await startCamera(video);
                console.log('Global stream after startCamera:', currentStream); // Debugging

                // Panggil takePhoto dengan variabel global yang sudah ada
                takePhoto(takePhotoBtn, video, photoCanvas, checkinForm, photoDataInput, retakePhotoBtn);
                retakePhoto(takePhotoBtn, video, photoCanvas, photoPreview, checkinForm, photoDataInput,
                    retakePhotoBtn);
                updateClock();
                setInterval(updateClock, 1000);
                showDate.textContent = tanggal;
                try {
                    const address = await getGeolocation(); // Tunggu hasil dari getGeolocation
                    showAddress.textContent = address; // Tampilkan alamat
                    inputAddress.value = address;
                } catch (error) {
                    console.error("Gagal menampilkan alamat:", error);
                    showAddress.textContent = "Gagal memuat alamat."; // Pesan fallback
                }
            });
        </script>
    @endpush
@else
    @push('script')
        <script>
            const startCheckOutBtn = document.getElementById('startCheckOut');
            const takePhotoBtn = document.getElementById('takePhoto');
            const video = document.getElementById('video');
            const photoPreview = document.getElementById('photoPreview');
            const showAddress = document.getElementById('lokasi');
            const latitudeInput = document.getElementById('latitude_keluar');
            const longitudeInput = document.getElementById('longitude_keluar');
            const photoDataInput = document.getElementById('photoData');
            const retakePhotoBtn = document.getElementById('retakePhoto');
            const date = new Date();
            const showDate = document.getElementById('tanggal');
            showDate.textContent = date.toLocaleDateString();
            const photoCanvas = document.getElementById('photoCanvas');

            const inputUserTimeZone = document.getElementById('user_timezone');
            const inpuCheckOutTime = document.getElementById('check_out_time_client');
            const userTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
            const checkOutISOTime = date.toISOString();

            let currentStream;
            inputUserTimeZone.value = userTimeZone;
            inpuCheckOutTime.value = checkOutISOTime;

            async function startCamera(videoElement) {
                const constraints = {
                    video: {
                        width: {
                            ideal: 480
                        },
                        height: {
                            ideal: 240
                        },
                        facingMode: 'environment'
                    },
                    audio: false
                };
                try {
                    const stream = await navigator.mediaDevices.getUserMedia(constraints);
                    videoElement.srcObject = stream;
                    return stream; // Mengembalikan objek stream
                } catch (error) { // Gunakan 'error' sesuai nama variabel di catch
                    if (error.name === "OverconstrainedError") {
                        console.error(
                            `The resolution ${constraints.video.width.exact}x${constraints.video.height.exact} px is not supported by your device.`,
                        );
                    } else if (error.name === "NotAllowedError") {
                        console.error(
                            "You need to grant this page permission to access your camera and microphone.",
                        );
                    } else {
                        console.error(`getUserMedia error: ${error.name}`, error);
                    }
                    return null; // Kembalikan null jika ada error
                }
            }

            function updateClock() {
                const showTime = document.getElementById('jam');
                const now = new Date(); // Membuat objek Date baru setiap detik untuk waktu terkini

                // Opsi 1: Format yang sederhana (tergantung locale browser)
                const timeString = now.toLocaleTimeString(); // Contoh: "10:30:45 AM" atau "10:30:45"

                // Perbarui teks di elemen HTML
                showTime.textContent = timeString;
            }

            async function getGeolocation() {
                return new Promise((resolve, reject) => {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(
                            async (position) => { // Perhatikan 'async' di sini
                                    const lat = position.coords.latitude;
                                    const long = position.coords.longitude;
                                    latitudeInput.value = lat;
                                    longitudeInput.value = long;

                                    try {
                                        const address = await getAddressLocation(lat,
                                            long); // Tunggu hasil alamat
                                        resolve(address); // Selesaikan Promise dengan alamat
                                    } catch (err) {
                                        reject(
                                            "Gagal mendapatkan alamat dari Nominatim."
                                        ); // Tolak Promise jika Nominatim error
                                    }
                                },
                                (error) => {
                                    console.error("Error getting geolocation: ", error);
                                    let errorMessage =
                                        "Gagal mendapatkan lokasi. Pastikan browser Anda mengizinkan akses lokasi.";
                                    if (error.code === error.PERMISSION_DENIED) {
                                        errorMessage = "Akses lokasi ditolak. Mohon izinkan akses.";
                                    } else if (error.code === error.POSITION_UNAVAILABLE) {
                                        errorMessage = "Informasi lokasi tidak tersedia.";
                                    } else if (error.code === error.TIMEOUT) {
                                        errorMessage = "Waktu tunggu untuk mendapatkan lokasi habis.";
                                    }
                                    window.alert(errorMessage);
                                    reject(errorMessage); // Tolak Promise dengan pesan error
                                }, {
                                    enableHighAccuracy: true,
                                    timeout: 10000, // Tingkatkan timeout, kadang butuh waktu
                                    maximumAge: 0
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
                        `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${long}&zoom=18&addressdetails=1`, {
                            method: 'GET',
                        });

                    // Cek jika respons HTTP tidak berhasil (misal: 404, 500, atau batasan rate)
                    if (!response.ok) {
                        const errorText = await response.text(); // Coba ambil teks error
                        throw new Error(`HTTP error! Status: ${response.status} - ${errorText}`);
                    }

                    const data = await response.json(); // Menguraikan respons JSON

                    if (data && data.display_name) {
                        return data.display_name
                    } else {
                        console.log("Tidak ditemukan lokasi untuk koordinat ini.");
                        return null;
                    }
                } catch (error) {
                    console.error("Gagal mendapatkan lokasi:", error);
                    return null;
                }
            }

            function confirmCheckOut() {
                takePhotoBtn.addEventListener('click', () => {
                    if (!currentStream) { // Cek stream global
                        window.alert('Mohon izinkan akses kamera.');
                        return;
                    }

                    const context = photoCanvas.getContext('2d');
                    photoCanvas.width = video.videoWidth;
                    photoCanvas.height = video.videoHeight;
                    context.drawImage(video, 0, 0, photoCanvas.width, photoCanvas.height);

                    // Stop kamera setelah mengambil foto
                    currentStream.getTracks().forEach(track => track.stop());
                    video.srcObject = null;
                    video.style.display = 'none';

                    // Tampilkan preview foto
                    photoPreview.src = photoCanvas.toDataURL('image/png');
                    photoPreview.style.display = 'block';

                    // Sembunyikan tombol "Ambil Foto" dan tampilkan form submit
                    takePhotoBtn.style.display = 'none';
                    checkinForm.style.display = 'block';

                    // Set data foto ke input tersembunyi
                    photoDataInput.value = photoCanvas.toDataURL('image/png');
                    retakePhotoBtn.removeAttribute('hidden');
                });

            }

            function retakePhoto() {
                retakePhotoBtn.addEventListener('click',
                    async () => { // Tambahkan 'async' di sini karena kita memanggil startCamera
                        // Sembunyikan/tampilkan elemen sesuai state awal
                        photoPreview.style.display = 'none';
                        photoCanvas.style.display =
                            'none'; // Pastikan canvas juga tersembunyi jika sebelumnya ditampilkan
                        checkinForm.style.display = 'none'; // Sembunyikan form

                        video.style.display = 'block'; // Tampilkan kembali video feed
                        takePhotoBtn.style.display = 'block'; // Tampilkan tombol ambil foto
                        retakePhotoBtn.setAttribute('hidden', ''); // Sembunyikan tombol ambil ulang

                        // Penting: Panggil startCamera lagi dengan elemen video yang benar
                        currentStream = await startCamera(video); // <-- PERBAIKAN UTAMA DI SINI
                        // currentStream akan diperbarui di dalam startCamera
                    });
            }

            function startCheckOut(startCheckOutBtnElement) {
                startCheckOutBtnElement.addEventListener('click', async () => {
                    currentStream = await startCamera(video);
                    photoPreview.style.display = 'none'
                    video.style.display = 'block';
                    startCheckOutBtn.style.display = 'none';
                    takePhotoBtn.style.display = 'block';
                    confirmCheckOut();

                })
            }
            document.addEventListener('DOMContentLoaded', async () => {
                startCheckOut(startCheckOutBtn);
                updateClock();
                setInterval(updateClock, 1000);
                retakePhoto();
                try {
                    const address = await getGeolocation(); // Tunggu hasil dari getGeolocation
                    showAddress.textContent = address; // Tampilkan alamat
                } catch (error) {
                    console.error("Gagal menampilkan alamat:", error);
                    showAddress.textContent = "Gagal memuat alamat."; // Pesan fallback
                }
            })
        </script>
    @endpush
@endif --}}
