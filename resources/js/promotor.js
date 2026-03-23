// ===============================
// Employee.js
// ===============================

// Async search employee
async function searchEmployee(event) {
    event.preventDefault();

    let data = await validateForm(event, "employees/search");
    if (data) {
        let employee = data;
        document.getElementById('full_name').value = employee.name;
        document.getElementById('phone').value = employee.phone;
        document.getElementById('email').value = employee.email;

        // Empleado
        document.getElementById('review_employee_num').textContent = document.getElementById("employee_number").value;
        document.getElementById('review_employee_name').textContent = `${document.getElementById("employee_full_name").value} ${document.getElementById("lastname").value} ${document.getElementById("lastname2").value}`;
        document.getElementById('review_employee_rfc').textContent = document.getElementById("employee_rfc").value;
        document.getElementById('review_employee_email').textContent = document.getElementById("employee_email").value;
        document.getElementById('review_dependencia').textContent = document.getElementById("employee_direction").value;
        

        // Promotor
        document.getElementById('review_name').textContent = employee.name;
        document.getElementById('review_email').textContent = employee.email;
        document.getElementById('review_phone').textContent = employee.phone;


        // Enable next button on personal step
        document.getElementById("send_request").disabled = false;
    }
}

const validateBtn = document.getElementById("validateDetails");

// Update preview section
async function updateReview() {
    console.log("update Review");
    await fillTemplateFields();
    await fillTemplateHTML();
    await fillDocument();
}

// Expose searchEmployee globally
window.searchEmployee = searchEmployee;
window.updateReview = updateReview;
