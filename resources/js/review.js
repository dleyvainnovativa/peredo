
async function uploadDocument(event) {
    event.preventDefault();
    let data = await validateForm(event, "contisign/send");
    if (data) {
        console.log(data);
        let message = await showNotification(" Se ha enviado la solicitud", "El almacenista será notificado para su aprobación", null, "me-2 fas fa-check-circle");
        location.reload();
    }
}

window.uploadDocument = uploadDocument;
