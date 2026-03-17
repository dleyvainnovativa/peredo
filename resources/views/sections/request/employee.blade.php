<div class="tab-pane fade show" id="pane-employee" role="tabpanel" aria-labelledby="tab-employee">
    <div class="container py-4">
        <div class="text-center py-2">
            <h3 class="fw-bold"><i class="fas fa-user me-2 text-primary"></i>Datos del Empleado</h3>
            <p class="text-muted">Favor de agregar tu número de empleado y RFC para validación</p>
        </div>
        <div class="row g-4 mb-5" id="employee-grid">


            <form id="employee_form">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Número de empleado *</label>
                        <div class="input-group mb-3">
                            <input data-fill="nmlp" id="employee" type="text" name="employee" value="012993558" class="form-control " placeholder="Ingresa tu número de empleado">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">RFC *</label>
                        <input data-fill="rtbfjc" type="text" name="rfc" id="employee_rfc" value="NONA820101XYZ" class="form-control " placeholder="Ingresa tu RFC">
                    </div>

                    <div class="col-md-6">
                        <label for="full_name" class="form-label">Nombre completo (Nombres y Apellidos) <b>*</b></label>
                        <input data-fill="nmtbj" value="Pedro Pérez" type="text" class="form-control " id="employee_full_name">
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Correo electrónico <b>*</b></label>
                        <input data-fill="" value="dancaballerodlc@gmail.com" type="email" class="form-control " id="employee_email">
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Teléfono Celular <b>*</b></label>
                        <input data-fill="" value="2291229900" type="phone" class="form-control " id="employee_phone">
                    </div>

                    <div class="col-md-6">
                        <label for="payment" class="form-label">Último UUID (Si aplica)</label>
                        <input data-fill="uuid" type="text" class="form-control " value="1" id="employee_payment">
                    </div>
                    <div class="col-md-6">
                        <label for="days" class="form-label">Monto Solicitado</label>
                        <input data-fill="mtntzd" type="number" value="1200" class="form-control " id="days">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">INE Frente</label>
                        <input type="file"
                            id="ine_front"
                            class="form-control"
                            accept="image/*,application/pdf"
                            capture="environment"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">INE Reverso</label>
                        <input type="file"
                            id="ine_back"
                            class="form-control"
                            accept="image/*,application/pdf"
                            capture="environment"
                            required>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="mx-auto fixed-bottom bg-dark py-3 shadow">
        <div class="container">
            <div class="container">
                <div class="row g-2">
                    <div class="col-md-auto col-5">
                        <button type="button" class="btn btn-outline-primary w-100" data-prev="tab-option">Anterior</button>
                    </div>
                    <div class="col-md-auto ms-auto col-7">
                        <button type="button" class="btn btn-primary w-100" id="continue-employee-button" data-next="tab-branches">Datos del Promotor</button>
                        <!-- <button type="button" class="btn btn-primary w-100" id="continue-employee-button" data-next="tab-option">Seleccionar Plantilla</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    const documents = @json($documents);
    const templates = @json($templates);

    document.addEventListener("DOMContentLoaded", () => {

        const sucursalSelect = document.getElementById("employee_sucursal");
        const dependenciaSelect = document.getElementById("employee_direction");

        // Populate sucursal
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
</script>