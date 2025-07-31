export function showToast(message, type = "info") {
    const toastTypes = {
        info: "text-bg-info",
        success: "text-bg-success",
        warning: "text-bg-warning",
        danger: "text-bg-danger",
        primary: "text-bg-primary",
        secondary: "text-bg-secondary",
        dark: "text-bg-dark",
        light: "text-bg-light",
    };

    const bgToast = toastTypes[type] || toastTypes.info;

    const toastContainer =
        document.querySelector(".toast-container") || createToastContainer();

    const toastEl = document.createElement("div");
    toastEl.className = `toast ${bgToast}`;
    toastEl.setAttribute("role", "alert");
    toastEl.setAttribute("aria-live", "assertive");
    toastEl.setAttribute("aria-atomic", "true");

    toastEl.innerHTML = `
        <div class="toast-header">
            <strong class="me-auto text-capitalize">${type}</strong>
            <small class="text-muted">Baru saja</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">${message}</div>
    `;
    
    toastContainer.appendChild(toastEl);

    const toast = new bootstrap.Toast(toastEl);
    toast.show();

    // Hapus elemen dari DOM setelah toast disembunyikan
    toastEl.addEventListener("hidden.bs.toast", () => {
        toastEl.remove();
    });
}

function createToastContainer() {
    const container = document.createElement("div");
    container.className = "toast-container position-fixed top-0 end-0 p-3";
    container.style.zIndex = 1080; // Pastikan muncul di atas elemen lain
    document.body.appendChild(container);
    return container;
}
