// ===============================
// Employee.js
// ===============================

// Async search employee
async function searchEmployee(event) {
        document.getElementById('full_name').value = null;
        document.getElementById('phone').value =  null;
        document.getElementById('email').value =  null;
        document.getElementById('review_employee_num').textContent = null;
        document.getElementById('review_employee_name').textContent = null;
        document.getElementById('review_employee_rfc').textContent = null;
        document.getElementById('review_employee_email').textContent = null;
        document.getElementById('review_dependencia').textContent = null;
        document.getElementById('review_name').textContent = null;
        document.getElementById('review_email').textContent = null;
        document.getElementById('review_phone').textContent = null;
        document.getElementById("send_request").disabled = true;
        document.getElementById("continue-branches-button").disabled = true;
    event.preventDefault();
    let data = await validateForm(event, "employees/search");
    if (data) {
        let employee = data;
        document.getElementById('full_name').value = employee.name;
        document.getElementById('phone').value = employee.phone;
        document.getElementById('email').value = employee.email;
        // Promotor
        document.getElementById('review_name').textContent = employee.name;
        document.getElementById('review_email').textContent = employee.email;
        document.getElementById('review_phone').textContent = employee.phone;


        // Enable next button on personal step
        document.getElementById("send_request").disabled = false;
        document.getElementById("continue-branches-button").disabled = false;
    }else{
        showAlert('Promotor no encontrado', 'El ID del promotor no es válido');
    }
}

const validateBtn = document.getElementById("validateDetails");

// Update preview section
async function updateReview() {
    console.log("update Review");
    await fillFields();
    await fillTemplateFields();
    await fillTemplateHTML();
    await fillDocument();
    if(document.getElementById("review_email").textContent){
        manualNavigate("tab-review");
    }else{
        showAlert('Faltan datos del promotor', 'Busque de nuevo los datos del promotor');
    }
}

async function fillFields(){
        // Empleado
        document.getElementById('review_employee_num').textContent = document.getElementById("employee_number").value;
        document.getElementById('review_employee_name').textContent = `${document.getElementById("employee_full_name").value} ${document.getElementById("lastname").value} ${document.getElementById("lastname2").value}`;
        document.getElementById('review_employee_rfc').textContent = document.getElementById("employee_rfc").value;
        document.getElementById('review_employee_email').textContent = document.getElementById("employee_email").value;
        document.getElementById('review_dependencia').textContent = document.getElementById("employee_direction").value;
        
}

// Expose searchEmployee globally
window.searchEmployee = searchEmployee;
window.updateReview = updateReview;
