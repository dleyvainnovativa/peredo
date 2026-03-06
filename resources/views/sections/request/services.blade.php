<div class="tab-pane fade " id="pane-services" role="tabpanel" aria-labelledby="tab-services">
    <div class="container py-4">
        <div class="text-center py-2">
            <h3 class="fw-bold"><i class="fas fa-clipboard-list me-2 text-primary"></i>Productos a Solicitar</h3>
            <p class="text-muted">Para agregar items deberás dar click en "Agregar producto", seleccionar de la lista, agregar cantidad y dar click en "Agregar Item"</p>
        </div>

        <!-- Services Grid -->
        <div class="row g-4">
            <div class="col-12 col-md-12 me-auto text-end">
                <button class="btn btn-success text-end" data-bs-toggle="modal" data-bs-target="#addItem"><i class="me-2 fas fa-add"></i>Agregar producto</button>
            </div>
            <div class="col-12 col-md-12 mx-auto">
                <div class="card card-dark border border-dark h-100">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table id="manager-table" class="table table-hover align-middle rounded text-bg-dark"
                                data-pagination="true">
                                <thead class="">
                                    <tr>
                                        <th data-field="name">Nombre de Producto</th>
                                        <th data-field="category">Categoría</th>
                                        <th data-field="quantity" class="text-center">Cantidad</th>
                                        <th data-field="validation" class="text-center">Validación</th>
                                        <th data-field="actions" class="text-center">Borrar</th>
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
                    <!-- <div class="col-md-auto col-6">
                        <button disabled type="button" disabled class="btn btn-outline-primary w-100" id="selected-services-button">0 Services</button>
                    </div>
                    <div class="col-md-auto ms-auto col-6">
                        <button type="button" disabled class="btn btn-primary w-100" id="continue-services-button" data-next="tab-calendar">Continuar</button>
                    </div> -->
                    <div class="col-md-auto col-2">
                        <!-- <div class="col-md-auto col-5"> -->
                        <!-- <button type="button" class="btn btn-outline-primary w-100" data-prev="tab-services"><i class="fas fa-chevron-left"></i></button> -->
                        <button type="button" class="btn btn-outline-primary w-100" data-prev="tab-branches"><i class="fas fa-chevron-left"></i></button>
                    </div>
                    <div class="col-md-auto col-5 d-none">
                        <button disabled type="button" disabled class="btn btn-outline-primary w-100" id="selected-services-button">0 Services</button>
                    </div>
                    <div class="col-md-auto ms-auto col-5">
                        <!-- <div class="col-md-auto ms-auto col-7"> -->
                        <button type="button" class="btn btn-primary w-100" id="continue-services-button" data-next="tab-review">Ver Resumen</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>