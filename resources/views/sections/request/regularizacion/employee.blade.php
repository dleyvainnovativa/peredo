<div class="tab-pane fade show active" id="pane-employee" role="tabpanel" aria-labelledby="tab-employee">
    <div class="container py-4">
        <div class="text-center py-2">
            <h3 class="fw-bold"><i class="fas fa-file-contract me-2 text-primary"></i>Datos de la Solicitud</h3>
            <p class="text-muted">Favor de leer y revisar la información antes de continuar</p>
        </div>
        <div class="row g-4 mb-5" id="employee-grid">
            <form id="employee_form" class="needs-validation">
                <div class="row g-3">
                   
                    <div class="col-md-12 pb-4">
                        {!! $html !!}
                    </div>

                    <div class="col-md-12">
                        <div class="row g-4">
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
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="mx-auto fixed-bottom bg-dark py-3 shadow">
        <div class="container">
            <div class="container">
                <div class="row g-2">
                    <!-- <div class="col-md-auto col-5">
                        <button type="button" class="btn btn-outline-primary w-100" data-prev="tab-option">Anterior</button>
                    </div> -->
                    <div class="col-md-auto ms-auto col-12">
                        <button type="button" class="btn btn-primary w-100" onclick="prepareEmployeeRegularizacion()" id="continue-employee-button">Resumen de la Solicitud</button>
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