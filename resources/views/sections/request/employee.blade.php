<div class="tab-pane fade show " id="pane-employee" role="tabpanel" aria-labelledby="tab-employee">
    <div class="container py-4">
        <div class="text-center py-2">
            <h3 class="fw-bold"><i class="fas fa-user me-2 text-primary"></i>Datos del Empleado</h3>
            <p class="text-muted">Favor de agregar tu número de empleado y RFC para validación</p>
        </div>
        <div class="row g-4 mb-5" id="employee-grid">


            <form id="employee_form">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Número de empleado *</label>
                        <div class="input-group mb-3">
                            <input data-fill="nmlp" id="employee" type="text" name="employee" value="012993558" class="form-control " placeholder="Ingresa tu número de empleado">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">RFC *</label>
                        <input data-fill="rtbfjc" type="text" name="rfc" id="employee_rfc" value="NONA820101XYZ" class="form-control " placeholder="Ingresa tu RFC">
                    </div>

                    <div class="col-md-6">
                        <label for="full_name" class="form-label">Nombre completo</label>
                        <input data-fill="nmtbj" value="Pedro Pérez" type="text" class="form-control " id="employee_full_name">
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input data-fill="" value="dancaballerodlc@gmail.com" type="email" class="form-control " id="employee_email">
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input data-fill="" value="2291229900" type="phone" class="form-control " id="employee_phone">
                    </div>

                    <!-- <div class="col-md-6 d-none">
                        <label for="days" class="form-label">Días disponibles</label>
                        <input data-fill="" type="number" class="form-control " id="employee_days">
                    </div>

                    <div class="col-md-6">
                        <label for="position" class="form-label">Puesto</label>
                        <input data-fill="puesto" type="text" class="form-control " id="employee_position">
                    </div>

                    <div class="col-md-6">
                        <label for="department" class="form-label">Gerencia</label>
                        <input data-fill="areasol" type="text" class="form-control " id="employee_department">
                    </div>
                    -->
                    <div class="col-md-6">
                        <label for="employee_direction" class="form-label">Dependencia perteneciente</label>
                        <input data-fill="ndpc" type="text" value="Ventas" class="form-control " id="employee_direction">
                    </div>
                    <div class="col-md-6">
                        <label for="payment" class="form-label">UUID</label>
                        <input data-fill="uuid" type="text" class="form-control " value="1" id="employee_payment">
                    </div>

                    <div class="col-md-6 d-none">
                        <label for="shift" class="form-label">Turno</label>
                        <input data-fill="turnosol" type="text" class="form-control " id="employee_shift">
                    </div>


                    <div class="col-md-6 d-none">
                        <label for="team_leader" class="form-label">Team Leader</label>
                        <input data-fill="nomjfdirecto" type="text" class="form-control " id="employee_team_leader">
                    </div>
                    <div class="col-md-6 d-none">
                        <label for="team_leader_email" class="form-label">Correo Team Leader</label>
                        <input data-fill="nomsolicitante" type="text" class="form-control " id="employee_team_leader_email">
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
                        <button type="button" class="btn btn-primary w-100" id="continue-employee-button" data-next="tab-branches">Datos del Promotor</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>