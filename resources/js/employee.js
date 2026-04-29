let currentField = null;
let currentFile = null;

function openUploadModal(field) {
    currentField = field;
    document.getElementById('fileInput').value = '';
    document.getElementById('imagePreview').innerHTML = '';

    let modal = new bootstrap.Modal(document.getElementById('uploadModal'));
    modal.show();
}

document.getElementById('fileInput').addEventListener('change', function (e) {
    const input = e.target;
    const file = input.files[0];

    if (!file) return;

    // ✅ Validate it's an image
    if (!file.type.startsWith('image/')) {
        showAlert('Archivo no es una imagen', 'Favor de ingresar una imagen');

        // Reset input
        input.value = '';

        // Optional: clear preview
        document.getElementById('imagePreview').innerHTML = '';

        return;
    }

    currentFile = file;

    const reader = new FileReader();
    reader.onload = function (e) {
        document.getElementById('imagePreview').innerHTML = `
            <img src="${e.target.result}" class="img-fluid rounded" />
        `;
    };
    reader.readAsDataURL(file);
});

function saveImage() {
    if (!currentFile) return;

    const preview = document.getElementById(`preview_${currentField}`);

    const reader = new FileReader();
    reader.onload = function (e) {
        preview.innerHTML = `
            <img src="${e.target.result}" class="img-fluid rounded" />
            <small class="d-block mt-2 btn btn-primary">Cambiar</small>
        `;
    };
    reader.readAsDataURL(currentFile);

    // Optional: store file in hidden input or JS object
    window[currentField] = currentFile;

    bootstrap.Modal.getInstance(document.getElementById('uploadModal')).hide();
}

async function generatePDF(files) {
    const { jsPDF } = window.jspdf;
    const pdf = new jsPDF();

    for (let i = 0; i < files.length; i++) {
        const file = files[i];

        await addImageToPDF(pdf, file);

        // Add page ONLY if it's not the last file
        if (i < files.length - 1) {
            pdf.addPage();
        }
    }

    return pdf.output('blob');
}

async function addImageToPDF(pdf, file) {
    const base64 = await fileToBase64(file);

    const img = await loadImage(base64);

    const pageWidth = pdf.internal.pageSize.getWidth();
    const pageHeight = pdf.internal.pageSize.getHeight();

    // Maintain aspect ratio
    const ratio = img.width / img.height;

    let newWidth = pageWidth;
    let newHeight = newWidth / ratio;

    // If height exceeds page, scale down
    if (newHeight > pageHeight) {
        newHeight = pageHeight;
        newWidth = newHeight * ratio;
    }

    // Center image
    const x = (pageWidth - newWidth) / 2;
    const y = (pageHeight - newHeight) / 2;

    const format = base64.includes('png') ? 'PNG' : 'JPEG';

    pdf.addImage(base64, format, x, y, newWidth, newHeight);
}

function loadImage(base64) {
    return new Promise(resolve => {
        const img = new Image();
        img.src = base64;
        img.onload = () => resolve(img);
    });
}

function fileToBase64(file) {
    return new Promise(resolve => {
        const reader = new FileReader();
        reader.onload = e => resolve(e.target.result);
        reader.readAsDataURL(file);
    });
}

function blobToFile(blob, filename) {
    return new File([blob], filename, {
        type: 'application/pdf'
    });
}

async function prepareEmployee() {

    // Initialize Form Validation & Submit
    const form = document.querySelector('#employee_form.needs-validation')
    if (!form.checkValidity()) {
        showAlert('Faltan datos', 'Ingrese todos los campos obligatorios');
        form.classList.add('was-validated');
        return;
    }
    form.classList.add('was-validated');



    if (!window.ine_front || !window.ine_back || !window.selfie_photo) {
        showAlert('Error al ingresar datos', 'Debes subir INE frente y reverso y un Selfie');
        return;
    }
    try {
        const pdfBlobINE = await generatePDF([window.ine_front, window.ine_back]);
        const pdfFileINE = blobToFile(pdfBlobINE, 'annexed.pdf');
        const inputINE = document.getElementById('annexed_input');
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(pdfFileINE);
        inputINE.files = dataTransfer.files;
        
        const pdfBlobSelfie = await generatePDF([window.selfie_photo]);
        const pdfFileSelfie = blobToFile(pdfBlobSelfie, 'annexed_selfie.pdf');
        const inputSelfie = document.getElementById('annexed_selfie_input');
        const dataTransferSelfie = new DataTransfer();
        dataTransferSelfie.items.add(pdfFileSelfie);
        inputSelfie.files = dataTransferSelfie.files;

        await manualNavigate("tab-branches");

    } catch (error) {
        console.error(error);
        alert('Error al generar el PDF');
    }
}

document.getElementById('employee_rfc').addEventListener('input', function () {
    this.value = this.value.toUpperCase();
});
document.getElementById('employee_phone').addEventListener('input', function (e) {
    // Replace anything that is NOT a number
    this.value = this.value.replace(/\D/g, '');
});

window.openUploadModal = openUploadModal;
window.saveImage = saveImage;
window.prepareEmployee = prepareEmployee;
