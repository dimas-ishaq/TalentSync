export function queryAll(queryAll) {
    return document.querySelectorAll(queryAll);
}

export function getById(id) {
    return document.getElementById(id);
}

export function formatDateInputValue(date) {
    const d = new Date(date);
    const year = d.getFullYear();
    const month = String(d.getMonth() + 1).padStart(2, "0"); // Bulan dimulai dari 0
    const day = String(d.getDate()).padStart(2, "0"); // Tanggal dalam bulan

    return `${year}-${month}-${day}`;
}

export function formatTanggalIndonesia(tanggal) {
    const newtanggal = new Date(tanggal);

    const tanggalIndonesia = new Intl.DateTimeFormat("id-ID", {
        day: "numeric",
        month: "long",
        year: "numeric",
    }).format(newtanggal);
    return tanggalIndonesia;
}

export function updateClock(el) {
    const now = new Date(); // Membuat objek Date baru setiap detik untuk waktu terkini
    const timeString = now.toLocaleTimeString(); // Contoh: "10:30:45 AM" atau "10:30:45
    el.textContent = `: ${timeString}`;
}

export function getDate(el) {
    const date = new Date();
    const tanggalHariIni = date.toLocaleDateString();
    el.textContent = `: ${tanggalHariIni}`;
}

export function displayError(inputElement, message) {
    const parentElement = inputElement.parentElement;
    let errorElement = parentElement.querySelector(".invalid-feedback");
    if (!errorElement) {
        errorElement = document.createElement("div");
        errorElement.classList.add("invalid-feedback");
        errorElement.textContent = message;
        inputElement.classList.add("is-invalid");
        parentElement.appendChild(errorElement);
    }
    errorElement.textContent = message;
}

export function removeDisplayError(inputElement) {
    const parentElement = inputElement.parentElement;
    const errorElement = parentElement.querySelector(".invalid-feedback");
    if (errorElement) {
        inputElement.classList.remove("is-invalid");
        errorElement.remove();
    }
}

export function isRequired(el) {
    return el.value.trim() !== "";
}

export function minNumber(el, reqValue) {
    return Number(el.value) >= reqValue;
}

export function validateForm(rules) {
    let isValid = true;

    rules.forEach((field) => {
        const el = getById(field.id);

        field.validations.forEach((rule) => {
            switch (rule.type) {
                case "required":
                    if (!isRequired(el)) {
                        displayError(el, rule.message);
                        isValid = false;
                        return isValid;
                    }
                    return removeDisplayError(el);
                case "min":
                    if (!minNumber(el, rule.value)) {
                        displayError(el, rule.message);
                        isValid = false;
                        return isValid;
                    }
                    return removeDisplayError(el);
                default:
                    break;
            }
        });
    });

    return isValid;
}
