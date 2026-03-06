<div class="tab-pane fade " id="pane-services" role="tabpanel" aria-labelledby="tab-services">
    <div class="container py-4">
        <div class="text-center py-2">
            <h3 class="fw-bold"><i class="fas fa-clipboard-list me-2 text-primary"></i>Anexos</h3>
            <p class="text-muted">Sube los anexos necesarios"</p>
        </div>

        <form>
            <div class="row g-4">
                <div class="col-12 d-none">
                    <label for="book-vacation" class="form-label">Selecciona fecha</label>
                    <input type="date" id="book-vacation" class="form-control" required />
                </div>
                <!-- <div class="col-12 ">
                    <label for="book-vacation" class="form-label">Sube archivo Anexo</label>
                    <input type="file" class="form-control" required />
                </div> -->
                <input type="hidden" id="date_init">
                <input type="hidden" id="date_end">
                <div class="col-12">
                    <div id="template_annexed" class="text-dark row g-4">
                    </div>
                </div>
                <div class="col-12">
                    <div id="template_fields" class="text-dark col-12">
                    </div>
                </div>
            </div>
        </form>
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
                    <div class="col-md-auto col-5">
                        <!-- <div class="col-md-auto col-5"> -->
                        <!-- <button type="button" class="btn btn-outline-primary w-100" data-prev="tab-services"><i class="fas fa-chevron-left"></i></button> -->
                        <button type="button" class="btn btn-outline-primary w-100" data-prev="tab-branches"> Anterior</button>
                    </div>
                    <div class="col-md-auto col-5 d-none">
                        <button disabled type="button" disabled class="btn btn-outline-primary w-100" id="selected-services-button">0 Services</button>
                    </div>
                    <div class="col-md-auto ms-auto col-7">
                        <!-- <div class="col-md-auto ms-auto col-7"> -->
                        <button type="button" class="btn btn-primary w-100" id="continue-services-button" data-next="tab-review">Ver Resumen</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>