import './bootstrap';
import 'bootstrap';
import $ from 'jquery';
import * as bootstrap from 'bootstrap';
import 'bootstrap-table';
import Choices from "choices.js";
import "choices.js/public/assets/styles/choices.min.css";




window.Choices = Choices;
window.bootstrap = bootstrap;
window.jQuery = $;
window.$ = $;



async function validateForm(event, url) {
    event.preventDefault();

    const btn = event.currentTarget ?? event.target;
    
    setButtonLoading(btn, true);
    const form = event.target.closest("form");
    const isValid = form.checkValidity();
    form.classList.add('was-validated');
    if (isValid) {
        let data = await getFormData(form.elements);
        let response = await sendRequest(data, url);
        if (response) {
            setButtonLoading(btn, false);
            return response;
        } else {
            setButtonLoading(btn, false);
            return false;
        }
    } else {
        setButtonLoading(btn, false);
        return false;
    }
}


async function getFormData(elements) {
    let data = new FormData();
    Array.from(elements).forEach(element => {
        if (element.hasAttribute("name")) {
            if (element.type === "file") {
                if (element.multiple) {
                    Array.from(element.files).forEach(file => {
                        data.append(element.name, file); // use name[] for array-like keys
                    });
                } else {
                    if (element.files[0]) {
                        data.append(element.name, element.files[0]);
                    }
                }
            } else {
                data.append(element.name, element.value);
            }
        }
    });
    return data;
}


async function sendRequest(formData, url) {
    var requestOptions = {
        method: 'POST',
        body: formData
    };
    return await fetch(`${url}`, requestOptions)
        .then(response => response.text())
        .then(result => {
            let res = JSON.parse(result);
            if (res.code == 200) {
                return res.data;
            } else {
                showAlert("Intenta de nuevo", res.message);
                return false;
            }
        })
        .catch(error => {
            showAlert("Intenta de nuevo", "Error en el servidor. Inténtalo más tarde");
            return false;
        });
}

async function getRequest(url) {
    var requestOptions = {
        method: 'GET',
    };
    return await fetch(`${url}`, requestOptions)
        .then(response => response.text())
        .then(result => {
            let res = JSON.parse(result);
            if (res.code == 200) {
                return res.data;
            } else {
                showAlert("Intenta de nuevo", res.message);
                return false;
            }
        })
        .catch(error => {
            showAlert("Intenta de nuevo", "Error en el servidor. Inténtalo más tarde");
            return false;
        });
}

async function showAlert(title, message, subtitle = "", icon = "fa-solid fa-triangle-exclamation") {
    let alertToast = document.getElementById("liveAlert");
    alertToast.querySelector("#alertTitle").textContent = title;
    alertToast.querySelector("#alertMessage").textContent = message;
    alertToast.querySelector("#alertSubtitle").textContent = subtitle;
    alertToast.querySelector("#alertIcon").className = icon;
    const alert = bootstrap.Toast.getOrCreateInstance(alertToast)
    alert.show();
}
function showNotification(title, message, subtitle = "", icon = "fa-solid fa-copy") {
    return new Promise((resolve) => {
        let alertToast = document.getElementById("liveNotification");

        alertToast.querySelector("#alertTitle").textContent = title;
        alertToast.querySelector("#alertMessage").textContent = message;
        alertToast.querySelector("#alertSubtitle").textContent = subtitle;
        alertToast.querySelector("#alertIcon").className = icon;
        const alert = bootstrap.Toast.getOrCreateInstance(alertToast);
        alertToast.removeEventListener("hidden.bs.toast", alertToast._resolveListener);
        alertToast._resolveListener = () => {
            resolve();
        };
        alertToast.addEventListener("hidden.bs.toast", alertToast._resolveListener);
        alert.show();
    });
}


