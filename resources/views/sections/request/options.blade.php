<div class="tab-pane fade show active" id="pane-option" role="tabpanel" aria-labelledby="tab-option">
    <div class="container py-4">
        <div class="text-center py-2">
            <h3 class="fw-bold"><i class="fas fa-list me-2 text-primary"></i> Seleccionar solicitud</h3>
            <p class="text-muted">Seleccione el tipo de solicitud para empezar el trámite.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-12">
                <label for="employee_sucursal" class="form-label">Sucursal</label>
                <select data-fill="" class="form-select" name="" id="employee_sucursal"></select>
                <!-- <input data-fill="ndpc" type="text" value="Ventas" class="form-control " id="employee_direction"> -->
            </div>
            <div class="col-md-12">
                <label for="employee_direction" class="form-label">Dependencia perteneciente</label>
                <select data-fill="ndpc" class="form-select" name="" id="employee_direction"></select>
                <!-- <input data-fill="ndpc" type="text" value="Ventas" class="form-control " id="employee_direction"> -->
            </div>
            <div class="col-md-12">
                <label class="form-label">Selecciona la plantilla *</label>
                <select class="form-control" id="templates_choose">
                    <option value="">Seleccione plantilla</option>
                </select>
            </div>
        </div>
    </div>
    <div class="mx-auto fixed-bottom bg-dark py-3 shadow">
        <div class="container">
            <div class="container">
                <div class="row g-2">
                    <div class="col-md-auto col-5">
                        <!-- <button type="button" class="btn btn-outline-primary w-100" data-prev="tab-employee">Anterior</button> -->
                    </div>
                    <div class="col-md-auto ms-auto col-7">
                        <button type="button" class="btn btn-primary w-100" onclick="buildDetails()" id="continue-options-button" data-next="tab-employee">Datos del Empleado</button>
                        <!-- <button type="button" class="btn btn-primary w-100" onclick="buildDetails()" id="continue-options-button" data-next="tab-branches">Siguiente</button> -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const sucursalSelect = document.getElementById("employee_sucursal");
    const dependenciaSelect = document.getElementById("employee_direction");
    const templateSelect = document.getElementById("templates_choose");

    dependenciaSelect.addEventListener("change", function() {

        const sucursal = sucursalSelect.value;
        const dependencia = this.value;

        templateSelect.innerHTML = '<option value="">Seleccione plantilla</option>';

        if (!documents[sucursal] || !documents[sucursal][dependencia]) return;

        const docs = documents[sucursal][dependencia];

        docs.forEach(doc => {

            const template = templates.find(t => t.doc_id === doc.doc_id);

            if (template) {
                const option = document.createElement("option");
                option.value = template.content;
                option.textContent = template.name;
                templateSelect.appendChild(option);
            }

        });

    });
</script>