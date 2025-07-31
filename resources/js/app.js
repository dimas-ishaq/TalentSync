import "./bootstrap";
import "bootstrap-icons/font/bootstrap-icons.css";
import "./components/toast";

function toggleSidebar() {
    const sidebarContainer = document.querySelector(".sidebar-container");
    const mainContainer = document.querySelector(".main-content");
    const toggleButton = document.querySelector("#sidebarToggle");
    const navigationText = document.querySelectorAll(".nav-text");
    const sidebarToggleIcon = document.querySelector(".bi-arrow-left-circle");
    const subMenu = document.querySelectorAll(".sub-menu");
    const navLinks = document.querySelectorAll(".nav-link");

    if (sidebarContainer && toggleButton) {
        toggleButton.addEventListener("click", () => {
            const isCollapsed = sidebarContainer.classList.toggle("collapsed");

            if (isCollapsed) {
                navigationText.forEach((el) => {
                    el.classList.add("hide");
                });
                mainContainer.classList.add("collapsed");
                sidebarToggleIcon.classList.remove("bi-arrow-left-circle");
                sidebarToggleIcon.classList.add("bi-arrow-right-circle");
                subMenu.forEach((el) => {
                    el.classList.add("d-none");
                });
                navLinks.forEach((link) => {
                    link.addEventListener("click", (event) => {
                        if (sidebarContainer.classList.contains("collapsed")) {
                            toggleButton.click();
                        }
                    });
                });
            } else {
                navigationText.forEach((el) => {
                    el.classList.remove("hide");
                });
                subMenu.forEach((el) => {
                    el.classList.remove("d-none");
                });
                sidebarToggleIcon.classList.remove("bi-arrow-right-circle");
                sidebarToggleIcon.classList.add("bi-arrow-left-circle");
                mainContainer.classList.remove("collapsed");
            }
        });
    }
}

function toast() {
    const option = {
        animation: true,
        autohide: true,
        delay: 3000,
    };
    const toastElList = document.querySelectorAll(".toast");
    const toastList = [...toastElList].map((toastEl) => {
        const toast = new bootstrap.Toast(toastEl, option);
        toast.show();
        return toast;
    });
}
window.addEventListener("DOMContentLoaded", () => {
    toggleSidebar();
    toast();
});
