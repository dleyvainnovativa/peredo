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
                            <input data-field="NUMERO_EMPLEADO" data-fill="nmlp" id="employee_number"
                                type="text" min="1" max="15" name="employee" value=""
                                class="form-control"
                                placeholder="Ingresa tu número de empleado" required>

                            <div class="invalid-feedback">
                                Ingresa tu número de empleado.
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">RFC *</label>
                        <input data-fill="rtbfjc"
                            type="text"
                            minlength="12"
                            maxlength="13"
                            pattern="^[A-ZÑ&]{3,4}[0-9]{6}[A-Z0-9]{3}$"
                            name="rfc"
                            id="employee_rfc"
                            value=""
                            class="form-control"
                            placeholder="Ingresa tu RFC"
                            required>

                        <div class="invalid-feedback">
                            Ingresa un RFC válido.
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Nombre *</label>
                        <input value="" type="text" class="form-control" id="employee_full_name" required>
                        <input data-fill="nmtbj" value="" type="hidden" class="form-control " id="employee_complete_name">

                        <div class="invalid-feedback">
                            Ingresa tu nombre.
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Apellido Paterno *</label>
                        <input data-fill="lastname" type="text" value="" class="form-control" id="lastname" required>
                        <div class="invalid-feedback">
                            Ingresa tu apellido paterno.
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Apellido Materno</label>
                        <input data-fill="lastname2" type="text" value="" class="form-control" id="lastname2">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Correo electrónico *</label>
                        <input data-fill="" value=""
                            type="email"
                            class="form-control"
                            pattern="^[^\s@]+@[^\s@]+\.(com|mx)$"

                            id="employee_email"
                            required>

                        <div class="invalid-feedback">
                            Ingresa un correo válido.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Teléfono Celular *</label>
                        <input data-fill=""
                            minlength="10"
                            maxlength="10"
                            pattern="^[0-9]{10}$"
                            inputmode="numeric"
                            value=""
                            type="tel"
                            class="form-control"
                            id="employee_phone"
                            required>

                        <div class="invalid-feedback">
                            Ingresa un número de 10 dígitos.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="payment" class="form-label fw-bold">UUID del último talón de cheques</label>
                        <input data-fill="uuid" data-field="ULTIMO_UUID" type="text" class="form-control " value="1" id="employee_last_id">
                        <div class="invalid-feedback">
                            Ingresa un UUID válido
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Monto Solicitado</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">$</span>
                            <input data-fill="mtntzd"
                                data-field="MONTO_PRESTAMO"
                                type="number"
                                value=""
                                class="form-control"
                                id="employee_amount"
                                required>
                        </div>

                        <div class="invalid-feedback">
                            Ingresa un monto válido.
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">INE Frente *</label>
                        <div class="upload-card" onclick="openUploadModal('ine_front')">
                            <div id="preview_ine_front" class="text-center p-4 border rounded">
                                <span><i class="fas fa-address-card me-2"></i> Subir INE Frente</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">INE Reverso *</label>
                        <div class="upload-card" onclick="openUploadModal('ine_back')">
                            <div id="preview_ine_back" class="text-center p-4 border rounded">
                                <span><i class="fas fa-credit-card me-2"></i> Subir INE Reverso</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Selfie *</label>
                        <div class="upload-card" onclick="openUploadModal('selfie_photo')">
                            <div id="preview_selfie_photo" class="text-center p-4 border rounded">
                                <span><i class="fas fa-image-portrait me-2"></i> Subir Selfie</span>
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

            <h5>Subir archivo</h5>
            <p class="text-muted">Subir archivo tipo imagen (.png, .jpg, .jpeg)</p>

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