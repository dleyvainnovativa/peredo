
async function uploadDocument(event) {
    event.preventDefault();

    const checkReview = document.getElementById("checkReview");

    if (!checkReview.checked) {
        showAlert("Debes aceptar los términos", "Marca la casilla de términos y condiciones para continuar.");
        return;
    }
    let data = await validateForm(event, "contisign/send");
    if (data) {
        console.log(data);
        await showNotification(
            "Se ha enviado la solicitud",
            "El promotor será notificado para su aprobación",
            null,
            "me-2 fas fa-check-circle"
        );
        // location.reload();
    }
}
window.uploadDocument = uploadDocument;
