<!-- Review & Submit -->

<div class="tab-pane fade" id="pane-review" role="tabpanel" aria-labelledby="tab-review">
    <div class="container py-2">
        <div class="py-4 text-center">
            <h3 class="fw-bold"><i class="fas fa-check-circle me-2 text-primary"></i> Resumen de Solicitud</h3>
            <p class="text-muted">Verifica la información que subió antes de mandar la solicitud</p>
        </div>

        <div class="row g-4 pb-5">
            <div class="col-12">
                <div class="card card-dark border border-dark">

                    <div class="card-body p-4">
                        <div class="row g-3">
                            @foreach($credito_fields as $variable)
                            <div class="col-md-6">
                                <div class="border rounded p-3 h-100">
                                    <small class="text-secondary d-block">
                                        {{ $variable['name'] }}
                                    </small>

                                    <div class="fw-semibold fs-5">
                                        {{ $variable['value'] ?: '-' }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="checkReview">
                    <label class="form-check-label text-primary" for="checkReview">
                        Aceptar términos y condiciones
                    </label>
                </div>
            </div>
            <div class="col-12">
                <div class="d-none" id="template_html">

                </div>
            </div>
        </div>
    </div>
    <div class="mx-auto fixed-bottom bg-dark py-3 shadow">
        <div class="container">
            <div class="container">
                <div class="row g-2">
                    <div class="col-md-auto col-5">
                        <button type="button" class="btn btn-outline-primary w-100" data-prev="tab-employee">Anterior</button>
                    </div>
                    <div class="col-md-auto col-7 ms-auto">
                        <form>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input name="company_id" type="hidden" value="{{$empresa}}" id="send_company_id">
                            <input name="promotor_id" type="hidden" value="{{$promotor}}" id="send_promotor_id">
                            <input class="d-none" name="annexed" type="file" id="annexed_input">
                            <input class="d-none" name="annexed_selfie" type="file" id="annexed_selfie_input">
                            <input name="credit_id" type="hidden" value="{{$credito}}" id="send_credit_id">

                            <div id="template_fields" class="text-dark col-12 d-none">
                            </div>
                            <!-- <input name="leader_name" type="hidden" id="send_leader_name"> -->
                            <!-- <input name="leader_email" type="hidden" id="send_leader_email"> -->
                            <input name="html" type="hidden" id="send_html">
                            <button type="button" onclick="uploadDocumentRegularizacion(event)" class="btn btn-primary w-100" id="send_request"
                                data-next="tab-review">Solicitar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>