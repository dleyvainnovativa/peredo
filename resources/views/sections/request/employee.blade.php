<div class="tab-pane fade show" id="pane-employee" role="tabpanel" aria-labelledby="tab-employee">
    <div class="container py-4">
        <div class="text-center py-2">
            <h3 class="fw-bold"><i class="fas fa-user me-2 text-primary"></i>Datos del Empleado</h3>
            <p class="text-muted">Favor de agregar tu número de empleado y RFC para validación</p>
        </div>
        <div class="row g-4 mb-5" id="employee-grid">
            <form id="employee_form" class="needs-validation">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Número de empleado *</label>
                        <div class="input-group mb-3">
                            <input data-field="NUMERO_EMPLEADO" data-fill="nmlp" id="employee_number" type="text" name="employee" value="012993558" class="form-control" placeholder="Ingresa tu número de empleado" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">RFC *</label>
                        <input data-fill="rtbfjc" type="text" name="rfc" id="employee_rfc" value="NONA820101XYZ" class="form-control " placeholder="Ingresa tu RFC" required>
                    </div>

                    <div class="col-md-4">
                        <label for="full_name" class="form-label fw-bold">Nombre <b>*</b></label>
                        <input data-fill="nmtbj" value="Pedro" type="text" class="form-control " id="employee_full_name" required>
                    </div>

                    <div class="col-md-4">
                        <label for="lastname" class="form-label fw-bold">Apellido Paterno</label>
                        <input data-fill="lastname" type="text" value="Pérez" class="form-control " id="lastname" required>
                    </div>
                    <div class="col-md-4">
                        <label for="lastname2" class="form-label fw-bold">Apellido Materno</label>
                        <input data-fill="lastname2" type="text" value="Jiménez" class="form-control " id="lastname2">
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label fw-bold">Correo electrónico <b>*</b></label>
                        <input data-fill="" value="dancaballerodlc@gmail.com" type="email" class="form-control " id="employee_email" required>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label fw-bold">Teléfono Celular <b>*</b></label>
                        <input data-fill="" value="2291229900" type="phone" class="form-control " id="employee_phone" required>
                    </div>

                    <div class="col-md-6">
                        <label for="payment" class="form-label fw-bold">Último UUID (Si aplica)</label>
                        <input data-fill="uuid" data-field="ULTIMO_UUID" type="text" class="form-control " value="1" id="employee_last_id">
                    </div>
                    <div class="col-md-6">
                        <label for="employee_amount" class="form-label fw-bold">Monto Solicitado</label>
                        <input data-fill="mtntzd" data-field="MONTO_PRESTAMO" type="number" value="1200" class="form-control " id="employee_amount" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">INE Frente</label>
                        <div class="upload-card" onclick="openUploadModal('ine_front')">
                            <div id="preview_ine_front" class="text-center p-4 border rounded">
                                <span><i class="fas fa-camera me-2"></i> Subir INE Frente</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">INE Reverso</label>
                        <div class="upload-card" onclick="openUploadModal('ine_back')">
                            <div id="preview_ine_back" class="text-center p-4 border rounded">
                                <span><i class="fas fa-camera me-2"></i> Subir INE Reverso</span>
                            </div>
                        </div>
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
                        <button type="button" class="btn btn-primary w-100" onclick="prepareEmployee()" id="continue-employee-button">Datos del Promotor</button>
                        <!-- <button type="button" class="btn btn-primary w-100" id="continue-employee-button" data-next="tab-option">Seleccionar Plantilla</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3">

            <h5>Subir documento</h5>

            <input type="file"
                id="fileInput"
                accept="image/*"
                capture="environment"
                class="form-control mb-3">

            <div id="imagePreview" class="text-center mb-3"></div>

            <button class="btn btn-primary w-100" onclick="saveImage()">Guardar</button>

        </div>
    </div>
</div>

<script>
    const documents = @json($documents);
    const templates = @json($templates);
</script>