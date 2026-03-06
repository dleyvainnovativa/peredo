<div class="tab-pane fade show active" id="pane-option" role="tabpanel" aria-labelledby="tab-option">
    <div class="container py-4">
        <div class="text-center py-2">
            <h3 class="fw-bold"><i class="fas fa-list me-2 text-primary"></i> Seleccionar solicitud</h3>
            <p class="text-muted">Seleccione el tipo de solicitud para empezar el trámite.</p>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="form-label">Selecciona la plantilla *</label>

                <select class="form-control " name="" id="templates_choose">
                    @foreach ($templates as $template)
                    <option value="{{$template['content']}}">{{$template["name"]}}</option>

                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="mx-auto fixed-bottom bg-dark py-3 shadow">
        <div class="container">
            <div class="container">
                <div class="row g-2">
                    <div class="col-md-auto ms-auto col-6">
                        <button type="button" class="btn btn-primary w-100" onclick="buildDetails()" id="continue-options-button" data-next="tab-employee">Siguiente</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>