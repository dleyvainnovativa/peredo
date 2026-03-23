<!-- Review & Submit -->

<div class="tab-pane fade " id="pane-confirm" role="tabpanel" aria-labelledby="tab-confirm">
    <div class="container py-2">
        <div class="py-4 text-center">
            <h3 class="fw-bold"><i class="fas fa-check-circle me-2 text-primary"></i> Resumen de Solicitud</h3>
            <p class="text-muted">Verifica la información que subió antes de mandar la solicitud</p>
        </div>

        <div class="row g-4 pb-5">
            <div class="col-12">
                <div id="generatedPDF" class="mt-3" style="height: 80vh;">
                </div>
            </div>
            <div class="col-12">
                <div class="form-check pt-4">
                    <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                    <label class="form-check-label text-primary" for="checkDefault">
                        Aceptar términos y condiciones
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-auto fixed-bottom bg-dark py-3 shadow">
        <div class="container">
            <div class="container">
                <div class="row g-2">
                    <div class="col-md-auto col-5">
                        <button type="button" class="btn btn-outline-primary w-100" data-prev="tab-info">Anterior</button>
                    </div>
                    <div class="col-md-auto col-7 ms-auto">
                        <button type="button" class="btn btn-primary w-100" id="send_request"
                            data-next="tab-confirm">Enviar a Aprobación</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>