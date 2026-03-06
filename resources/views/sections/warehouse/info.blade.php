<div class="tab-pane fade show active" id="pane-info" role="tabpanel" aria-labelledby="tab-info">
    <div class="container py-4">
        <div class="py-2 text-center">
            <h3 class="fw-bold"><i class="fas fa-user me-2 text-primary"></i>Tus datos</h3>
            <p class="text-muted">Por favor, proporciona tu información de contacto para confirmar la reservación.</p>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-12">
                <div class="card card-dark border border-dark">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4"><i class="fas fa-user me-2 text-primary" aria-hidden="true"></i> Datos del Solicitante</h5>
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <p><b>Nombre: </b><span id="review_name">Angel Samuel Chavez Camacho</span></p>
                            </div>
                            <div class="col-12 col-md-6">
                                <p><b>Correo electrónico: </b><span id="review_email">gestion.documental@sistemascontino.com.mx</span></p>
                            </div>
                            <div class="col-12 col-md-6">
                                <p><b>Días disponibles: </b><span id="review_days">4</span></p>
                            </div>
                            <div class="col-12 col-md-6">
                                <p><b>Departamento: </b><span id="review_department">Tecnologias de la información</span></p>
                            </div>
                            <div class="col-12 col-md-6">
                                <p><b>Puesto: </b><span id="review_position">Desarrollador IBM</span></p>
                            </div>
                            <div class="col-12 col-md-6 d-none">
                                <p><b>Puesto: </b><span id="review_payment">Quincenal</span></p>
                            </div>
                            <div class="col-12 col-md-6 d-none">
                                <p><b>Puesto: </b><span id="review_shift">Matutino</span></p>
                            </div>
                            <div class="col-12 col-md-6 d-none">
                                <p><b>Team Leader: </b><span id="review_team_leader">Elias Castellanos</span></p>
                            </div>
                            <div class="col-12 col-md-6 d-none">
                                <p><b>Correo Leader: </b><span id="review_team_leader_email">acontisign@gmail.com</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 mx-auto">
                <div class="card card-dark border border-dark h-100">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table id="manager-table" class="table table-hover align-middle rounded text-bg-dark"
                                data-pagination="true">
                                <thead class="table-light text-bg-dark">
                                    <tr>
                                        <th data-field="name" scope="col">Nombre de Producto</th>
                                        <th data-field="category_format" scope="col">Categoría</th>
                                        <th data-field="quantity_raw" scope="col" class="">Cantidad</th>
                                        <th data-field="validation" scope="col" class="">Validación</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-auto fixed-bottom bg-dark py-3 shadow">
        <div class="container">
            <div class="container">
                <div class="row g-2">
                    <!-- <div class="col-md-auto col-5">
                        <button type="button" class="btn btn-outline-primary w-100" data-prev="tab-calendar">Anterior</button>
                    </div> -->
                    <div class="col-md-auto col-7 ms-auto">
                        <button type="button" disabled class="btn btn-primary w-100" id="continue-to-payment-btn" data-next="tab-confirm">Generar PDF</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>