async function copyElement(element, type = "text"){
    console.log(element, type);
    if(type == "url"){
        let app_url = document.getElementById("app_url").value;
        navigator.clipboard.writeText(`${app_url}${element}`);
        showNotification("¡Enlace copiado!", "Se ha copiado el enlace");
    }else{
        navigator.clipboard.writeText(`${element}`);
        showNotification("¡Elemento copiado!", "Se ha copiado el elemento");
    }
}
function setButtonLoading(button, isLoading) {
    if (isLoading) {
        const originalWidth = button.offsetWidth;
        if (!button.dataset.originalText) {
            button.dataset.originalText = button.textContent.trim();
        }
        button.innerHTML = `
        <div class="row g-3 justify-content-center align-items-center">
            <div class="col-auto">
                <div class="spinner-border text-light spinner-border-sm" role="status">
                    <span class="visually-hidden"></span>
                </div>
            </div>
            <div id='text-loading' class="col-auto">
                <small class="text-light btn-text">Procesando...</small>
            </div>
        </div>
        `;
        button.disabled = true;
        requestAnimationFrame(() => {
            const newWidth = button.offsetWidth;
            const small = button.querySelector("#text-loading");
            if (small && newWidth > originalWidth) {
                small.classList.add("d-none"); // hide text
            }
        });
    } else {
        if (button.dataset.originalText) {
            button.textContent = button.dataset.originalText;
        }
        button.disabled = false;
    }
}

async function confirmModal({ title, text, mode = "confirm" }) {
    return new Promise((resolve) => {

        let modalEl = document.getElementById("popupModal");
        let bsModal = bootstrap.Modal.getOrCreateInstance(modalEl);

        // DOM elements
        let titleEl = document.getElementById("popup_title");
        let textEl = document.getElementById("popup_text");

        let confirmIcon = document.getElementById("confirm_popup_icon");
        let warningIcon = document.getElementById("warning_popup_icon");

        let confirmBtn = document.getElementById("confirm_popup_btn");
        let warningBtn = document.getElementById("warning_popup_btn");

        // Reset icons and buttons
        confirmIcon.classList.add("d-none");
        warningIcon.classList.add("d-none");
        confirmBtn.classList.add("d-none");
        warningBtn.classList.add("d-none");

        // Apply content
        titleEl.innerText = title;
        textEl.innerText = text;

        // Apply mode
        if (mode === "confirm") {
            confirmIcon.classList.remove("d-none");
            confirmBtn.classList.remove("d-none");
        } else {
            warningIcon.classList.remove("d-none");
            warningBtn.classList.remove("d-none");
        }
        // Button handlers
        const confirmHandler = () => {
            cleanup();
            resolve(true);
            bsModal.hide();
        };
        const cancelHandler = () => {
            cleanup();
            resolve(false);
        };
        confirmBtn.addEventListener("click", confirmHandler, { once: true });
        warningBtn.addEventListener("click", confirmHandler, { once: true });
        modalEl.addEventListener("hidden.bs.modal", cancelHandler, { once: true });

        function cleanup() {
            modalEl.removeEventListener("hidden.bs.modal", cancelHandler);
        }
        // Show modal
        bsModal.show();
    });
}

document.addEventListener("DOMContentLoaded", () => {
    const root = document.documentElement; // 👈 html
    const toggleButton = document.getElementById("themeToggle");
    const metaThemeColor = document.querySelector('meta[name="theme-color"]');

    function applyThemeColor(isLight) {
        metaThemeColor?.setAttribute(
            "content",
            isLight ? "#3b5df6" : "#0b0b18"
        );
    }

    const isLight = root.classList.contains("theme-light");
    applyThemeColor(isLight);

    toggleButton?.addEventListener("click", () => {
        root.classList.toggle("theme-light");
        const light = root.classList.contains("theme-light");

        localStorage.setItem("theme", light ? "light" : "dark");
        applyThemeColor(light);
    });
});



window.addEventListener('DOMContentLoaded', event => {
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
        });
    }
});




window.validateForm = validateForm;
window.getRequest = getRequest;
window.sendRequest = sendRequest;
window.showAlert = showAlert;
window.copyElement = copyElement;
window.confirmModal = confirmModal;
window.showNotification = showNotification;
