<div class="tab-pane fade show " id="pane-branches" role="tabpanel" aria-labelledby="tab-branches">
    <div class="container py-4">
        <div class="text-center py-2">
            <h3 class="fw-bold"><i class="fas fa-building me-2 text-primary"></i>Datos del Promotor</h3>
            <p class="text-muted">Favor de agregar tu número del promotor y RFC para validación</p>
        </div>
        <div class="row g-4 mb-5" id="branches-grid">
            <form class="needs-validation">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">


                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label">Número de promotor *</label>
                        <div class="input-group mb-3">
                            <input type="text" name="employee" disabled id="promotor_id" value="{{$promotor}}" class="form-control rounded" placeholder="Ingresa tu número de empleado">
                            <button class="btn btn-primary d-none" onclick="searchEmployee(event)" type="button" id="searchButton">
                                Buscar
                            </button>
                        </div>
                    </div>
                </div>
            </form>


            <form id="promotorForm">
                <div class="row g-3">
                    <!-- <input data-fill="nmtbj" type="hidden" id="employee">
                    <input data-fill="rtbfjc" type="hidden" id="rfc_employee">
                    <input data-fill="ndpc" type="hidden" id="employee_dep">
                    <input data-fill="uuid" type="hidden" id="employee_id">
                    <input data-fill="nmlp" type="hidden" id="employee_num"> -->
                    <input data-fill="fch" type="hidden" id="today" value="{{date('Y-m-d')}}">
                    <input data-fill="diasol" type="hidden" id="days_taken">
                    <input data-fill="fechapersol" type="hidden" id="fill_date_init">
                    <input data-fill="fchsl" type="hidden" id="fill_date_end">
                    <input data-fill="cmjf" type="hidden" id="leader_comments">

                    <div class="col-md-6">
                        <label for="full_name" class="form-label">Nombre completo</label>
                        <input data-fill="npmr" disabled type="text" class="form-control " id="full_name">
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input data-fill="" disabled type="email" class="form-control " id="email">
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input data-fill="" disabled type="phone" class="form-control " id="promotor_phone">
                    </div>



                    <div class="col-md-6 d-none">
                        <label for="position" class="form-label">Puesto</label>
                        <input data-fill="puesto" type="text" class="form-control " id="position" disabled="">
                    </div>

                    <div class="col-md-6 d-none">
                        <label for="department" class="form-label">Gerencia</label>
                        <input data-fill="areasol" type="text" class="form-control " id="department" disabled="">
                    </div>
                    <div class="col-md-6 d-none">
                        <label for="department" class="form-label">Dirección perteneciente</label>
                        <input data-fill="areasol" type="text" class="form-control " id="direction" disabled="">
                    </div>

                    <div class="col-md-6 d-none">
                        <label for="payment" class="form-label">Tipo de Pago</label>
                        <input data-fill="tipopago" type="text" class="form-control " id="payment" disabled="">
                    </div>

                    <div class="col-md-6 d-none">
                        <label for="shift" class="form-label">Turno</label>
                        <input data-fill="turnosol" type="text" class="form-control " id="shift" disabled="">
                    </div>


                    <div class="col-md-6 d-none">
                        <label for="team_leader" class="form-label">Team Leader</label>
                        <input data-fill="nomjfdirecto" type="text" class="form-control " id="team_leader" disabled="">
                    </div>
                    <div class="col-md-6 d-none">
                        <label for="team_leader_email" class="form-label">Correo Team Leader</label>
                        <input data-fill="nomsolicitante" type="text" class="form-control " id="team_leader_email" disabled="">
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
                        <!-- <button type="button" class="btn btn-outline-primary w-100" data-prev="tab-employee">Anterior</button> -->
                        <button type="button" class="btn btn-outline-primary w-100" data-prev="tab-employee">Anterior</button>
                    </div>
                    <div class="col-md-auto ms-auto col-7">
                        <button type="button" class="btn btn-primary w-100" onclick="updateReview()" id="continue-branches-button" disabled>Resumen</button>
                        <!-- <button type="button" class="btn btn-primary w-100" onclick="updateReview()" id="continue-branches-button" data-next="tab-annexed">Validación</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>