<!-- Review & Submit -->
<script src="https://js.stripe.com/v3/"></script>

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
                        <h5 class="fw-bold mb-4"><i class="fas fa-user me-2 text-primary" aria-hidden="true"></i> Datos del Empleado</h5>
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <p><b>Número de Empleado: </b><span id="review_employee_num">082907558</span></p>
                            </div>
                            <div class="col-12 col-md-6">
                                <p><b>Nombre: </b><span id="review_employee_name">Pedro Pérez</span></p>
                            </div>
                            <div class="col-12 col-md-6">
                                <p><b>RFC: </b><span id="review_employee_rfc">NONA820101XYZ</span></p>
                            </div>
                            <div class="col-12 col-md-6">
                                <p><b>Correo electrónico: </b><span id="review_employee_email">pedrop@correo.com</span></p>
                            </div>
                            <div class="col-12 col-md-6">
                                <p><b>Dependencia: </b><span id="review_employee_days">Ventas</span></p>
                            </div>
                            <div class="col-12 col-md-6">
                                <p><b>UUID: </b><span id="review_employee_department">1</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card card-dark border border-dark">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4"><i class="fas fa-user me-2 text-primary" aria-hidden="true"></i> Datos del Promotor</h5>
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <p><b>Nombre: </b><span id="review_name">Angel Samuel Chavez Camacho</span></p>
                            </div>
                            <div class="col-12 col-md-6">
                                <p><b>Correo electrónico: </b><span id="review_email">gestion.documental@sistemascontino.com.mx</span></p>
                            </div>
                            <div class="col-12 col-md-6">
                                <p><b>Monto Autorizado: </b><span id="review_days">4</span></p>
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
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                    <label class="form-check-label text-primary" for="checkDefault">
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
                        <button type="button" class="btn btn-outline-primary w-100" data-prev="tab-services">Anterior</button>
                    </div>
                    <div class="col-md-auto col-7 ms-auto">
                        <form>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input name="template_id" type="hidden" id="send_template_id">
                            <input name="date_limit" type="hidden" id="send_date_limit" value="2025-10-18">

                            <input name="fields" type="hidden" id="send_template_fields">

                            <input name="promotor_name" type="hidden" id="send_promotor_name">
                            <input name="promotor_email" type="hidden" id="send_promotor_email">
                            <input name="employee_name" type="hidden" id="send_employee_name">
                            <input name="employee_email" type="hidden" id="send_employee_email">
                            <input name="employee_num" type="hidden" id="send_employee_num">
                            <input name="employee_position" type="hidden" id="send_employee_position">
                            <input name="employee_department" type="hidden" id="send_employee_department">

                            <div id="template_fields" class="text-dark col-12 d-none">
                            </div>
                            <!-- <input name="leader_name" type="hidden" id="send_leader_name"> -->
                            <!-- <input name="leader_email" type="hidden" id="send_leader_email"> -->
                            <input name="html" type="hidden" id="send_html">
                            <button type="button" onclick="uploadDocument(event)" class="btn btn-primary w-100" id="send_request"
                                data-next="tab-review">Solicitar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>