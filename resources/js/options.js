async function buildDetails() {
    let chosen = document.getElementById("templates_choose");
    console.log(chosen);
    let content = JSON.parse(chosen.value);
    let image = content.image;
    let name = content.TemplateName;
    document.getElementById("main_img").src = image;
    document.getElementById("main_name").textContent = name;
    let template_id = content.id;
    document.getElementById("send_template_id").value = template_id;
    // console.log(template_id);
    let template = content.Templates;
    let fields = await getFields(content.Fields);
    let annexed = await content.Annexed;
    console.log(fields);
    await buildFormControls(fields);
    await buildAnexed(annexed);
    await buildTemplateHtml(template);

    // console.log(template);
    // console.log(fields);
}

async function getFields(all_fields) {
    let fields = [];
    all_fields.forEach(field => {
        if (field.description != null) {
            fields.push(field);
        }
    });
    return fields;
}

async function buildTemplateHtml(html) {
    let templateHTML = document.getElementById("template_html");
    templateHTML.innerHTML = "";
    templateHTML.innerHTML = html;
}

async function buildFormControls(jsonData) {

    const container = document.getElementById("template_fields");
    container.innerHTML = ""; // Clear before building

    jsonData.forEach(field => {
        // let wrapper = document.createElement("div");
        // wrapper.className = "col-12";

        // let label = document.createElement("label");
        // label.className = "form-label";
        // label.textContent = field.description;
        // wrapper.appendChild(label);

        let inputGroup = document.createElement("div");
        inputGroup.className = "input-group mb-3";
        // Build input
        let input = document.createElement("input");
        input.className = "form-control form-control-lg";
        input.type = "text";
        input.hidden = true;
        input.setAttribute("data-variable", field.variable);
        input.setAttribute("name", field.variable);
        input.placeholder = "Ingresa " + field.description;
        inputGroup.appendChild(input);

        // wrapper.appendChild(inputGroup);
        // container.appendChild(wrapper);
        container.appendChild(inputGroup);
    });
}
async function buildAnexed(jsonData) {
    const container = document.getElementById("template_annexed");
    container.innerHTML = ""; // Clear before building
    console.log(jsonData);
    jsonData.forEach(field => {
        // <label for="book-vacation" class="form-label">Sube archivo Anexo</label>
        //             <input type="file" class="form-control" required />

        let inputGroup = document.createElement("div");
        inputGroup.className = "col-12";
        // Build input
        let label = document.createElement("label");
        let input = document.createElement("input");
        label.className = "form-label";
        label.textContent = field;
        input.className = "form-control";
        input.type = "file";
        // input.hidden = true;
        input.setAttribute("data-variable", field);
        // input.placeholder = "Ingresa " + field.description;
        inputGroup.appendChild(label);
        inputGroup.appendChild(input);

        // wrapper.appendChild(inputGroup);
        // container.appendChild(wrapper);
        container.appendChild(inputGroup);
    });
}

async function fillTemplateHTML() {
    let chosen = document.getElementById("templates_choose");
    let content = JSON.parse(chosen.value);
    let template = content.Templates;
    await buildTemplateHtml(template);

    const container = document.getElementById("template_html");

    // Clone the innerHTML so we can manipulate it as a string
    let html = container.innerHTML;

    // Get all hidden fields from promotorForm
    const hiddenFields = [
        ...document.querySelectorAll("#promotorForm [data-fill]"),
        ...document.querySelectorAll("#employee_form [data-fill]")
    ];

    hiddenFields.forEach(hidden => {
        const key = hidden.getAttribute("data-fill");
        const value = hidden.value || "";

        // Build regex to find <s>key</s>
        const regex = new RegExp(`<s>${key}</s>`, "gi");

        // Replace with value
        html = html.replace(regex, value);
    });

    // Update container
    container.innerHTML = html;

}
async function fillDocument() {

    const container = document.getElementById("template_html");
    document.getElementById("send_html").value = JSON.stringify(container.innerHTML);
    document.getElementById("send_template_fields").value = JSON.stringify(getTemplateFields());

    document.getElementById("send_promotor_id").value = document.getElementById("promotor_id").value;
    document.getElementById("send_promotor_name").value = document.getElementById("full_name").value;
    document.getElementById("send_promotor_email").value = document.getElementById("email").value;
    document.getElementById("send_employee_rfc").value = document.getElementById("employee_rfc").value;
    document.getElementById("send_employee_phone").value = document.getElementById("employee_phone").value;
    document.getElementById("send_employee_name").value = `${document.getElementById("employee_full_name").value} ${document.getElementById("lastname").value} ${document.getElementById("lastname2").value}`;
    document.getElementById("send_employee_firstname").value = `${document.getElementById("employee_full_name").value}`;
    document.getElementById("send_employee_lastname").value = `${document.getElementById("lastname").value}`;
    document.getElementById("send_employee_lastname2").value = `${document.getElementById("lastname2").value}`;
    document.getElementById("send_employee_email").value = document.getElementById("employee_email").value;
    document.getElementById("send_employee_num").value = document.getElementById("employee_number").value;
    document.getElementById("send_employee_amount").value = document.getElementById("employee_amount").value;
    document.getElementById("send_employee_lastid").value = document.getElementById("employee_last_id").value;

    // document.getElementById("send_leader_name").value = document.getElementById("team_leader").value;
    // document.getElementById("send_leader_email").value = document.getElementById("team_leader_email").value;

}

function getTemplateFields() {
    const inputs = document.querySelectorAll('#template_fields input[data-variable]');

    const fields = Array.from(inputs).map(input => {
        return {
            name: input.dataset.variable,
            value: input.value
        };
    });

    return fields;
}

async function fillTemplateFields() {
    const hiddenFields = [
        ...document.querySelectorAll("#promotorForm [data-fill]"),
        ...document.querySelectorAll("#employee_form [data-fill]")
    ];
    // console.log(hiddenFields);
    hiddenFields.forEach(hidden => {
        const key = hidden.getAttribute("data-fill");
        // console.log(key);
        const value = hidden.value;
        const target = document.querySelector(`#template_fields [data-variable="${key}"]`);
        if (target) {
            if (target.tagName.toLowerCase() === "select") {
                const option = [...target.options].find(opt => opt.value === value);
                if (option) {
                    target.value = value;
                } else {
                    target.value = value;
                }
            } else {
                target.value = value;
            }
        }
    });
}


    document.addEventListener("DOMContentLoaded", () => {

        const sucursalSelect = document.getElementById("employee_sucursal");
        const dependenciaSelect = document.getElementById("employee_direction");

        // Populate sucursal
        let option = document.createElement("option");
        option.value = null;
        option.textContent = "Selecciona Sucursal";
            sucursalSelect.appendChild(option);

        Object.keys(documents).forEach(sucursal => {
            const option = document.createElement("option");
            option.value = sucursal;
            option.textContent = sucursal;
            sucursalSelect.appendChild(option);
        });

        // When sucursal changes
        sucursalSelect.addEventListener("change", function() {

            const sucursal = this.value;

            dependenciaSelect.innerHTML = '<option value="">Seleccione dependencia</option>';

            if (!documents[sucursal]) return;

            Object.keys(documents[sucursal]).forEach(dep => {
                const option = document.createElement("option");
                option.value = dep;
                option.textContent = dep;
                dependenciaSelect.appendChild(option);
            });

        });

    });


window.buildDetails = buildDetails;
window.fillTemplateFields = fillTemplateFields;
window.fillTemplateHTML = fillTemplateHTML;
window.fillDocument = fillDocument;
