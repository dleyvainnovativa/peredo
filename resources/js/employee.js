// ===============================
// Employee.js
// ===============================

// Async search employee
async function searchEmployee(event) {
    event.preventDefault();

    let data = await validateForm(event, "employees/search");
    if (data) {
        let employee = data;

        // Fill input fields
        document.getElementById('employee').value = employee.employee;
        document.getElementById('full_name').value = employee.full_name;
        document.getElementById('email').value = employee.email;
        document.getElementById('days').value = employee.days;
        document.getElementById('department').value = employee.department;
        document.getElementById('direction').value = employee.department;
        document.getElementById('position').value = employee.position;
        document.getElementById('payment').value = employee.payment;
        document.getElementById('shift').value = employee.shift;
        document.getElementById('team_leader').value = employee.team_leader;
        document.getElementById('team_leader_email').value = employee.team_leader_email;

        // Empleado
        document.getElementById('review_employee_num').textContent = document.getElementById("employee").value;
        document.getElementById('review_employee_name').textContent = document.getElementById("employee_full_name").value;
        document.getElementById('review_employee_rfc').textContent = document.getElementById("employee_rfc").value;
        document.getElementById('review_employee_email').textContent = document.getElementById("employee_email").value;

        // Promotor
        document.getElementById('review_name').textContent = employee.full_name;
        document.getElementById('review_email').textContent = employee.email;
        document.getElementById('review_days').textContent = employee.days;
        document.getElementById('review_department').textContent = employee.department;
        document.getElementById('review_position').textContent = employee.position;
        document.getElementById('review_payment').textContent = employee.payment;
        document.getElementById('review_shift').textContent = employee.shift;
        document.getElementById('review_team_leader').textContent = employee.team_leader;
        document.getElementById('review_team_leader_email').textContent = employee.team_leader_email;


        // Enable next button on personal step
        document.getElementById("send_request").disabled = false;
    }
}

// ===============================
// Vacation form handling
// ===============================

// Grab elements
const dateInitInput = document.getElementById("date_init");
const dateEndInput = document.getElementById("date_end");
const commentsInput = document.getElementById("comments");
const validateBtn = document.getElementById("validateDetails");

const reviewDateInit = document.getElementById("review_date_init");
const reviewDateEnd = document.getElementById("review_date_end");
const reviewTotalDays = document.getElementById("review_total_days");
const reviewComments = document.getElementById("review_comments"); // optional

let swalShown = false; // control duplicate alerts

// Format date
function formatDate(dateStr) {
    if (!dateStr) return "";
    const date = new Date(dateStr);
    return date.toLocaleDateString("es-MX", {
        year: "numeric",
        month: "long",
        day: "numeric"
    });
}

// Calculate total days
function calculateDays(start, end) {
    if (!start || !end) return "";
    const d1 = new Date(start);
    const d2 = new Date(end);
    const diff = (d2 - d1) / (1000 * 60 * 60 * 24);
    return diff >= 0 ? `${diff + 1} días y ${diff} noches` : "";
}

// Validate form logic
function checkForm() {
    const initVal = dateInitInput.value;
    const endVal = dateEndInput.value;

    if (initVal && endVal) {
        const allowedDays = 5;
        const requestedDays = (new Date(endVal) - new Date(initVal)) / (1000 * 60 * 60 * 24) + 1;

        if (requestedDays > allowedDays) {
            if (!swalShown) {
                showAlert("Error al seleccionar días", `Solicitaste ${requestedDays} días, pero solo tienes ${allowedDays} disponibles.`)
                // Swal.fire({
                //     icon: "error",
                //     title: "¡Error!",
                //     text: `Solicitaste ${requestedDays} días, pero solo tienes ${allowedDays} disponibles.`,
                //     confirmButtonText: "Entendido"
                // });
                swalShown = true;
            }
            // validateBtn.disabled = true;
            return;
        }

        // ✅ valid case
        // validateBtn.disabled = false;
        swalShown = false;
    } else {
        // validateBtn.disabled = true;
    }
}

// Update preview section
async function updateReview() {
    // const initVal = dateInitInput.value;
    // const endVal = dateEndInput.value;
    // reviewDateInit.textContent = formatDate(initVal);
    // reviewDateEnd.textContent = formatDate(endVal);
    // let days_taken = calculateDays(initVal, endVal);
    // reviewTotalDays.textContent = days_taken;
    // document.getElementById("days_taken").value = days_taken;
    // document.getElementById("leader_comments").value = commentsInput.value;

    // if (reviewComments) reviewComments.textContent = commentsInput.value;

    await fillTemplateFields();
    await fillTemplateHTML();
    await fillDocument();

    // Run validation
    checkForm();
}

// ===============================
// Event listeners
// ===============================




// Expose searchEmployee globally
window.searchEmployee = searchEmployee;
window.updateReview = updateReview;
